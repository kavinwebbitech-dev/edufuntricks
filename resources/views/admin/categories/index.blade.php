@extends('admin.layouts.app')

@section('content')
    <div class="main">
        <div class="d-flex justify-content-between mb-3">
            <h4>Category List</h4>
            <a href="{{ route('admin.categories.create') }}" class="btn btn-success">Add Category</a>
        </div>

        <table class="table table-bordered table-striped no-wrap table-hover align-middle" id="category-table">
            <thead class="table-dark">
                <tr>
                    <th class="text-center" width="10%">S.No</th>
                    <th class="text-center">Name</th>
                    <th class="text-center">Image</th>
                    <th class="text-center">Status</th>
                    <th class="text-center" width="100px">Action</th>
                </tr>
            </thead>
        </table>
    </div>
@endsection

@section('scripts')
    <script>
        let table = $('#category-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.categories.index') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'name'
                },
                {
                    data: 'image',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'status',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'action',
                    orderable: false,
                    searchable: false
                }
            ]
        });

        // ✅ DELETE FIXED
        $(document).on('click', '.delete', function() {
            let url = $(this).data('route');

            Swal.fire({
                title: 'Are you sure?',
                text: 'This category will be permanently deleted!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                confirmButtonText: 'Yes, Delete!'
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        url: url,
                        type: 'DELETE', // ✅ FIXED
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },

                        success: function(res) {
                            if (res.status) {
                                table.ajax.reload(null, false); // ✅ FIXED

                                Swal.fire({
                                    toast: true,
                                    position: 'top-end',
                                    icon: 'success',
                                    title: res.message,
                                    showConfirmButton: false,
                                    timer: 2000
                                });
                            }
                        },

                        error: function(xhr) {
                            console.log(xhr.responseText); // 🔥 DEBUG

                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: 'Delete failed. Check console.'
                            });
                        }
                    });

                }
            });
        });
    </script>
@endsection
