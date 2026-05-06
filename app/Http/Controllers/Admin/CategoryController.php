<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;


class CategoryController extends Controller
{
    // ✅ INDEX
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = Category::latest();

            return datatables()->of($data)
                ->addIndexColumn()

                ->addColumn('image', function ($row) {
                    return '<img src="' . asset('storage/' . $row->image) . '" width="60">';
                })

                ->addColumn('status', function ($row) {
                    return $row->status
                        ? '<span class="badge bg-success toggleStatus" data-id="' . $row->id . '" style="cursor:pointer;">Active</span>'
                        : '<span class="badge bg-danger toggleStatus" data-id="' . $row->id . '" style="cursor:pointer;">Inactive</span>';
                })

                ->addColumn('action', function ($row) {
                    return '
                        <a href="' . route('admin.categories.edit', $row->id) . '" class="btn btn-warning btn-sm"> <i class="fa fa-edit"></i></a>
                        <button class="btn btn-danger btn-sm delete" data-id="' . $row->id . '" data-route="' . route('admin.categories.destroy', $row->id) . '"> <i class="fa fa-trash"></i></button>
                    ';
                })

                ->rawColumns(['image', 'status', 'action'])
                ->make(true);
        }

        return view('admin.categories.index');
    }

    // ✅ CREATE
    public function create()
    {
        return view('admin.categories.create');
    }

    // ✅ STORE
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'required|image',
            'status' => 'required|in:0,1'
        ]);

        // $image = $request->file('image')->store('categories', 'public');
         $thumbnailFile = $request->file('image');
                $thumbnailName = time().'_'.$thumbnailFile->getClientOriginalName();
                $thumbnailFile->move(public_path('storage/categories'), $thumbnailName);
                $thumbnailPath = 'categories/'.$thumbnailName;

        // ✅ Generate slug
        $slug = Str::slug($request->name);

        // ✅ Prevent duplicate slug
        $count = Category::where('slug', 'LIKE', "$slug%")->count();
        if ($count > 0) {
            $slug = $slug . '-' . ($count + 1);
        }
    // dd($slug);
        Category::create([
            'name' => $request->name,
            'slug' => $slug, // ✅ added
            'image' => $thumbnailPath,
            'status' => $request->status
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Category Created',
            'redirect' => route('admin.categories.index')
        ]);
    }

    // ✅ EDIT
    public function edit($id)
    {
        $data = Category::findOrFail($id);
        return view('admin.categories.edit', compact('data'));
    }

    // ✅ UPDATE
    public function update(Request $request, $id)
    {
        $data = Category::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'status' => 'required|in:0,1'
        ]);

        // ✅ Image update
        // if ($request->hasFile('image')) {
        //     if ($data->image && Storage::disk('public')->exists($data->image)) {
        //         Storage::disk('public')->delete($data->image);
        //     }
        //     $data->image = $request->file('image')->store('categories', 'public');
        // }
        if ($request->hasFile('image')) {
        
            // old file delete
            if (!empty( $data->image) && file_exists(public_path('storage/categories'. $data->image))) {
                unlink(public_path('storage/categories'. $data->image));
            }
        
            $file = $request->file('image');
            $filename = time().'.'.$file->extension();
        
            // move file
            $file->move(public_path('storage/categories'), $filename);
        
            // save with programs/ prefix
             $data->image = 'categories/'.$filename;
        }

        // ✅ Generate slug
        $slug = Str::slug($request->name);

        // ✅ Avoid duplicate (except current ID)
        $count = Category::where('slug', 'LIKE', "$slug%")
            ->where('id', '!=', $id)
            ->count();

        if ($count > 0) {
            $slug = $slug . '-' . ($count + 1);
        }

        $data->update([
            'name' => $request->name,
            'slug' => $slug, // ✅ added
            'status' => $request->status
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Updated Successfully',
            'redirect' => route('admin.categories.index')
        ]);
    }

    // ✅ DELETE
    public function destroy($id)
    {
        $data = Category::findOrFail($id);

        if ($data->image && Storage::disk('public')->exists($data->image)) {
            Storage::disk('public')->delete($data->image);
        }

        $data->delete();

        return response()->json([
            'status'  => true,
            'message' => '"' . $data->name . '" category deleted successfully',
        ]);
    }

    // ✅ STATUS TOGGLE
    public function toggleStatus($id)
    {
        $data = Category::findOrFail($id);
        $data->status = $data->status == 1 ? 0 : 1;
        $data->save();

        return response()->json(['status' => true]);
    }
}
