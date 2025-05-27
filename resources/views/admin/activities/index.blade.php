@extends('admin.pages.dashboard')

@section('sub-section')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Activities</h4>
        <button class="btn btn-primary btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#createModal">
            + Add New Activity
        </button>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive scrollbar">
        <table class="table table-hover align-middle">
            <thead>
            <tr>
                <th scope="col">#ID</th>
                <th scope="col">Title</th>
                <th scope="col">Image</th>
                <th scope="col">Status</th>
                <th scope="col">Featured</th>
                <th scope="col">Created</th>
                <th scope="col" class="text-center">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($activities as $activity)
                <tr class="hover-actions-trigger">
                    <td class="align-middle">{{ $activity->id }}</td>
                    <td class="align-middle text-nowrap">{{ $activity->title }}</td>
                    <td class="align-middle">
                        @if($activity->featured_image)
                            <img src="{{ asset($activity->featured_image) }}" alt="Activity Image" width="80" height="60" style="object-fit: cover; border-radius: 0.25rem;">
                        @endif
                    </td>
                    <td class="align-middle">
                        <form action="{{ route('activities.toggleStatus', $activity->id) }}" method="POST">
                            @csrf
                            <select name="status"
                                    class="form-select form-select-sm w-auto {{ $activity->status ? 'bg-success text-white' : 'bg-danger text-white' }}"
                                    onchange="this.form.submit()">
                                <option value="1" {{ $activity->status ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ !$activity->status ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </form>
                    </td>
                    <td class="align-middle">
                        <form action="{{ route('activities.toggleFeatured', $activity->id) }}" method="POST">
                            @csrf
                            <select name="is_featured"
                                    class="form-select form-select-sm w-auto {{ $activity->is_featured ? 'bg-success text-dark' : '' }}"
                                    onchange="this.form.submit()">
                                <option value="0" {{ !$activity->is_featured ? 'selected' : '' }}>No</option>
                                <option value="1" {{ $activity->is_featured ? 'selected' : '' }}>Yes</option>
                            </select>
                        </form>
                    </td>
                    <td class="align-middle text-nowrap">{{ $activity->created_at->format('d-m-Y') }}</td>
                    <td class="align-middle text-center">
                        <div class="d-flex justify-content-center gap-1">
                            <!-- View Button -->
                            <button class="btn btn-sm"
                                    data-bs-toggle="modal"
                                    data-bs-target="#showModal{{ $activity->id }}"
                                    data-bs-toggle="tooltip"
                                    title="View">
                                <i class="fas fa-eye"></i>
                            </button>

                            <!-- Edit Button -->
                            <button class="btn btn-sm"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editModal{{ $activity->id }}"
                                    data-bs-toggle="tooltip"
                                    title="Edit">
                                <i class="fas fa-edit"></i>
                            </button>

                            <!-- Delete Button -->
                            <form action="{{ route('activities.destroy', $activity->id) }}"
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

                <!-- Show Modal -->
                <div class="modal fade" id="showModal{{ $activity->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 500px;">
                        <div class="modal-content position-relative">
                            <div class="position-absolute top-0 end-0 mt-2 me-2 z-1">
                                <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body p-0">
                                <div class="rounded-top-3 py-3 ps-4 pe-6 bg-light">
                                    <h4 class="mb-1">View Activity</h4>
                                </div>
                                <div class="p-4 pb-0">
                                    <p><strong>Title:</strong> {{ $activity->title }}</p>
                                    <p><strong>Content:</strong> {!! $activity->content !!}</p>
                                    <p><strong>Featured:</strong> {{ $activity->is_featured ? 'Yes' : 'No' }}</p>
                                    <p><strong>Status:</strong> {{ $activity->status ? 'Active' : 'Inactive' }}</p>
                                    @if($activity->featured_image)
                                        <p><strong>Image:</strong><br><img src="{{ asset($activity->featured_image) }}" width="100%" style="max-width: 300px;" alt="Activity Image"></p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Edit Modal -->
                <div class="modal fade" id="editModal{{ $activity->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 500px;">
                        <div class="modal-content position-relative">
                            <div class="position-absolute top-0 end-0 mt-2 me-2 z-1">
                                <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body p-0">
                                <div class="rounded-top-3 py-3 ps-4 pe-6 bg-light">
                                    <h4 class="mb-1">Edit Activity</h4>
                                </div>
                                <div class="p-4 pb-0">
                                    <form action="{{ route('activities.update', $activity->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="mb-3">
                                            <label class="form-label">Title</label>
                                            <input type="text" name="title" class="form-control" value="{{ $activity->title }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Content</label>
                                            <textarea name="content" class="form-control" required>{{ $activity->content }}</textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Is Featured</label>
                                            <select name="is_featured" class="form-select">
                                                <option value="1" {{ $activity->is_featured ? 'selected' : '' }}>Yes</option>
                                                <option value="0" {{ !$activity->is_featured ? 'selected' : '' }}>No</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Status</label>
                                            <select name="status" class="form-select">
                                                <option value="1" {{ $activity->status ? 'selected' : '' }}>Active</option>
                                                <option value="0" {{ !$activity->status ? 'selected' : '' }}>Inactive</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Featured Image</label>
                                            <input type="file" name="featured_image" class="form-control" accept="image/*">
                                            @if($activity->featured_image)
                                                <div class="mt-2">
                                                    <img src="{{ asset($activity->featured_image) }}" width="100" alt="Current Image" class="img-thumbnail">
                                                </div>
                                            @endif
                                        </div>
                                        <div class="modal-footer px-0">
                                            <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
                                            <button class="btn btn-primary" type="submit">Update Activity</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            </tbody>
        </table>
    </div>

    <!-- Create Modal -->
    <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 500px">
            <div class="modal-content position-relative">
                <div class="position-absolute top-0 end-0 mt-2 me-2 z-1">
                    <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-0">
                    <div class="rounded-top-3 py-3 ps-4 pe-6 bg-light">
                        <h4 class="mb-1">Add New Activity</h4>
                    </div>
                    <div class="p-4 pb-0">
                        <form action="{{ route('activities.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Title</label>
                                <input type="text" name="title" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Content</label>
                                <textarea name="content" class="form-control" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Is Featured</label>
                                <select name="is_featured" class="form-select">
                                    <option value="1">Yes</option>
                                    <option value="0" selected>No</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Status</label>
                                <select name="status" class="form-select">
                                    <option value="1" selected>Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Featured Image</label>
                                <input type="file" name="featured_image" class="form-control" accept="image/*">
                            </div>
                            <div class="modal-footer px-0">
                                <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
                                <button class="btn btn-primary" type="submit">Save Activity</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
