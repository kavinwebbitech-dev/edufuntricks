@extends('admin.layouts.app')

@section('content')
    <div class="container">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4>Edit Category</h4>
            <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
                <i class="fa fa-arrow-left"></i> Back
            </a>
        </div>

        <div class="card p-4 shadow-sm">

            <form id="editForm" enctype="multipart/form-data">
                @csrf

                <div class="row g-3">

                    <!-- Name -->
                    <div class="col-md-6">
                        <label>Name</label>
                        <input type="text" name="name" value="{{ $data->name }}" class="form-control">
                        <span class="text-danger error-name"></span>
                    </div>

                    <!-- Status -->
                    <div class="col-md-6">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            <option value="1" {{ $data->status ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ !$data->status ? 'selected' : '' }}>Inactive</option>
                        </select>
                        <span class="text-danger error-status"></span>
                    </div>

                    <!-- Image Upload -->
                    <div class="col-md-6">
                        <label>Image</label>
                        <input type="file" name="image" class="form-control">
                        <span class="text-danger error-image"></span>
                    </div>

                    <!-- Current Image -->
                    <div class="col-md-6">
                        <label>Current Image</label>
                        <div class="mt-2">
                            <img id="preview" src="{{ asset('storage/' . $data->image) }}" width="120"
                                class="rounded border">
                        </div>
                    </div>

                    <!-- Submit -->
                    <div class="col-12 mt-3">
                        <button type="submit" class="btn btn-primary" id="updateBtn">
                            <i class="fa fa-save"></i> Update Category
                        </button>
                    </div>

                </div>

            </form>

        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $('#editForm').submit(function(e) {
            e.preventDefault();

            let formData = new FormData(this);

            // ✅ Important for PUT method
            formData.append('_method', 'PUT');

            $(".text-danger").html('');

            $.ajax({
                url: "{{ route('admin.categories.update', $data->id) }}",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,

                beforeSend: function() {
                    $('#updateBtn')
                        .html('<i class="fa fa-spinner fa-spin"></i> Updating...')
                        .prop('disabled', true);
                },

                success: function(res) {
                    if (res.status) {
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            icon: 'success',
                            title: res.message,
                            showConfirmButton: false,
                            timer: 2000
                        }).then(() => {
                            window.location = res.redirect;
                        });
                    }
                },

                error: function(err) {
                    $('#updateBtn')
                        .html('<i class="fa fa-save"></i> Save Category')
                        .prop('disabled', false);

                    if (err.responseJSON && err.responseJSON.errors) {
                        let e = err.responseJSON.errors;

                        if (e.name) $('.error-name').html(e.name[0]);
                        if (e.image) $('.error-image').html(e.image[0]);
                        if (e.status) $('.error-status').html(e.status[0]);
                    } else {
                        alert("Server Error");
                    }
                }
            });
        });
    </script>
    <script>
        $('input[name="image"]').on('change', function() {
            let file = this.files[0];

            if (file) {
                let reader = new FileReader();
                reader.onload = function(e) {
                    $('#preview').attr('src', e.target.result);
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection
