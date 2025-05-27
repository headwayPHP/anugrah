@extends('admin.pages.dashboard')

@section('sub-section')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Edit Photo</h4>
        <a href="{{ route('photos.index') }}" class="btn btn-secondary btn-sm">← Back to Gallery</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('photos.update', $photo->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('POST')

                <div class="mb-3">
                    <label class="form-label">Title</label>
                    <input type="text" name="title" value="{{ old('title', $photo->title) }}"
                           class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Alt Text</label>
                    <input type="text" name="alt_text" value="{{ old('alt_text', $photo->alt_text) }}"
                           class="form-control" required>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Current Image</label><br>
                        <img src="{{ asset('images/photos/' . $photo->image) }}"
                             alt="{{ $photo->alt_text }}"
                             width="120" class="img-thumbnail" id="currentImage">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">New Image Preview</label><br>
                        <img src="" id="previewImage" class="img-thumbnail d-none" width="120" style=" object-fit: contain;">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Change Image (optional)</label>
                    <input type="file" name="image" class="form-control" accept="image/*" onchange="previewSelectedImage(event)">
                </div>

                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select" required>
                        <option value="1" {{ $photo->status == 1 ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ $photo->status == 0 ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Featured</label>
                    <select name="is_featured" class="form-select" required>
                        <option value="0" {{ $photo->is_featured == 0 ? 'selected' : '' }}>No</option>
                        <option value="1" {{ $photo->is_featured == 1 ? 'selected' : '' }}>Yes</option>
                    </select>
                </div>

                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save me-1"></i>Update Photo
                    </button>
{{--                    <a href="{{ route('photos.show', $photo->id) }}" class="btn btn-outline-primary">View</a>--}}
                </div>
            </form>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            window.previewSelectedImage = function (event) {
                const input = event.target;
                const preview = document.getElementById('previewImage');

                if (input.files && input.files[0]) {
                    const reader = new FileReader();

                    reader.onload = function (e) {
                        preview.src = e.target.result;
                        preview.classList.remove('d-none');
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            };
        });
    </script>
@endsection



