<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Program;
use Illuminate\Support\Facades\Storage;

class ProgramController extends Controller
{
    // ✅ INDEX
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = Program::with('category')->latest();

            return datatables()->of($data)
                ->addIndexColumn()

                ->addColumn('title', function ($row) {
                    return $row->title;
                })

                ->addColumn('label', function ($row) {
                    return $row->label ?? '-';
                })

                ->addColumn('thumbnail', function ($row) {
                    return '<img src="'.asset('storage/'.$row->thumbnail).'" width="60">';
                })

                ->addColumn('pdf', function ($row) {
                    return '<a href="'.asset('storage/'.$row->pdf).'" target="_blank"> <i class="fa fa-eye fs-5"></i></a>';
                })

                ->addColumn('action', function ($row) {
                    return '
                        <a href="'.route('admin.programs.edit',$row->id).'" class="btn btn-warning btn-sm"> <i class="fa fa-edit"></i></a>
                        <button class="btn btn-danger btn-sm delete" data-id="'.$row->id.'" data-route="'.route('admin.programs.destroy',$row->id).'"><i class="fa fa-trash"></i></button>
                    ';
                })

                ->rawColumns(['thumbnail','pdf','action'])
                ->make(true);
        }

        return view('admin.programs.index');
    }

    // ✅ CREATE
    public function create()
    {
        $categories = Category::where('status',1)->get();
        return view('admin.programs.create', compact('categories'));
    }

    // ✅ STORE (AJAX)
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'category_id' => 'required',
            'thumbnail' => 'required|image',
            'pdf' => 'required|mimes:pdf|max:102400'
        ]);

        $thumbnail = $request->file('thumbnail')->store('programs','public');
        $pdf = $request->file('pdf')->store('programs','public');

        Program::create([
            'category_id' => $request->category_id,
            'title' => $request->title,
            'label' => $request->label,
            'thumbnail' => $thumbnail,
            'pdf' => $pdf,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Program Created Successfully',
            'redirect' => route('admin.programs.index')
        ]);
    }

    // ✅ EDIT
    public function edit($id)
    {
        $program = Program::findOrFail($id);
        $categories = Category::where('status',1)->get();

        return view('admin.programs.edit', compact('program','categories'));
    }

    // ✅ UPDATE
    public function update(Request $request, $id)
    {
        $program = Program::findOrFail($id);

        $request->validate([
            'title' => 'required',
            'category_id' => 'required',
        ]);

        if ($request->hasFile('thumbnail')) {
            if ($program->thumbnail && Storage::disk('public')->exists($program->thumbnail)) {
                Storage::disk('public')->delete($program->thumbnail);
            }
            $program->thumbnail = $request->file('thumbnail')->store('programs','public');
        }

        if ($request->hasFile('pdf')) {
            if ($program->pdf && Storage::disk('public')->exists($program->pdf)) {
                Storage::disk('public')->delete($program->pdf);
            }
            $program->pdf = $request->file('pdf')->store('programs','public');
        }

        $program->update([
            'category_id' => $request->category_id,
            'title' => $request->title,
            'label' => $request->label,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Updated Successfully',
            'redirect' => route('admin.programs.index')
        ]);
    }

    // ✅ DELETE
    public function destroy($id)
    {
        $program = Program::findOrFail($id);

        if ($program->thumbnail && Storage::disk('public')->exists($program->thumbnail)) {
            Storage::disk('public')->delete($program->thumbnail);
        }

        if ($program->pdf && Storage::disk('public')->exists($program->pdf)) {
            Storage::disk('public')->delete($program->pdf);
        }

        $program->delete();

        return response()->json([
            'status' => true,
            'message' => 'Deleted Successfully'
        ]);
    }
}