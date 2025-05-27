@extends('admin.pages.dashboard')

@section('sub-section')
    @php
        $photos = \App\Models\Photo::latest()->get();
    @endphp

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Photo Gallery</h4>
        <!-- Button to launch modal -->
        <button class="btn btn-primary btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#addPhotoModal">
            + Add New Photo
        </button>

        <!-- Modal -->
        <div class="modal fade" id="addPhotoModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 500px">
                <div class="modal-content position-relative">
                    <div class="position-absolute top-0 end-0 mt-2 me-2 z-1">
                        <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-0">
                        <div class="rounded-top-3 py-3 ps-4 pe-6 bg-light">
                            <h4 class="mb-1">Add New Photo</h4>
                        </div>
                        <div class="p-4 pb-0">
                            <form action="{{ route('photos.create') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">Title</label>
                                    <input type="text" name="title" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Alt Text</label>
                                    <input type="text" name="alt_text" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Photo</label>
                                    <input type="file" name="image" class="form-control" accept="image/*" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Status</label>
                                    <select name="status" class="form-select" required>
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>

                                <div class="modal-footer px-0">
                                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
                                    <button class="btn btn-primary" type="submit">Save Photo</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="table-responsive scrollbar">
        <table class="table table-hover align-middle">
            <thead>
            <tr>
                <th scope="col">#ID</th>
                <th scope="col">Title</th>
                <th scope="col">Image</th>
                <th scope="col">Alt Text</th>
                <th scope="col">Status</th>
                <th scope="col">Featured</th>
                <th scope="col">Created</th>
                <th scope="col" class="text-center">Actions</th>
            </tr>
            </thead>
            <tbody>

            @foreach($photos as $i => $photo)
                <tr class="hover-actions-trigger">
                    <td class="align-middle">{{ $i+1 }}</td>
                    <td class="align-middle text-nowrap">{{ $photo->title }}</td>

                    <td class="align-middle">
                        <img src="{{ asset('images/photos/' . $photo->image) }}" alt="{{ $photo->alt_text }}{{ asset('images/photos/' . $photo->image) }}" alt="{{ $photo->alt_text }}" width="80" height="60" style="object-fit: cover; border-radius: 0.25rem;">
                    </td>

                    <td class="align-middle text-nowrap">{{ $photo->alt_text }}</td>

                    <td class="align-middle">
                        <form action="{{ route('photos.statusUpdate', $photo->id) }}" method="POST">
                            @csrf
                            <select name="status"
                                    class="form-select form-select-sm w-auto {{ $photo->status == '1' ? 'bg-success text-white' : 'bg-danger text-white' }}"
                                    onchange="this.form.submit()">
                                <option value="1" {{ $photo->status == '1' ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ $photo->status == '0' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </form>
                    </td>
                    <td class="align-middle">
                        <form action="{{ route('photos.isFeaturedToggle', $photo->id) }}" method="POST">
                            @csrf
                            @method('POST')
                            <select name="is_featured"
                                    class="form-select form-select-sm w-auto {{ $photo->is_featured ? 'bg-success text-dark' : '' }}"
                                    onchange="this.form.submit()">
                                <option value="0" {{ $photo->is_featured == 0 ? 'selected' : '' }}>No</option>
                                <option value="1" {{ $photo->is_featured == 1 ? 'selected' : '' }}>Yes</option>
                            </select>
                        </form>
                    </td>

                    <td class="align-middle text-nowrap">{{ \Carbon\Carbon::parse($photo->created_at)->format('d-m-Y') }}</td>

                    <td class="align-middle text-center">
                        <div class="d-flex justify-content-center gap-1">
                            {{-- View --}}
                            <a href="{{ url('admin/photos/' . $photo->id) }}"
                               class="btn btn-sm "
                               data-bs-toggle="tooltip"
                               title="View">
                                <i class="fas fa-eye"></i>
                            </a>

                            {{-- Edit --}}
                            <a href="{{ url('admin/photos/' . $photo->id . '/edit') }}"
                               class="btn btn-sm "
                               data-bs-toggle="tooltip"
                               title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>

                            {{-- Delete --}}
                            <form action="{{ url('admin/photos/' . $photo->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('Are you sure?')"
                                  style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="btn btn-sm"
                                        data-bs-toggle="tooltip"
                                        title="Delete">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>
@endsection

