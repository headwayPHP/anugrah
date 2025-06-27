@extends('admin.pages.dashboard')

@section('sub-section')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Edit Page</h4>
    </div>

    <div class="card p-4">
        <form action="{{ route('pages.update', $page->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Title</label>
                <input type="text" name="title" class="form-control" value="{{ old('title', $page->title) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Content</label>
                <textarea name="content" class="form-control" id="editor" rows="10" required>{{ old('content', $page->content) }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-select" required>
                    <option value="1" {{ $page->status == 1 ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ $page->status == 0 ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Image</label>
                <input type="file" name="image" class="form-control">

                @if ($page->image)
                    <img src="{{ asset($page->image) }}" alt="Page Image" class="img-thumbnail mt-2"
                        style="max-width: 200px;">
                @endif
            </div>

            <div class="modal-footer px-0">
                <a href="{{ route('pages.index') }}"><button class="btn btn-secondary" type="button"
                        data-bs-dismiss="modal">Cancel</button></a>
                <button class="btn btn-primary" type="submit">Update Page</button>
            </div>
        </form>
    </div>

    <!-- Include CKEditor script -->
    <script src="https://cdn.ckeditor.com/ckeditor5/34.0.0/classic/ckeditor.js"></script>

    <script>
        // Initialize CKEditor
        ClassicEditor
            .create(document.querySelector('#editor'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
