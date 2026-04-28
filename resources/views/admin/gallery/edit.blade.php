@extends('admin.layouts.app')
@section('title', 'Edit Gallery | ' . config('app.name'))

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="mb-3">Edit Gallery</h4>
            <a href="{{ route('admin.gallery.index') }}" class="btn btn-secondary">
                <i class="fa fa-arrow-left"></i> Back
            </a>
        </div>

        <div class="card p-4 shadow-sm">

            {{-- Section Header --}}
            <div class="d-flex align-items-center gap-3 mb-4">
                <div>
                    <h4 class="mb-0">{{ $gallery->title }}</h4>
                    <small class="text-muted">Section: <code>{{ $gallery->section_key }}</code></small>
                </div>
                <span class="badge bg-primary ms-auto" id="imageCountBadge">
                    {{ $gallery->images->count() }} Images
                </span>
            </div>

            <hr>

            {{-- ===== EXISTING IMAGES ===== --}}
            <div class="mb-4">
                <label class="form-label fw-semibold mb-3">
                    Current Images
                    <small class="text-muted fw-normal">(Click ✕ to delete an image)</small>
                </label>

                <div class="d-flex flex-wrap gap-3" id="existingImagesArea">
                    @forelse($gallery->images as $img)
                        <div class="position-relative text-center existing-img-wrap" id="imgWrap{{ $img->id }}"
                            style="width:120px;">
                            <img src="{{ asset('storage/' . $img->image) }}"
                                style="width:120px;height:100px;object-fit:cover;
                                        border-radius:8px;border:2px solid #dee2e6;">
                            <button type="button"
                                class="btn btn-danger btn-sm position-absolute top-0 end-0 btn-remove-img"
                                style="width:24px;height:24px;padding:0;font-size:12px;
                                       line-height:1;border-radius:50%;transform:translate(50%,-50%);"
                                data-id="{{ $img->id }}"
                                data-route="{{ route('admin.gallery.image.delete', $img->id) }}">
                                ✕
                            </button>
                        </div>
                    @empty
                        <p class="text-muted" id="noImgMsg">No images uploaded yet.</p>
                    @endforelse
                </div>
            </div>

            <hr>

            {{-- ===== ADD NEW IMAGES ===== --}}
            <form id="editForm" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label class="form-label fw-semibold">Title</label>
                    <input type="text" name="title" class="form-control" value="{{ $gallery->title }}">
                    <span class="text-danger small error-title"></span>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Section Key</label>
                    <input type="text" name="section_key" class="form-control" value="{{ $gallery->section_key }}">
                    <span class="text-danger small error-section_key"></span>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Upload New Images</label>

                    {{-- ✅ Fixed: <label> wrapper so clicking anywhere opens file picker --}}
                    <label for="imageInput" class="border rounded p-4 text-center d-block"
                        style="border: 2px dashed #ccc !important; cursor: pointer; background: #f9fafb;">
                        <i class="fa fa-cloud-upload fa-2x text-muted mb-2 d-block"></i>
                        <p class="mb-1 text-muted">Click to select images</p>
                        <small class="text-muted">Multiple allowed · JPG, PNG, WEBP · Max 1MB each</small>

                        {{-- ✅ Fixed: added name="images[]" and multiple --}}
                        <input type="file" name="images[]" id="imageInput" style="display:none;" multiple
                            accept="image/jpeg,image/jpg,image/png,image/webp">
                    </label>

                    <span class="text-danger small error-images"></span>
                </div>

                {{-- New Image Previews --}}
                <div class="d-flex flex-wrap gap-3 mb-4" id="newPreviewArea"></div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Status <span class="text-danger">*</span></label>
                    <select name="status" id="status" class="form-control">
                        <option value="1" {{ $gallery->status == 1 ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ $gallery->status == 0 ? 'selected' : '' }}>Inactive</option>
                    </select>
                    <span class="text-danger small error-status"></span>
                </div>
                {{-- Buttons --}}
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary px-4" id="submitBtn">
                        <i class="fa fa-save"></i> Update Gallery
                    </button>
                </div>

            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {

            // ✅ Preview new images on select
            $('#imageInput').on('change', function() {
                $('#newPreviewArea').html('');
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
                        $('#newPreviewArea').append(`
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
                    $('#newPreviewArea').html('');
                }
            });

            // ✅ Delete single existing image
            $(document).on('click', '.btn-remove-img', function() {
                let id = $(this).data('id');
                let url = $(this).data('route');

                Swal.fire({
                    title: 'Delete this image?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    confirmButtonText: 'Yes, Delete!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: url,
                            type: 'GET',
                            success: function(res) {
                                if (res.status) {
                                    $('#imgWrap' + id).fadeOut(300, function() {
                                        $(this).remove();

                                        // ✅ Show "no images" message if all deleted
                                        if ($('.existing-img-wrap').length ===
                                            0) {
                                            $('#existingImagesArea').html(
                                                '<p class="text-muted" id="noImgMsg">No images uploaded yet.</p>'
                                            );
                                        }

                                        // ✅ Update badge count
                                        let count = $('.existing-img-wrap')
                                            .length;
                                        $('#imageCountBadge').text(count +
                                            ' Images');
                                    });

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
                            error: function() {
                                Swal.fire('Error!', 'Could not delete image.', 'error');
                            }
                        });
                    }
                });
            });

            // ✅ Upload new images via AJAX
            $('#editForm').on('submit', function(e) {
                e.preventDefault();
                $('.error-images').html('');

                // ✅ Check if any file is selected
                // if ($('#imageInput')[0].files.length === 0) {
                //     $('.error-images').html('❌ Please select at least one image to upload.');
                //     return;
                // }

                let formData = new FormData(this);

                $.ajax({
                    url: '{{ route('admin.gallery.update', $gallery->id) }}',
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,

                    beforeSend: function() {
                        $('#submitBtn')
                            .html('<i class="fa fa-spinner fa-spin"></i> Uploading...')
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
                            .html('<i class="fa fa-save"></i> Upload Images')
                            .prop('disabled', false);

                        let errors = err.responseJSON?.errors || {};
                        if (errors['images.0']) $('.error-images').html(errors['images.0'][0]);
                        if (errors.images) $('.error-images').html(errors.images[0]);
                    }
                });
            });

        });
    </script>
@endsection
