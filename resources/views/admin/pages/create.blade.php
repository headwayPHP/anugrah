@extends('admin.pages.dashboard')

@section('sub-section')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Create New Page</h4>
    </div>

    <div class="card p-4">
        <form action="{{ route('pages.store') }}" method="POST" enctype="multipart/form-data" id="pageForm">
            @csrf

            <!-- Title Field -->
            <div class="mb-3">
                <label class="form-label">Title</label>
                <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
            </div>

            <!-- Image Field -->
            <div class="mb-3">
                <label class="form-label">Image</label>
                <input type="file" name="image" class="form-control">
            </div>

            <!-- Content Field with CKEditor -->
            <div class="mb-3">
                <label class="form-label">Content</label>
                <!-- The textarea will be converted into CKEditor -->
                <textarea name="content" class="form-control" id="editor" rows="10"></textarea>
            </div>

            <!-- Status Field -->
            <div class="mb-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-select" required>
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>
            </div>

            <!-- Submit Button -->
            <div class="modal-footer px-0">
                <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
                <button class="btn btn-primary" type="submit">Save Page</button>
            </div>
        </form>
    </div>

    <!-- Include CKEditor script -->
    <script src="https://cdn.ckeditor.com/ckeditor5/34.0.0/classic/ckeditor.js"></script>

    <script>
        // Initialize CKEditor
        ClassicEditor
            .create(document.querySelector('#editor'))
            .then(editor => {
                // On form submit, ensure CKEditor content is transferred to the textarea
                document.querySelector('form').onsubmit = function() {
                    // Update the textarea with CKEditor's content before submission
                    document.querySelector('textarea[name="content"]').value = editor.getData();
                };
            })
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
