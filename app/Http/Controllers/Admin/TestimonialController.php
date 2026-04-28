<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Testimonial;
use App\Models\Testimonial_homes;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Storage;

class TestimonialController extends Controller
{
    public function homeindex(Request $request)
    {
        if ($request->ajax()) {
            $data = Testimonial_homes::latest()->get();

            return DataTables::of($data)
                ->addIndexColumn()

                ->addColumn('image', function ($row) {
                    return '<img src="' . asset('storage/' . $row->image) . '" width="60">';
                })

                ->addColumn('status', function ($row) {
                    return $row->status
                        ? '<span class="badge bg-success">Active</span>'
                        : '<span class="badge bg-danger">Inactive</span>';
                })

                ->addColumn('action', function ($row) {
                    return '
            <a href="' . route('admin.testimonialshome.edit', $row->id) . '" class="btn btn-sm btn-warning"> <i class="fa fa-edit"></i></a>
            <button class="btn btn-sm btn-danger delete" 
                data-route="' . route('admin.testimonialshome.destroy', $row->id) . '">
                <i class="fa fa-trash"></i>
            </button>
        ';
                })

                ->rawColumns(['image', 'status', 'action'])
                ->make(true);
        }

        return view('admin.testimonial_home.index');
    }

    public function homecreate()
    {
        return view('admin.testimonial_home.create');
    }

    public function homestore(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'designation' => 'nullable',
            'message' => 'required',
            'image' => 'nullable|image',
            'status' => 'required'
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('testimonials', 'public');
        }

        Testimonial_homes::create([
            'name' => $request->name,
            'designation' => $request->designation,
            'message' => $request->message,
            'image' => $imagePath,
            'status' => $request->status, // ✅ FIX ADDED
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Testimonial Added',
            'redirect' => route('admin.testimonialshome.index')
        ]);
    }

    public function homeedit($id)
    {
        $data = Testimonial_homes::findOrFail($id);
        return view('admin.testimonial_home.edit', compact('data'));
    }

    public function homeupdate(Request $request, $id)
    {
        $testimonial = Testimonial_homes::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'designation' => 'nullable',
            'message' => 'required',
            'image' => 'nullable|image',
            'status' => 'required'
        ]);

        if ($request->hasFile('image')) {

            // ✅ Optional: delete old image
            if ($testimonial->image && Storage::disk('public')->exists($testimonial->image)) {
                Storage::disk('public')->delete($testimonial->image);
            }

            $testimonial->image = $request->file('image')->store('testimonials', 'public');
        }

        $testimonial->update([
            'name' => $request->name,
            'designation' => $request->designation,
            'message' => $request->message,
            'status' => $request->status,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Updated Successfully',
            'redirect' => route('admin.testimonialshome.index')
        ]);
    }

    public function homedestroy($id)
    {
        Testimonial_homes::findOrFail($id)->delete();

        return response()->json([
            'status' => true,
            'message' => 'Deleted Successfully'
        ]);
    }


    //  Testimonials --->

     public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Testimonial::latest()->get();

            return DataTables::of($data)
                ->addIndexColumn()

                ->addColumn('image', function ($row) {
                    return '<img src="' . asset('storage/' . $row->image) . '" width="60">';
                })

                ->addColumn('status', function ($row) {
                    return $row->status
                        ? '<span class="badge bg-success">Active</span>'
                        : '<span class="badge bg-danger">Inactive</span>';
                })

                ->addColumn('action', function ($row) {
                    return '
            <a href="' . route('admin.testimonials.edit', $row->id) . '" class="btn btn-sm btn-warning"> <i class="fa fa-edit"></i></a>
            <button class="btn btn-sm btn-danger delete" 
                data-route="' . route('admin.testimonials.destroy', $row->id) . '">
                <i class="fa fa-trash"></i>
            </button>
        ';
                })

                ->rawColumns(['image', 'status', 'action'])
                ->make(true);
        }

        return view('admin.testimonial.index');
    }

    public function create()
    {
        return view('admin.testimonial.create');
    }

    public function store(Request $request)
    {
        $request->validate([
           
            'image' => 'nullable|image',
            'status' => 'required'
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('testimonials', 'public');
        }

        Testimonial::create([
           
            'image' => $imagePath,
            'status' => $request->status, // ✅ FIX ADDED
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Testimonial Added',
            'redirect' => route('admin.testimonials.index')
        ]);
    }

    public function edit($id)
    {
        $data = Testimonial::findOrFail($id);
        return view('admin.testimonial.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $testimonial = Testimonial::findOrFail($id);

        $request->validate([
           
            'image' => 'nullable|image',
            'status' => 'required'
        ]);

        if ($request->hasFile('image')) {

            // ✅ Optional: delete old image
            if ($testimonial->image && Storage::disk('public')->exists($testimonial->image)) {
                Storage::disk('public')->delete($testimonial->image);
            }

            $testimonial->image = $request->file('image')->store('testimonials', 'public');
        }

        $testimonial->update([
           
            'status' => $request->status,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Updated Successfully',
            'redirect' => route('admin.testimonials.index')
        ]);
    }

    public function destroy($id)
    {
        Testimonial::findOrFail($id)->delete();

        return response()->json([
            'status' => true,
            'message' => 'Deleted Successfully'
        ]);
    }
}
