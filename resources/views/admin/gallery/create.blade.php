@extends('admin.layouts.app')
@section('title', 'Create Gallery | ' . config('app.name'))

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4>Create Gallery</h4>
            <a href="{{ route('admin.gallery.index') }}" class="btn btn-secondary">
                <i class="fa fa-arrow-left"></i> Back
            </a>
        </div>

        <div class="card p-4 shadow-sm">
            {{-- ===== CREATE FORM ===== --}}
            <form id="createForm" enctype="multipart/form-data">
                @csrf

                {{-- Title --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Title <span class="text-danger">*</span></label>
                    <input type="text" name="title" id="title" class="form-control"
                        placeholder="Enter gallery title">
                    <span class="text-danger small error-title"></span>
                </div>

                {{-- Section Key --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Section <span class="text-danger">*</span></label>
                    <select name="section_key" id="section_key" class="form-control">
                        <option value="">-- Select Section --</option>
                        <option value="slider">Slider</option>
                        <option value="international">International</option>
                        <option value="outstation">Outstation</option>
                        <option value="edufun">Edufun</option>
                        <option value="dayouting">Day Outing</option>
                    </select>
                    <span class="text-danger small error-section_key"></span>
                </div>

                {{-- Upload Box --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Images</label>
                    <label for="imageInput" class="border rounded p-4 text-center d-block"
                        style="border: 2px dashed #ccc !important; cursor: pointer; background: #f9fafb;">
                        <i class="fa fa-cloud-upload fa-2x text-muted mb-2 d-block"></i>
                        <p class="mb-1 text-muted">Click to select images</p>
                        <small class="text-muted">Multiple allowed · JPG, PNG, WEBP · Max 1MB each</small>
                        <input type="file" name="images[]" id="imageInput" style="display:none;" multiple
                            accept="image/jpeg,image/jpg,image/png,image/webp">
                    </label>
                    <span class="text-danger small error-images"></span>
                </div>

                {{-- Preview --}}
                <div class="d-flex flex-wrap gap-3 mb-4" id="previewArea"></div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Status <span class="text-danger">*</span></label>
                    <select name="status" id="status" class="form-control">
                        <option value="1" selected>Active</option>
                        <option value="0">Inactive</option>
                    </select>
                    <span class="text-danger small error-status"></span>
                </div>

                {{-- Buttons --}}
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary px-4" id="submitBtn">
                        <i class="fa fa-save"></i> Save Gallery
                    </button>
                </div>

            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {

            // ✅ Preview images on select
            $('#imageInput').on('change', function() {
                $('#previewArea').html('');
                $('.error-images').html('');

                let files = this.files;
                let allowed = ['image/jpeg', 'image/jpg', 'image/png', 'image/webp'];
                let valid = true;

                $.each(files, function(i, file) {

                    if (file.size > 1048576) {
                        $('.error-images').html('❌ "' + file.name + '" exceeds 1MB limit.');
                        valid = false;
                        return false;
                    }

                    if (!allowed.includes(file.type)) {
                        $('.error-images').html('❌ "' + file.name + '" is not a valid image type.');
                        valid = false;
                        return false;
                    }

                    let reader = new FileReader();
                    reader.onload = function(e) {
                        $('#previewArea').append(`
                            <div class="text-center" style="width:120px;">
                                <img src="${e.target.result}"
                                     style="width:120px;height:100px;object-fit:cover;
                                            border-radius:8px;border:2px solid #28a745;">
                                <small class="d-block text-muted mt-1"
                                       style="font-size:10px;word-break:break-all;line-height:1.3;">
                                    ${file.name}
                                </small>
                                <small class="text-success d-block" style="font-size:10px;">
                                    ${(file.size / 1024).toFixed(0)} KB ✓
                                </small>
                            </div>
                        `);
                    };
                    reader.readAsDataURL(file);
                });

                if (!valid) {
                    $('#imageInput').val('');
                    $('#previewArea').html('');
                }
            });

            // ✅ Submit form via AJAX
            $('#createForm').on('submit', function(e) {
                e.preventDefault();

                $('.error-title').html('');
                $('.error-section_key').html('');
                $('.error-images').html('');

                let formData = new FormData(this);
                
                $.ajax({
                    url: '{{ route('admin.gallery.store') }}',
                    type: 'POST',
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
                            .html('<i class="fa fa-save"></i> Save Gallery')
                            .prop('disabled', false);

                        let errors = err.responseJSON?.errors || {};

                        if (errors.title) $('.error-title').html(errors.title[0]);
                        if (errors.section_key) $('.error-section_key').html(errors.section_key[
                            0]);
                        if (errors.images) $('.error-images').html(errors.images[0]);
                        if (errors['images.0']) $('.error-images').html(errors['images.0'][0]);
                    }
                });
            });

        });
    </script>
@endsection
