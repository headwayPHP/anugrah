@extends('admin.pages.dashboard')

@section('sub-section')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Students Management</h4>
        <button class="btn btn-primary btn-sm" type="button" data-bs-toggle="modal"
                data-bs-target="#create-student-modal">
            + Add New Student
        </button>
    </div>

    {{-- Course & Batch Filter --}}
    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('students.index') }}" id="filter-form">
                <div class="row">
                    <div class="col-md-5">
                        <label class="form-label">Filter by Course</label>
                        <select name="course_id" class="form-select" id="course-select">
                            <option value="">All Courses</option>
                            @foreach($courses as $course)
                                <option
                                    value="{{ $course->id }}" {{ $selectedCourse == $course->id ? 'selected' : '' }}>
                                    {{ $course->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-5">
                        <label class="form-label">Filter by Batch</label>
                        <select name="batch_id" class="form-select"
                                id="batch-select" {{ !$selectedCourse ? 'disabled' : '' }}>
                            <option value="">All Batches</option>
                            @if($selectedCourse)
                                @foreach($batches as $batch)
                                    <option
                                        value="{{ $batch->id }}" {{ $selectedBatch == $batch->id ? 'selected' : '' }}>
                                        {{ $batch->batch_name }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        @if($selectedCourse || $selectedBatch)
                            <a href="{{ route('students.index') }}" class="btn btn-sm btn-outline-secondary">
                                Clear Filters
                            </a>
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Students Table --}}
    <div class="table-responsive scrollbar">
        <table class="table table-hover align-middle">
            <thead>
            <tr>
                <th>#</th>
                <th>Student Name</th>
                <th>Batch</th>
                <th>Course</th>
                <th>Age</th>
                <th>Contact</th>
                <th>Kit Given</th>
                <th>Status</th>
                <th class="text-center">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($students as $i => $student)
                <tr class="hover-actions-trigger">
                    <td class="align-middle">{{ $i+1 }}</td>
                    <td class="align-middle">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#show-student-modal-{{ $student->id }}">
                            {{ $student->name }}
                        </a>
                    </td>
                    <td class="align-middle">{{ $student->batch->batch_name ?? 'N/A' }}</td>
                    <td class="align-middle">{{ $student->batch->course->title ?? 'N/A' }}</td>
                    <td class="align-middle">{{ $student->dob->age }} yrs</td>
                    <td class="align-middle">
                        <div>{{ $student->email }}</div>
                        <small class="text-muted">{{ $student->phone }}</small>
                    </td>
                    <td class="align-middle">
                        <form action="{{ route('students.toggle-kit', $student->id) }}" method="POST">
                            @csrf
                            <!-- Hidden fallback for unchecked state -->
                            <input type="hidden" name="kit_given" value="0">

                            <div class="form-check form-switch d-flex justify-content-center">
                                <input class="form-check-input" type="checkbox" role="switch"
                                       name="kit_given" value="1"
                                       {{ $student->kit_given == '1' ? 'checked' : '' }}
                                       onchange="this.form.submit()">
                            </div>
                        </form>
                    </td>

                    <td class="align-middle">
                        <form action="{{ route('students.toggle-status', $student->id) }}" method="POST">
                            @csrf
                            <select name="status"
                                    class="form-select form-select-sm w-auto {{ $student->status == '1' ? 'bg-success text-white' : 'bg-danger text-white' }}"
                                    onchange="this.form.submit()">
                                <option value="1" {{ $student->status == '1' ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ $student->status == '0' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </form>
                    </td>
                    <td class="align-middle text-center">
                        <div class="d-flex justify-content-center gap-1">
                            {{-- View Button --}}
                            <button class="btn btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#show-student-modal-{{ $student->id }}">
                                <i class="fas fa-eye"></i>
                            </button>

                            {{-- Edit Button --}}
                            <button class="btn btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#edit-student-modal-{{ $student->id }}">
                                <i class="fas fa-edit"></i>
                            </button>

                            {{-- Delete Button --}}
                            <form action="{{ route('students.destroy', $student->id) }}" method="POST"
                                  onsubmit="return confirm('Are you sure you want to delete this student?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm text-danger">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>

                {{-- Show Student Modal --}}
                <div class="modal fade" id="show-student-modal-{{ $student->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Student Details</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="text-center mb-4">
                                    <div class="avatar avatar-xl">
                                        <div class="avatar-name rounded-circle bg-soft-primary text-primary">
                                            <span>
    {{
        collect(explode(' ', $student->name))
            ->map(fn($part) => strtoupper(substr($part, 0, 1)))
            ->implode('')
    }}
</span>
                                        </div>
                                    </div>
                                    <h4 class="mt-2">{{ $student->name }}</h4>
                                    <p class="text-muted mb-0">
                                        {{ $student->batch->batch_name ?? 'N/A' }}
                                        • {{ $student->batch->course->title ?? 'N/A' }}
                                    </p>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label text-muted">Date of Birth</label>
                                        <p>{{ $student->dob->format('M d, Y') }} ({{ $student->dob->age }} years)</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label text-muted">Email</label>
                                        <p>{{ $student->email }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label text-muted">Phone</label>
                                        <p>{{ $student->phone }}</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label text-muted">Kit Status</label>
                                        <p>
                                                <span
                                                    class="badge {{ $student->kit_given == '1' ? 'bg-success' : 'bg-warning' }}">
                                                    {{ $student->kit_given == '1' ? 'Given' : 'Pending' }}
                                                </span>
                                        </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label text-muted">Account Status</label>
                                        <p>
                                                <span
                                                    class="badge {{ $student->status == '1' ? 'bg-success' : 'bg-danger' }}">
                                                    {{ $student->status == '1' ? 'Active' : 'Inactive' }}
                                                </span>
                                        </p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label text-muted">Joined On</label>
                                        <p>{{ $student->created_at->format('M d, Y') }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Edit Student Modal --}}
                <div class="modal fade" id="edit-student-modal-{{ $student->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Student</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                            </div>
                            <form action="{{ route('students.update', $student->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="course_id" value="{{ $selectedCourse }}">
                                <input type="hidden" name="batch_id" value="{{ $selectedBatch }}">
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label class="form-label">Full Name</label>
                                        <input type="text" name="name" class="form-control" value="{{ $student->name }}"
                                               required>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Email</label>
                                            <input type="email" name="email" class="form-control"
                                                   value="{{ $student->email }}" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Phone</label>
                                            <input type="text" name="phone" class="form-control"
                                                   value="{{ $student->phone }}" required>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Date of Birth</label>
                                        <input type="date" name="dob" class="form-control"
                                               value="{{ $student->dob->format('Y-m-d') }}"
                                               max="{{ now()->subYear()->format('Y-m-d') }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Batch</label>
                                        <select name="batch_id" class="form-select" required>
                                            @foreach($batches as $batch)
                                                <option value="{{ $batch->id }}"
                                                    {{ $student->batch_id == $batch->id ? 'selected' : '' }}>
                                                    {{ $batch->batch_name }} ({{ $batch->course->title }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel
                                    </button>
                                    <button type="submit" class="btn btn-primary">Update Student</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
            </tbody>
        </table>

        @if($students->isEmpty())
            <div class="alert alert-info">No students found for the selected criteria.</div>
        @endif
    </div>

    {{-- Create Student Modal --}}
    <div class="modal fade" id="create-student-modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create New Student</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('students.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="course_id" value="{{ $selectedCourse }}">
                    <input type="hidden" name="batch_id" value="{{ $selectedBatch }}">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Full Name</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                            @error('name')
                            <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" value="{{ old('email') }}"
                                       required>
                                @error('email')
                                <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Phone</label>
                                <input type="text" name="phone" class="form-control" value="{{ old('phone') }}"
                                       required>
                                @error('phone')
                                <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Date of Birth</label>
                            <input type="date" name="dob" class="form-control"
                                   value="{{ old('dob') }}"
                                   max="{{ now()->subYear()->format('Y-m-d') }}" required>
                            @error('dob')
                            <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Batch</label>
                            <select name="batch_id" class="form-select" required>
                                <option value="">Select Batch</option>
                                @foreach($batches as $batch)
                                    <option
                                        value="{{ $batch->id }}" {{ old('batch_id') == $batch->id ? 'selected' : '' }}>
                                        {{ $batch->batch_name }} ({{ $batch->course->title }})
                                    </option>
                                @endforeach
                            </select>
                            @error('batch_id')
                            <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Create Student</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Auto-open modals on validation errors --}}
    @if($errors->any())
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                @if(session('show_create_modal'))
                const createModal = new bootstrap.Modal(document.getElementById('create-student-modal'));
                createModal.show();
                @endif

                @if(session('edit_student_id'))
                const editModal = new bootstrap.Modal(document.getElementById('edit-student-modal-{{ session('edit_student_id') }}'));
                editModal.show();
                @endif
            });
        </script>
    @endif

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const courseSelect = document.getElementById('course-select');
            const batchSelect = document.getElementById('batch-select');
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

            courseSelect.addEventListener('change', function () {
                const courseId = courseSelect.value;

                if (courseId) {
                    batchSelect.disabled = true;
                    batchSelect.innerHTML = '<option value="">Loading batches...</option>';

                    fetch(`../admin/students?course_id=${courseId}`, {
                        headers: {
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': csrfToken
                        }
                    })
                        .then(response => {
                            console.log(response);
                            if (!response.ok) {
                                throw new Error(`HTTP error! status: ${response.status}`);
                            }
                            return response.json();
                        })
                        .then(data => {
                            console.log(data);
                            batchSelect.innerHTML = '';
                            if (data.length > 0) {

                                const defaultOption = document.createElement('option');
                                defaultOption.value = '';
                                defaultOption.textContent = 'All Batches';
                                batchSelect.appendChild(defaultOption);

                                data.forEach(batch => {
                                    const option = document.createElement('option');
                                    option.value = batch.id;
                                    option.textContent = batch.batch_name;
                                    batchSelect.appendChild(option);
                                });
                                batchSelect.disabled = false;
                            } else {
                                batchSelect.innerHTML = '<option value="">No batches available</option>';
                            }
                        })
                        .catch(error => {
                            console.error('Error fetching batches:', error);
                            batchSelect.innerHTML = '<option value="">Error loading batches</option>';
                            showToast('error', 'Failed to load batches. Please try again.');
                        });
                } else {
                    batchSelect.innerHTML = '<option value="">All Batches</option>';
                    batchSelect.disabled = true;
                    document.getElementById('filter-form').submit();
                }
            });

            batchSelect.addEventListener('change', function () {
                document.getElementById('filter-form').submit();
            });

            const modalTriggers = document.querySelectorAll('[data-bs-toggle="modal"]');
            modalTriggers.forEach(trigger => {
                trigger.addEventListener('click', function () {
                    const courseId = courseSelect.value;
                    const batchId = batchSelect.value;

                    const courseInput = document.querySelector('input[name="course_id"]');
                    const batchInput = document.querySelector('input[name="batch_id"]');

                    if (courseInput && courseId) courseInput.value = courseId;
                    if (batchInput && batchId) batchInput.value = batchId;
                });
            });

            function showToast(type, message) {
                // Replace this with your real toast logic
                console.log(`${type.toUpperCase()}: ${message}`);
            }
        });

        function initials(name) {
            return name.split(' ').map(part => part[0]).join('').toUpperCase();
        }
    </script>

@endsection
