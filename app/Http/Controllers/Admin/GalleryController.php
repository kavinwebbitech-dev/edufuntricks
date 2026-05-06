<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gallery;
use App\Models\GalleryImage;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class GalleryController extends Controller
{
    // ✅ INDEX
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Gallery::withCount('images')->orderBy('id');

            return DataTables::of($data)
                ->addIndexColumn()

                ->addColumn('total', function ($row) {
                    return '<span class="badge bg-primary">' . $row->images_count . ' images</span>';
                })

                // ✅ Status badge only — no toggle
                ->addColumn('status', function ($row) {
                    if ($row->status == 1) {
                        return '<span class="badge bg-success ">Active</span>';
                    } else {
                        return '<span class="badge bg-danger ">Inactive</span>';
                    }
                })

                ->addColumn('action', function ($row) {
                    $statusBtn = $row->status == 1
                        ? '<button type="button"
                                class="btn btn-danger btn-sm btn-toggle-status"
                                data-id="' . $row->id . '"
                                data-status="1"
                                title="Click to Deactivate">
                                <i class="fa fa-ban"></i>
                           </button>'
                        : '<button type="button"
                                class="btn btn-success btn-sm btn-toggle-status"
                                data-id="' . $row->id . '"
                                data-status="0"
                                title="Click to Activate">
                                <i class="fa fa-check"></i>
                           </button>';

                    return '
                        <div class="d-flex gap-2 flex-wrap">
                            <a href="' . route('admin.gallery.edit', $row->id) . '"
                               class="btn btn-warning btn-sm">
                                <i class="fa fa-edit"></i>
                            </a>
                            ' . $statusBtn . '
                            <button type="button"
                                class="btn btn-danger btn-sm btn-delete-gallery"
                                data-id="' . $row->id . '"
                                data-route="' . route('admin.gallery.destroy', $row->id) . '">
                                <i class="fa fa-trash"></i>
                            </button>
                        </div>
                    ';
                })

                ->rawColumns(['preview', 'total', 'status', 'action'])
                ->make(true);
        }

        return view('admin.gallery.index');
    }

    // ✅ CREATE
    public function create()
    {
        return view('admin.gallery.create');
    }

    // ✅ EDIT
    public function edit($id)
    {
        $gallery = Gallery::with('images')->findOrFail($id);
        return view('admin.gallery.edit', compact('gallery'));
    }

    // ✅ STORE
    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'section_key' => 'required|string|max:100',
            'status'      => 'required|in:0,1',
            'images'      => 'nullable|array',
            'images.*'    => 'image|mimes:jpg,jpeg,png,webp|max:1024',
        ]);

        $gallery = Gallery::create([
            'title'       => $request->title,
            'section_key' => $request->section_key,
            'status'      => $request->status,
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                // $path = $image->store('gallery', 'public');
                $filename = time().'_'.uniqid().'.'.$image->extension();

                // move to public folder
                $image->move(public_path('storage/gallery'), $filename);
                GalleryImage::create([
                    'gallery_id' => $gallery->id,
                    'image'      =>  'gallery/'.$filename,
                ]);
            }
        }

        return response()->json([
            'status'   => true,
            'message'  => 'Gallery created successfully',
            'redirect' => route('admin.gallery.index'),
        ]);
    }

    // ✅ UPDATE
     public function update(Request $request, $id)
    {
        $gallery = Gallery::findOrFail($id);

        $request->validate([
            'status'   => 'required|in:0,1',
            'images'   => 'nullable|array',
            'images.*' => 'image|mimes:jpg,jpeg,png,webp|max:1024',
        ]);

        $gallery->update([
            'title'       => $request->title ?? $gallery->title,
            'section_key' => $request->section_key ?? $gallery->section_key,
            'status'      => $request->status,
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                // $path = $image->store('gallery', 'public');
                 $filename = time().'_'.uniqid().'.'.$image->extension();

                // move to public folder
                $image->move(public_path('storage/gallery'), $filename);
                GalleryImage::create([
                    'gallery_id' => $gallery->id,
                    'image'      =>'gallery/'.$filename,
                ]);
            }
        }

        return response()->json([
            'status'   => true,
            'message'  => $gallery->title . ' updated successfully',
            'redirect' => route('admin.gallery.index'),
        ]);
    }

    // ✅ TOGGLE STATUS
    public function toggleStatus($id)
    {
        $gallery = Gallery::findOrFail($id);
        $gallery->status = $gallery->status == 1 ? 0 : 1;
        $gallery->save();

        return response()->json([
            'status'  => true,
            'active'  => $gallery->status,
            'message' => '"' . $gallery->title . '" is now ' . ($gallery->status ? 'Active' : 'Inactive'),
        ]);
    }

    // ✅ DELETE SINGLE IMAGE
    public function deleteImage($id)
    {
        $image = GalleryImage::findOrFail($id);

        if (Storage::disk('public')->exists($image->image)) {
            Storage::disk('public')->delete($image->image);
        }

        $image->delete();

        return response()->json([
            'status'  => true,
            'message' => 'Image deleted successfully',
        ]);
    }

    // ✅ DELETE ENTIRE GALLERY
    public function destroy($id)
    {
        $gallery = Gallery::with('images')->findOrFail($id);

        foreach ($gallery->images as $img) {
            if (Storage::disk('public')->exists($img->image)) {
                Storage::disk('public')->delete($img->image);
            }
            $img->delete();
        }

        $gallery->delete();

        return response()->json([
            'status'  => true,
            'message' => '"' . $gallery->title . '" gallery deleted successfully',
        ]);
    }
}