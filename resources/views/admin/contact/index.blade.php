@extends('admin.layouts.app')
@section('title', 'Contacts | ' . config('app.name'))

@section('content')
    <div class="container">
        <nav class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Contacts</li>
            </ol>
        </nav>

        <div class="card-custom">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="mb-0">Contact Messages</h4>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle" id="contact-table">
                    <thead class="table-dark">
                        <tr>
                            <th class="text-center" width="10%">S.No</th>
                            <th class="text-center">Name</th>
                            <th class="text-center">Email</th>
                            <th class="text-center">Subject</th>
                            <th class="text-center">Message</th>
                            <th class="text-center" width="10%">Date</th>
                            <th width="10%" class="text-center">Action</th>
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
        var table = $('#contact-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ route('admin.contact.index') }}',
                type: 'GET',
            },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'name',       name: 'name' },
                { data: 'email',      name: 'email' },
                { data: 'subject',    name: 'subject' },
                { data: 'message',    name: 'message',     orderable: false },
                { data: 'created_at', name: 'created_at' },
                { data: 'action',     name: 'action',      orderable: false, searchable: false, className: 'text-center' },
            ]
        });

        // ✅ Delete Contact
        $(document).on('click', '.btn-delete-contact', function() {
            let url = $(this).data('route');

            Swal.fire({
                title: 'Delete this message?',
                text: 'This action cannot be undone.',
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
                        type: 'DELETE',
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
                                text: 'Could not delete message. Please try again.'
                            });
                        }
                    });
                }
            });
        });

    });
</script>
@endsection