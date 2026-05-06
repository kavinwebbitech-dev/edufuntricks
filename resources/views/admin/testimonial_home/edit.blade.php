@extends('admin.layouts.app')

@section('content')
    <div class="container">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4>Edit Testimonial</h4>
            <a href="{{ route('admin.testimonialshome.index') }}" class="btn btn-secondary">
                <i class="fa fa-arrow-left"></i> Back
            </a>
        </div>

        <div class="card p-4 shadow-sm">

            <form id="testimonialForm" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row g-3">

                    <!-- Name -->
                    <div class="col-md-6">
                        <label>Name</label>
                        <input type="text" name="name" value="{{ $data->name }}" class="form-control">
                        <span class="text-danger error-name"></span>
                    </div>

                    <!-- Designation -->
                    <div class="col-md-6">
                        <label>Designation</label>
                        <input type="text" name="designation" value="{{ $data->designation }}" class="form-control">
                        <span class="text-danger error-designation"></span>
                    </div>

                    <!-- Message -->
                    <div class="col-md-12">
                        <label>Message</label>
                        <textarea name="message" class="form-control" rows="4">{{ $data->message }}</textarea>
                        <span class="text-danger error-message"></span>
                    </div>

                    <!-- Status -->
                    <div class="col-md-6">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            <option value="1" {{ $data->status == 1 ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ $data->status == 0 ? 'selected' : '' }}>Inactive</option>
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
                            <img id="preview"
                                 src="{{ $data->image ? asset('storage/'.$data->image) : '' }}"
                                 width="120"
                                 class="rounded border {{ $data->image ? '' : 'd-none' }}">
                        </div>
                    </div>

                    <!-- Submit -->
                    <div class="col-12 mt-3">
                        <button type="submit" class="btn btn-success" id="submitBtn">
                            <i class="fa fa-save"></i> Update Testimonial
                        </button>
                    </div>

                </div>

            </form>

        </div>
    </div>
@endsection

@section('scripts')
<script>
    $("#testimonialForm").submit(function(e) {
        e.preventDefault();

        let formData = new FormData(this);
        formData.append('_method', 'PUT');
        $(".text-danger").html('');

        $.ajax({
            url: "{{ route('admin.testimonialshome.update', $data->id) }}",
            type: "POST", // Laravel spoof PUT
            data: formData,
            contentType: false,
            processData: false,

            beforeSend: function() {
                $('#submitBtn')
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
                        window.location.href = res.redirect;
                    });
                }
            },

            error: function(err) {
                $('#submitBtn')
                    .html('<i class="fa fa-save"></i> Update Testimonial')
                    .prop('disabled', false);

                if (err.responseJSON && err.responseJSON.errors) {
                    let errors = err.responseJSON.errors;

                    if (errors.name) $(".error-name").html(errors.name[0]);
                    if (errors.designation) $(".error-designation").html(errors.designation[0]);
                    if (errors.message) $(".error-message").html(errors.message[0]);
                    if (errors.image) $(".error-image").html(errors.image[0]);
                    if (errors.status) $(".error-status").html(errors.status[0]);
                } else {
                    alert("Server Error");
                }
            }
        });
    });

    // ✅ Image Preview Change
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