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

        // $thumbnail = $request->file('thumbnail')->store('programs','public');
        // $pdf = $request->file('pdf')->store('programs','public');
        // Thumbnail upload
        $thumbnailFile = $request->file('thumbnail');
        $thumbnailName = time().'_'.$thumbnailFile->getClientOriginalName();
        $thumbnailFile->move(public_path('storage/programs'), $thumbnailName);
        $thumbnailPath = 'programs/'.$thumbnailName;

        // PDF upload
        $pdfFile = $request->file('pdf');
        $pdfName = time().'_'.$pdfFile->getClientOriginalName();
        $pdfFile->move(public_path('storage/programs'), $pdfName);
        $pdfPath = 'programs/'.$pdfName;

        Program::create([
            'category_id' => $request->category_id,
            'title' => $request->title,
            'label' => $request->label,
            'thumbnail' => $thumbnailPath,
            'pdf' => $pdfPath,
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

        // if ($request->hasFile('thumbnail')) {
        //     if ($program->thumbnail && Storage::disk('public')->exists($program->thumbnail)) {
        //         Storage::disk('public')->delete($program->thumbnail);
        //     }
        //     $program->thumbnail = $request->file('thumbnail')->store('programs','public');
        // }

        // if ($request->hasFile('pdf')) {
        //     if ($program->pdf && Storage::disk('public')->exists($program->pdf)) {
        //         Storage::disk('public')->delete($program->pdf);
        //     }
        //     $program->pdf = $request->file('pdf')->store('programs','public');
        // }
        // ✅ Thumbnail update
        if ($request->hasFile('thumbnail')) {
        
            // old file delete
            if (!empty($program->thumbnail) && file_exists(public_path('storage/'.$program->thumbnail))) {
                unlink(public_path('storage/'.$program->thumbnail));
            }
        
            $file = $request->file('thumbnail');
            $filename = time().'.'.$file->extension();
        
            // move file
            $file->move(public_path('storage/programs'), $filename);
        
            // save with programs/ prefix
            $program->thumbnail = 'programs/'.$filename;
        }
        
        
        // ✅ PDF update
        if ($request->hasFile('pdf')) {
        
            if (!empty($program->pdf) && file_exists(public_path('storage/'.$program->pdf))) {
                unlink(public_path('storage/'.$program->pdf));
            }
        
            $file = $request->file('pdf');
            $filename = time().'.'.$file->extension();
        
            $file->move(public_path('storage/programs'), $filename);
        
            $program->pdf = 'programs/'.$filename;
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