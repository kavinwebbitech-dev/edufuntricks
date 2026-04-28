@extends('admin.layouts.app')

@section('content')
    <div class="container">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4>Create Category</h4>
            <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
                <i class="fa fa-arrow-left"></i> Back
            </a>
        </div>

        <div class="card p-4 shadow-sm">

            <form id="categoryForm" enctype="multipart/form-data">
                @csrf

                <div class="row g-3">

                    <!-- Name -->
                    <div class="col-md-6">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Enter category name">
                        <span class="text-danger error-name"></span>
                    </div>
                    <div class="col-md-6">
                        <label>Slug</label>
                        <input type="text" name="slug" class="form-control" placeholder="Auto generated slug">
                        <span class="text-danger error-slug"></span>
                    </div>

                    <!-- Status -->
                    <div class="col-md-6">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                        <span class="text-danger error-status"></span>
                    </div>

                    <!-- Image -->
                    <div class="col-md-6">
                        <label>Image</label>
                        <input type="file" name="image" class="form-control">
                        <span class="text-danger error-image"></span>
                    </div>

                    <!-- Preview -->
                    <div class="col-md-6">
                        <label>Preview</label>
                        <div class="mt-2">
                            <img id="preview" width="120" class="rounded border d-none">
                        </div>
                    </div>

                    <!-- Submit -->
                    <div class="col-12 mt-3">
                        <button type="submit" class="btn btn-success" id="submitBtn">
                            <i class="fa fa-save"></i> Save Category
                        </button>
                    </div>

                </div>

            </form>

        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $("#categoryForm").submit(function(e) {
            e.preventDefault();

            let formData = new FormData(this);
            $(".text-danger").html('');

            $.ajax({
                url: "{{ route('admin.categories.store') }}",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,

                beforeSend: function() {
                    $('#submitBtn')
                        .html('<i class="fa fa-spinner fa-spin"></i> Saving...')
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
                            timer: 2000,
                            timerProgressBar: true
                        }).then(() => {
                            window.location.href = res.redirect;
                        });
                    }
                },

                error: function(err) {
                    $('#submitBtn')
                        .html('<i class="fa fa-save"></i> Save Category')
                        .prop('disabled', false);

                    if (err.responseJSON && err.responseJSON.errors) {
                        let errors = err.responseJSON.errors;

                        if (errors.name) $(".error-name").html(errors.name[0]);
                        if (errors.image) $(".error-image").html(errors.image[0]);
                        if (errors.status) $(".error-status").html(errors.status[0]);
                        if (errors.slug) $(".error-slug").html(errors.slug[0]);
                    } else {
                        alert("Server Error");
                    }
                }
            });
        });


        // ✅ Image Preview
        $('input[name="image"]').on('change', function() {
            let file = this.files[0];

            if (file) {
                let reader = new FileReader();
                reader.onload = function(e) {
                    if (!$('#preview').length) {
                        $('<img id="preview" width="120" class="mt-2"/>').insertAfter('input[name="image"]');
                    }
                    $('#preview').attr('src', e.target.result);
                };
                reader.readAsDataURL(file);
            }
        });
        // ✅ Auto slug from name
        $('input[name="name"]').on('keyup', function() {
            let slug = $(this).val()
                .toLowerCase()
                .replace(/[^a-z0-9\s-]/g, '') // remove special chars
                .replace(/\s+/g, '-') // spaces to -
                .replace(/-+/g, '-'); // remove duplicate -

            $('input[name="slug"]').val(slug);
        });
    </script>

    <script>
        $('input[name="image"]').on('change', function() {
            let file = this.files[0];

            if (file) {
                let reader = new FileReader();
                reader.onload = function(e) {
                    $('#preview')
                        .attr('src', e.target.result)
                        .removeClass('d-none');
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection
