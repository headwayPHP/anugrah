@extends('admin.pages.dashboard')

@section('sub-section')
    @php
        $posts = \App\Models\SocialMediaPost::latest()->get();
    @endphp

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Social Media Posts</h4>
        <button class="btn btn-primary btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#createPostModal">
            + Add New Post
        </button>
    </div>

    <div class="table-responsive scrollbar">
        <table class="table table-hover align-middle">
            <thead>
            <tr>
                <th scope="col">#ID</th>
                <th scope="col">Title</th>
                <th scope="col">URL</th>
                <th scope="col">Banner</th>
                <th scope="col">Date</th>
                <th scope="col">Status</th>
                <th scope="col">Created</th>
                <th scope="col" class="text-center">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($posts as $i => $post)
                <tr class="hover-actions-trigger">
                    <td class="align-middle">{{ $i+1 }}</td>
                    <td class="align-middle text-nowrap">{{ $post->title }}</td>

                    <td class="align-middle">
                        <a href="{{ $post->url }}" target="_blank" class="text-truncate" style="max-width: 150px; display: inline-block;">
                            {{ $post->url }}
                        </a>
                    </td>

                    <td class="align-middle">
                        @if($post->banner)
                            <img src="{{ asset($post->banner) }}" alt="{{ $post->title }}" width="80" height="60" style="object-fit: cover; border-radius: 0.25rem;">
                        @else
                            <span class="text-muted">No banner</span>
                        @endif
                    </td>

                    <td class="align-middle text-nowrap">{{ \Carbon\Carbon::parse($post->date)->format('d-m-Y') }}</td>

                    <td class="align-middle">
                        <form action="{{ route('social-posts.status', $post->id) }}" method="POST">
                            @csrf
                            <select name="status"
                                    class="form-select form-select-sm w-auto {{ $post->status == '1' ? 'bg-success text-white' : 'bg-danger text-white' }}"
                                    onchange="this.form.submit()">
                                <option value="1" {{ $post->status == '1' ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ $post->status == '0' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </form>
                    </td>

                    <td class="align-middle text-nowrap">{{ \Carbon\Carbon::parse($post->created_at)->format('d-m-Y') }}</td>

                    <td class="align-middle text-center">
                        <div class="d-flex justify-content-center gap-1">
                            {{-- Edit --}}
                            <button class="btn btn-sm"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editPostModal{{ $post->id }}"
                                    title="Edit">
                                <i class="fas fa-edit"></i>
                            </button>

                            {{-- Delete --}}
                            <form action="{{ route('social-posts.destroy', $post->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('Are you sure you want to delete this post?')"
                                  style="display: inline-block;">
                                @csrf
                                @method('POST')
                                <button type="submit"
                                        class="btn btn-sm"
                                        title="Delete">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>

                <!-- Edit Modal for each post -->
                <div class="modal fade" id="editPostModal{{ $post->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 500px">
                        <div class="modal-content position-relative">
                            <div class="position-absolute top-0 end-0 mt-2 me-2 z-1">
                                <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body p-0">
                                <div class="rounded-top-3 py-3 ps-4 pe-6 bg-light">
                                    <h4 class="mb-1">Edit Post</h4>
                                </div>
                                <div class="p-4 pb-0">
                                    <form action="{{ route('social-posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('POST')
                                        <div class="mb-3">
                                            <label class="form-label">Title</label>
                                            <input type="text" name="title" class="form-control" value="{{ $post->title }}" required>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">URL</label>
                                            <input type="url" name="url" class="form-control" value="{{ $post->url }}" required>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Date</label>
                                            <input type="date" name="date" class="form-control" value="{{ \Carbon\Carbon::parse($post->date)->format('Y-m-d') }}" required>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Banner Image</label>
                                            <input type="file" name="banner" class="form-control" accept="image/*">
                                            @if($post->banner)
                                                <div class="mt-2">
                                                    <small>Current banner:</small>
                                                    <img src="{{ asset($post->banner) }}" alt="Current banner" width="100" class="d-block mt-1">
                                                </div>
                                            @endif
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Status</label>
                                            <select name="status" class="form-select" required>
                                                <option value="1" {{ $post->status == '1' ? 'selected' : '' }}>Active</option>
                                                <option value="0" {{ $post->status == '0' ? 'selected' : '' }}>Inactive</option>
                                            </select>
                                        </div>

                                        <div class="modal-footer px-0">
                                            <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
                                            <button class="btn btn-primary" type="submit">Update Post</button>
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
    <div class="modal fade" id="createPostModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 500px">
            <div class="modal-content position-relative">
                <div class="position-absolute top-0 end-0 mt-2 me-2 z-1">
                    <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-0">
                    <div class="rounded-top-3 py-3 ps-4 pe-6 bg-light">
                        <h4 class="mb-1">Add New Post</h4>
                    </div>
                    <div class="p-4 pb-0">
                        <form action="{{ route('social-posts.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Title</label>
                                <input type="text" name="title" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">URL</label>
                                <input type="url" name="url" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Date</label>
                                <input type="date" name="date" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Banner Image</label>
                                <input type="file" name="banner" class="form-control" accept="image/*">
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
                                <button class="btn btn-primary" type="submit">Save Post</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
