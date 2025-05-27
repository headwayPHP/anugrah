@extends('admin.pages.dashboard')

@section('sub-section')

    @php
        $courses = \App\Models\Course::latest()->get();
    @endphp

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Courses Management</h4>
        <!-- Button to open modal for creating course -->
        <button class="btn btn-primary btn-sm" type="button" data-bs-toggle="modal"
                data-bs-target="#create-course-modal">
            + Add New Course
        </button>
    </div>

    <div class="table-responsive scrollbar">
        <table class="table table-hover align-middle">
            <thead>
            <tr>
                <th>#ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Level</th>
                <th>Language</th>
                <th>Duration (weeks)</th>
                <th>Status</th>
                <th>Created</th>
                <th class="text-center">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($courses as $i => $course)
                <tr class="hover-actions-trigger">
                    <td class="align-middle">{{ $i+1 }}</td>
                    <td class="align-middle text-nowrap">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#show-course-modal-{{ $course->id }}">
                            {{ $course->title }}
                        </a>
                    </td>
                    <td class="align-middle">{{ Str::limit($course->desc, 50) ?? 'N/A' }}</td>
                    <td class="align-middle text-nowrap">{{ $course->level ?? 'N/A' }}</td>
                    <td class="align-middle text-nowrap">{{ $course->language ?? 'N/A' }}</td>
                    <td class="align-middle">{{ $course->duration_weeks ?? '—' }}</td>
                    <td class="align-middle">
                        <form action="{{ route('courses.toggle-status', $course->id) }}" method="POST">
                            @csrf
                            <select name="status"
                                    class="form-select form-select-sm w-auto {{ $course->status == 1 ? 'bg-success text-white' : 'bg-danger text-white' }} "
                                    onchange="this.form.submit()">
                                <option value="1" {{ $course->status == 1 ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ $course->status == 0 ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </form>
                    </td>
                    <td class="align-middle text-nowrap">{{ \Carbon\Carbon::parse($course->created_at)->format('d-m-Y') }}</td>
                    <td class="align-middle text-center">
                        <div class="d-flex justify-content-center gap-1">
                            <!-- View Button -->
                            <button class="btn btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#show-course-modal-{{ $course->id }}">
                                <i class="fas fa-eye"></i>
                            </button>

                            <!-- Edit Button -->
                            <button class="btn btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#edit-course-modal-{{ $course->id }}">
                                <i class="fas fa-edit"></i>
                            </button>

                            <!-- Delete Button -->
                            <form action="{{ route('courses.destroy', $course->id) }}" method="POST"
                                  onsubmit="return confirm('Are you sure you want to delete this course?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm text-danger" data-bs-toggle="tooltip"
                                        title="Delete">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>

                {{-- Show Modal for each course --}}
                <div class="modal fade" id="show-course-modal-{{ $course->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 600px">
                        <div class="modal-content position-relative">
                            <div class="position-absolute top-0 end-0 mt-2 me-2 z-1">
                                <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base"
                                        data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body p-0">
                                <div class="rounded-top-3 py-3 ps-4 pe-6 bg-light">
                                    <h4 class="mb-1">Course Details</h4>
                                </div>
                                <div class="p-4">
                                    @if($course->image)
                                        <div class="text-center mb-4">
                                            <img src="{{ asset('images/courses/' . $course->image) }}" alt="Course Image" class="img-fluid rounded" style="max-height: 200px;">
                                        </div>
                                    @endif
                                    <div class="mb-3">
                                        <h5>{{ $course->title }}</h5>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label text-muted">Description</label>
                                        <p>{{ $course->desc ?? 'N/A' }}</p>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label text-muted">Level</label>
                                            <p>{{ $course->level ?? 'N/A' }}</p>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label text-muted">Language</label>
                                            <p>{{ $course->language ?? 'N/A' }}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label text-muted">Duration</label>
                                            <p>{{ $course->duration_weeks ? $course->duration_weeks.' weeks' : 'N/A' }}</p>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label text-muted">Status</label>
                                            <p>
                                                <span class="badge {{ $course->status == 1 ? 'bg-success' : 'bg-danger' }}">
                                                    {{ $course->status == 1 ? 'Active' : 'Inactive' }}
                                                </span>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label text-muted">Created At</label>
                                        <p>{{ $course->created_at->format('M d, Y h:i A') }}</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Edit Modal for each course --}}
                <div class="modal fade" id="edit-course-modal-{{ $course->id }}" tabindex="-1" role="dialog"
                     aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 600px">
                        <div class="modal-content position-relative">
                            <div class="position-absolute top-0 end-0 mt-2 me-2 z-1">
                                <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base"
                                        data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body p-0">
                                <div class="rounded-top-3 py-3 ps-4 pe-6 bg-light">
                                    <h4 class="mb-1">Edit Course</h4>
                                </div>
                                <div class="p-4 pb-0">
                                    <form action="{{ route('courses.update', $course->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="mb-3">
                                            <label class="form-label">Title</label>
                                            <input type="text" name="title" class="form-control"
                                                   value="{{ $course->title }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Description</label>
                                            <textarea name="desc" class="form-control" rows="3">{{ $course->desc }}</textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Level</label>
                                            <input type="text" name="level" class="form-control"
                                                   value="{{ $course->level }}">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Image</label>
                                            <input type="file" accept="image/*" name="image" class="form-control"
                                                   value="{{ $course->image }}">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Language</label>
                                            <input type="text" name="language" class="form-control"
                                                   value="{{ $course->language }}">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Duration (weeks)</label>
                                            <input type="number" name="duration_weeks" class="form-control"
                                                   value="{{ $course->duration_weeks }}">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                Close
                                            </button>
                                            <button type="submit" class="btn btn-primary">Update Course</button>
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

        @if ($errors->any())
            <script>
                $(document).ready(function() {
                    @if(session('show_create_modal'))
                    $('#create-course-modal').modal('show');
                    @endif
                    @if(session('edit_course_id'))
                    $('#edit-course-modal-{{ session('edit_course_id') }}').modal('show');
                    @endif
                });
            </script>
        @endif
    </div>

    {{-- Create Modal --}}
    <div class="modal fade" id="create-course-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 600px">
            <div class="modal-content position-relative">
                <div class="position-absolute top-0 end-0 mt-2 me-2 z-1">
                    <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base"
                            data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-0">
                    <div class="rounded-top-3 py-3 ps-4 pe-6 bg-light">
                        <h4 class="mb-1">Add New Course</h4>
                    </div>
                    <div class="p-4 pb-0">
                        <form action="{{ route('courses.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Title</label>
                                <input type="text" name="title" class="form-control" required>
                                @error('title')
                                <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <textarea name="desc" class="form-control" rows="3"></textarea>
                                @error('desc')
                                <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Level</label>
                                <input type="text" name="level" class="form-control">
                                @error('level')
                                <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Image</label>
                                <input type="file" accept="image/*" name="image" class="form-control">
                                @error('image')
                                <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Language</label>
                                <input type="text" name="language" class="form-control">
                                @error('language')
                                <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Duration (weeks)</label>
                                <input type="number" name="duration_weeks" class="form-control">
                                @error('duration_weeks')
                                <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Create Course</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
