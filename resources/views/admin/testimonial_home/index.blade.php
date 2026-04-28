@extends('admin.layouts.app')
@section('title', 'Testimonials | ' . config('app.name'))

@section('content')

    <div class="main">
        <nav class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Testimonials List</li>
            </ol>
        </nav>

        <div class="card-custom">
            <div class="d-flex justify-content-between mb-3">
                <h4>Testimonials List</h4>
                <a href="{{ route('admin.testimonialshome.create') }}" class="btn btn-success">
                    Add Testimonial
                </a>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-striped no-wrap table-hover align-middle" id="testimonialhome-table">
                    <thead class="table-dark">
                        <tr>
                            <th class="text-center" width="10%">ID</th>
                            <th class="text-center">Name</th>
                            <th class="text-center">Designation</th>
                            <th class="text-center">Message</th>
                            <th class="text-center">Image</th>
                            <th class="text-center" width="100px">Status</th>
                            <th width="100px">Action</th>
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
        $('#testimonialhome-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('admin.testimonialshome.index') }}',
            columns: [
                {
                    data: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                { data: 'name' },
                { data: 'designation' },
                { data: 'message' },
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
    });
</script>

<script>
    $(document).on('click', '.delete', function () {
        let button = $(this);
        let url = button.data('route');
        let tableId = '#testimonialhome-table';

        Swal.fire({
            title: 'Are you sure?',
            text: "This Testimonial will be permanently deleted!",
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
                    error: function () {
                        Swal.fire('Error!', 'Something went wrong!', 'error');
                    }
                });

            }
        });
    });
</script>

@endsection