@extends('admin.layouts.app')
@section('title', 'Programs | ' . config('app.name'))

@section('content')

    <div class="main">
        <nav class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Programs List</li>
            </ol>
        </nav>

        <div class="card-custom">
            <div class="d-flex justify-content-between mb-3">
                <h4>Programs List</h4>
                <a href="{{ route('admin.programs.create') }}" class="btn btn-success">Add Program</a>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-striped no-wrap table-hover align-middle" id="program-table">
                    <thead class="table-dark">
                        <tr>
                            <th class="text-center" width="10%">ID</th>
                            <th class="text-center">Title</th>
                            <th class="text-center">Label</th>
                            <th class="text-center">Image</th>
                            <th class="text-center">PDF</th>
                            <th class="text-center" width="10%">Action</th>
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
            $('#program-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('admin.programs.index') }}',
                columns: [{
                        data: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'title'
                    },
                    {
                        data: 'label'
                    },
                    {
                        data: 'thumbnail',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'pdf',
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
        });
    </script>

    <script>
        $(document).on('click', '.delete', function () {
            let button = $(this);
            let id = button.data('id');
            let url = button.data('route');
            let tableId = '#program-table'; // your datatable id

            Swal.fire({
                title: 'Are you sure?',
                text: "This Blog will be permanently deleted!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        url: url,
                        type: "DELETE",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (response) {
                            if (response.status) {
                                Swal.fire('Deleted!', response.message, 'success');
                                $(tableId).DataTable().ajax.reload(null, false);
                            }
                        },
                        error: function (xhr) {
                            console.log(xhr.responseText);
                            Swal.fire('Error!', 'Something went wrong!', 'error');
                        }
                    });

                }
            });
        });
    </script>

@endsection
