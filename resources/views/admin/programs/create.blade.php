@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4>Create Program</h4>
            <a href="{{ route('admin.programs.index') }}" class="btn btn-secondary">
                <i class="fa fa-arrow-left"></i> Back
            </a>
        </div>

        <div class="card p-4 shadow-sm">

            <form id="programForm" enctype="multipart/form-data">
                @csrf

                <div class="row g-3">
                    <div class="col-md-6">
                        <label>Category</label>
                        <select name="category_id" class="form-control">
                            <option value="">Select Category</option>
                            @foreach ($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger error-category_id"></span>
                    </div>

                    <!-- Title -->
                    <div class="col-md-6">
                        <label>Title</label>
                        <input type="text" name="title" class="form-control">
                        <span class="text-danger error-title"></span>
                    </div>

                    <!-- Label -->
                    <div class="col-md-6">
                        <label>Label</label>
                        <input type="text" name="label" class="form-control">
                        <span class="text-danger error-label"></span>
                    </div>

                    <!-- Thumbnail -->
                    <div class="col-md-6">
                        <label>Thumbnail</label>
                        <input type="file" name="thumbnail" class="form-control">
                        <span class="text-danger error-thumbnail"></span>

                        <img id="preview" width="120" class="mt-2 d-none" />
                    </div>

                    <!-- PDF -->
                    <div class="col-md-6">
                        <label>PDF (Max 100MB)</label>
                        <input type="file" name="pdf" class="form-control">
                        <span class="text-danger error-pdf"></span>
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-success" id="submitBtn">Save</button>
                    </div>

                </div>
            </form>
        </div>
    </div>
@endsection


@section('scripts')
    <script>
        $("#programForm").submit(function(e) {
            e.preventDefault();

            let formData = new FormData(this);
            $(".text-danger").html('');

            $.ajax({
                url: "{{ route('admin.programs.store') }}",
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
                        .html('<i class="fa fa-save"></i> Save programs')
                        .prop('disabled', false);

                    if (err.responseJSON && err.responseJSON.errors) {
                        let errors = err.responseJSON.errors;

                        if (errors.title) $(".error-title").html(errors.title[0]);
                        if (errors.label) $(".error-label").html(errors.label[0]);
                        if (errors.thumbnail) $(".error-thumbnail").html(errors.thumbnail[0]);
                        if (errors.pdf) $(".error-pdf").html(errors.pdf[0]);
                        if (errors.category_id) $(".error-category_id").html(errors.category_id[0]);
                    } else {
                        alert("Server Error");
                    }
                }
            });
        });


        // ✅ Image Preview
        $('input[name="thumbnail"]').on('change', function() {
            let file = this.files[0];

            if (file) {
                let reader = new FileReader();
                reader.onload = function(e) {
                    $('#preview').attr('src', e.target.result).removeClass('d-none');
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection
