@extends('admin.layouts.app')
@section('title', 'Edit Program | ' . config('app.name'))

@section('content')

    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4>Edit Program</h4>
            <a href="{{ route('admin.programs.index') }}" class="btn btn-secondary">
                <i class="fa fa-arrow-left"></i> Back
            </a>
        </div>

        <div class="card p-4 shadow-sm">

            <form id="programEditForm" enctype="multipart/form-data">
                @csrf
                <div class="row g-3">

                    <div class="col-md-6">
                        <label>Category</label>
                        <select name="category_id" class="form-control">
                            <option value=" ">Select Category</option>
                            @foreach ($categories as $cat)
                                <option value="{{ $cat->id }}" {{ $program->category_id == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                        <span class="text-danger error-category_id"></span>
                    </div>

                    <div class="col-md-6">
                        <label>Title</label>
                        <input type="text" name="title" value="{{ $program->title }}" class="form-control">
                        <span class="text-danger error-title"></span>
                    </div>

                    <!-- Label -->
                    <div class="col-md-6">
                        <label>Label</label>
                        <input type="text" name="label" value="{{ $program->label }}" class="form-control">
                        <span class="text-danger error-label"></span>
                    </div>

                    <!-- Thumbnail -->
                    <div class="col-md-6">
                        <label>Thumbnail</label>
                        <input type="file" name="thumbnail" class="form-control">
                        <span class="text-danger error-thumbnail"></span>

                        <!-- Current Image -->
                        <div class="mt-2">
                            <p class="mb-1">Current Image:</p>
                            <img id="preview" src="{{ asset('storage/' . $program->thumbnail) }}" width="120"
                                class="rounded border">
                        </div>
                    </div>

                    <!-- PDF -->
                    <div class="col-md-6">
                        <label>PDF (Max 100MB)</label>
                        <input type="file" name="pdf" class="form-control">
                        <span class="text-danger error-pdf"></span>

                        @if ($program->pdf)
                            <div class="mt-2">
                                <p class="mb-1">Current PDF:</p>
                                <a href="{{ asset('storage/' . $program->pdf) }}" target="_blank"
                                    class="btn btn-sm btn-info">
                                    View PDF
                                </a>
                            </div>
                        @endif
                    </div>

                    <!-- Submit -->
                    <div class="col-12 mt-3">
                        <button type="submit" class="btn btn-primary" id="updateBtn">
                            Update Program
                        </button>
                    </div>

                </div>
            </form>

        </div>
    </div>

@endsection


@section('scripts')
    <script>
        $("#programEditForm").submit(function(e) {
            e.preventDefault();

            let formData = new FormData(this);
            formData.append('_method', 'PUT');

            $(".text-danger").html('');

            $.ajax({
                url: "{{ route('admin.programs.update', $program->id) }}",
                type: "POST", // ✅ THIS WAS MISSING
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
                            timer: 2000,
                            timerProgressBar: true
                        }).then(() => {
                            window.location.href = res.redirect;
                        });
                    }
                },
                error: function(err) {
                    $('#updateBtn')
                        .html('Update Program')
                        .prop('disabled', false);

                    if (err.responseJSON && err.responseJSON.errors) {
                        $.each(err.responseJSON.errors, function(key, value) {
                            $(".error-" + key).html(value[0]);
                        });
                    } else {
                        console.log(err); // 🔥 see real error
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
                    $('#preview').attr('src', e.target.result);
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection
