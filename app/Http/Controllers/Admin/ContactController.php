<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $query = Contact::latest();

            return DataTables::of($query)
                ->addIndexColumn()

                ->filter(function ($query) {
                    if (request()->has('search') && $search = request('search')['value']) {
                        $query->where(function ($q) use ($search) {
                            $q->where('name',    'like', "%{$search}%")
                              ->orWhere('email',   'like', "%{$search}%")
                              ->orWhere('subject', 'like', "%{$search}%")
                              ->orWhere('message', 'like', "%{$search}%");
                        });
                    }
                })

                ->editColumn('message', function ($row) {
                    $fullMessage  = $row->message ?? '-';
                    $shortMessage = \Illuminate\Support\Str::limit($fullMessage, 50);
                    return '<span title="' . e($fullMessage) . '">' . e($shortMessage) . '</span>';
                })

                ->editColumn('created_at', function ($row) {
                    return $row->created_at->format('d M Y, h:i A');
                })

                ->addColumn('action', function ($row) {
                    return '
                        <button type="button"
                            data-id="' . $row->id . '"
                            data-route="' . route('admin.contact.destroy', $row->id) . '"
                            class="btn btn-sm btn-danger btn-delete-contact">
                            <i class="fa fa-trash"></i>
                        </button>
                    ';
                })

                ->rawColumns(['message', 'action'])
                ->make(true);
        }

        return view('admin.contact.index');
    }

    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();

        return response()->json([
            'status'  => true,
            'message' => 'Contact deleted successfully',
        ]);
    }
}