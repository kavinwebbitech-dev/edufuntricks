@extends('admin.layouts.app')
@section('title', 'Gallery | ' . config('app.name'))

@section('content')
    <div class="container">
        <nav class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Gallery</li>
            </ol>
        </nav>

        <div class="card-custom ">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="d-flex align-items-center gap-3">
                    <h4 class="mb-0">Gallery Sections</h4>
                </div>
                <a href="{{ route('admin.gallery.create') }}" class="btn btn-success">
                    Add Gallery
                </a>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-striped no-wrap table-hover align-middle" id="gallery-table">
                    <thead class="table-dark">
                        <tr>
                            <th class="text-center" width="10%">S.No</th>
                            <th class="text-center">Section Key</th>
                            <th class="text-center">Section Title</th>
                            {{-- <th class="text-center" width="15%">Image Preview</th> --}}
                            <th width="12%" class="text-center">Total Images</th>
                            <th width="10%" class="text-center">Status</th>
                            <th width="15%" class="text-center">Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(function() {

            // ✅ DataTable Init
            var table = $('#gallery-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('admin.gallery.index') }}',
                columns: [{
                        data: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'section_key',
                        name: 'section_key'
                    },
                    {
                        data: 'title',
                        name: 'title'
                    },

                    // {
                    //     data: 'preview',
                    //     name: 'preview',
                    //     orderable: false,
                    //     searchable: false
                    // },
                    {
                        data: 'total',
                        name: 'total',
                        orderable: false,
                        searchable: false,
                        className: 'text-center'
                    },
                    {
                        data: 'status',
                        name: 'status',
                        orderable: false,
                        searchable: false,
                        className: 'text-center'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });

            // ✅ Delete Gallery
            $(document).on('click', '.btn-toggle-status', function() {
                let id = $(this).data('id');
                let current = $(this).data('status');
                let action = current == 1 ? 'Deactivate' : 'Activate';

                Swal.fire({
                    title: action + ' this gallery?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: current == 1 ? '#d33' : '#28a745',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Yes, ' + action + '!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '{{ url('admin/gallery/toggle-status') }}/' + id,
                            type: 'GET',
                            success: function(res) {
                                if (res.status) {
                                    table.ajax.reload(null, false);
                                    Swal.fire({
                                        toast: true,
                                        position: 'top-end',
                                        icon: 'success',
                                        title: res.message,
                                        showConfirmButton: false,
                                        timer: 2000,
                                        timerProgressBar: true
                                    });
                                }
                            },
                            error: function() {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error!',
                                    text: 'Could not update status. Please try again.'
                                });
                            }
                        });
                    }
                });
            });

            // ✅ Delete Gallery
            $(document).on('click', '.btn-delete-gallery', function() {
                let url = $(this).data('route');

                Swal.fire({
                    title: 'Delete this gallery?',
                    text: 'All images inside will also be permanently deleted.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Yes, Delete!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: url,
                            type: 'GET',
                            success: function(res) {
                                if (res.status) {
                                    table.ajax.reload(null, false);
                                    Swal.fire({
                                        toast: true,
                                        position: 'top-end',
                                        icon: 'success',
                                        title: res.message,
                                        showConfirmButton: false,
                                        timer: 2000,
                                        timerProgressBar: true
                                    });
                                }
                            },
                            error: function() {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error!',
                                    text: 'Could not delete gallery. Please try again.'
                                });
                            }
                        });
                    }
                });
            });

        });
    </script>
@endsection
