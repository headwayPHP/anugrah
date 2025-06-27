@extends('admin.pages.dashboard')

@section('sub-section')
    @php
        $modes = ['Online', 'Offline', 'Hybrid'];
        $daysOfWeek = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
    @endphp

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Batches Management</h4>
        <button class="btn btn-primary btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#create-batch-modal">
            + Add New Batch
        </button>
    </div>

    {{-- Course Filter --}}
    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('batches.index') }}">
                <div class="row">
                    <div class="col-md-8">
                        <label class="form-label">Filter by Course</label>
                        <select name="course_id" class="form-select" onchange="this.form.submit()">
                            <option value="">All Courses</option>
                            @foreach ($courses as $course)
                                <option value="{{ $course->id }}" {{ $selectedCourse == $course->id ? 'selected' : '' }}>
                                    {{ $course->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @if ($selectedCourse)
                        <div class="col-md-4 d-flex align-items-end">
                            <a href="{{ route('batches.index') }}" class="btn btn-sm btn-outline-secondary">
                                Clear Filter
                            </a>
                        </div>
                    @endif
                </div>
            </form>
        </div>
    </div>

    {{-- Batches Table --}}
    <div class="table-responsive scrollbar">
        <table class="table table-hover align-middle">
            <thead>
                <tr class="bg-grey text-black">
                    <th>#</th>
                    <th>Batch Name</th>
                    <th>Course</th>
                    <th>Date Range</th>
                    <th>Schedule</th>
                    <th>Mode</th>
                    <th>Status</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($batches as $i => $batch)
                    <tr class="hover-actions-trigger {{ $loop->odd ? 'bg-light' : '' }}">
                        <td class="align-middle">{{ $i + 1 }}</td>
                        <td class="align-middle">
                            <a href="#" data-bs-toggle="modal" data-bs-target="#show-batch-modal-{{ $batch->id }}">
                                {{ $batch->batch_name }}
                            </a>
                        </td>
                        <td class="align-middle">{{ $batch->course->title ?? 'N/A' }}</td>
                        <td class="align-middle">
                            {{ $batch->start_date->format('M d, Y') }} -
                            {{ $batch->end_date->format('M d, Y') }}
                        </td>
                        <td class="align-middle">
                            @if ($batch->day_of_week && $batch->time)
                                {{ $batch->day_of_week }}<br>
                                {{ $batch->time }}
                            @else
                                —
                            @endif
                        </td>
                        <td class="align-middle">{{ $batch->mode ?? '—' }}</td>
                        <td class="align-middle">
                            <form action="{{ route('batches.toggle-status', $batch->id) }}" method="POST">
                                @csrf
                                <select name="status"
                                    class="form-select form-select-sm w-auto {{ $batch->status == 1 ? 'bg-success text-white' : 'bg-danger text-white' }}"
                                    onchange="this.form.submit()">
                                    <option value="1" {{ $batch->status == 1 ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ $batch->status == 0 ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </form>
                        </td>
                        <td class="align-middle text-center">
                            <div class="d-flex justify-content-center gap-1">
                                {{-- View Button --}}
                                <button class="btn btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#show-batch-modal-{{ $batch->id }}">
                                    <i class="fas fa-eye"></i>
                                </button>

                                {{-- Edit Button --}}
                                <button class="btn btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#edit-batch-modal-{{ $batch->id }}">
                                    <i class="fas fa-edit"></i>
                                </button>

                                {{-- Delete Button --}}
                                <form action="{{ route('batches.destroy', $batch->id) }}" method="POST"
                                    onsubmit="return confirm('Are you sure you want to delete this batch?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm ">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>

                    {{-- Show Batch Modal --}}
                    <div class="modal fade" id="show-batch-modal-{{ $batch->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Batch Details</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <h6>{{ $batch->batch_name }}</h6>
                                        <small class="text-muted">{{ $batch->course->title ?? 'N/A' }}</small>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label text-muted">Start Date</label>
                                            <p>{{ $batch->start_date->format('M d, Y') }}</p>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label text-muted">End Date</label>
                                            <p>{{ $batch->end_date->format('M d, Y') }}</p>
                                        </div>
                                    </div>
                                    @if ($batch->day_of_week || $batch->time)
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label text-muted">Days</label>
                                                <p>{{ $batch->day_of_week ?? '—' }}</p>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label text-muted">Time</label>
                                                <p>{{ $batch->time ?? '—' }}</p>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label text-muted">Mode</label>
                                            <p>{{ $batch->mode ?? '—' }}</p>
                                        </div>
                                        @if ($batch->location)
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label text-muted">Location</label>
                                                <p>{{ $batch->location }}</p>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label text-muted">Status</label>
                                            <span class="badge {{ $batch->status == 1 ? 'bg-success' : 'bg-danger' }}">
                                                {{ $batch->status == 1 ? 'Active' : 'Inactive' }}
                                            </span>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label text-muted">Created At</label>
                                            <p>{{ $batch->created_at->format('M d, Y h:i A') }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Edit Batch Modal --}}
                    <div class="modal fade" id="edit-batch-modal-{{ $batch->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Batch</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form action="{{ route('batches.update', $batch->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label class="form-label">Batch Name</label>
                                            <input type="text" name="batch_name" class="form-control"
                                                value="{{ $batch->batch_name }}" required>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Start Date</label>
                                                <input type="date" name="start_date" class="form-control"
                                                    value="{{ $batch->start_date->format('Y-m-d') }}" required>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">End Date</label>
                                                <input type="date" name="end_date" class="form-control"
                                                    value="{{ $batch->end_date->format('Y-m-d') }}" required>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Days of Week</label>
                                            <select name="day_of_week[]" class="form-select" multiple>
                                                @foreach ($daysOfWeek as $day)
                                                    <option value="{{ $day }}"
                                                        {{ in_array($day, $batch->days_array) ? 'selected' : '' }}>
                                                        {{ $day }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <small class="text-muted">Hold Ctrl/Cmd to select multiple days</small>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Time</label>
                                            <input type="text" name="time" class="form-control"
                                                value="{{ $batch->time }}" placeholder="e.g., 10:00 AM - 12:00 PM">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Mode</label>
                                            <select name="mode" class="form-select">
                                                <option value="">Select Mode</option>
                                                @foreach ($modes as $mode)
                                                    <option value="{{ $mode }}"
                                                        {{ $batch->mode == $mode ? 'selected' : '' }}>{{ $mode }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Location</label>
                                            <input type="text" name="location" class="form-control"
                                                value="{{ $batch->location }}"
                                                placeholder="Only for Offline/Hybrid modes">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel
                                        </button>
                                        <button type="submit" class="btn btn-primary">Update Batch</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>

        @if ($batches->isEmpty())
            <div class="alert alert-info">No batches found for the selected criteria.</div>
        @endif
    </div>

    {{-- Create Batch Modal --}}
    <div class="modal fade" id="create-batch-modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create New Batch</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('batches.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Course</label>
                            <select name="course_id" class="form-select" required>
                                <option value="">Select Course</option>
                                @foreach ($courses as $course)
                                    <option value="{{ $course->id }}"
                                        {{ old('course_id') == $course->id ? 'selected' : '' }}>
                                        {{ $course->title }}
                                    </option>
                                @endforeach
                            </select>
                            @error('course_id')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Batch Name</label>
                            <input type="text" name="batch_name" class="form-control"
                                value="{{ old('batch_name') }}" required>
                            @error('batch_name')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Start Date</label>
                                <input type="date" name="start_date" class="form-control"
                                    value="{{ old('start_date') }}" required>
                                @error('start_date')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">End Date</label>
                                <input type="date" name="end_date" class="form-control"
                                    value="{{ old('end_date') }}" required>
                                @error('end_date')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Days of Week</label>
                            <select name="day_of_week[]" class="form-select" multiple>
                                @foreach ($daysOfWeek as $day)
                                    <option value="{{ $day }}"
                                        {{ in_array($day, old('day_of_week', [])) ? 'selected' : '' }}>
                                        {{ $day }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="text-muted">Hold Ctrl/Cmd to select multiple days</small>
                            @error('day_of_week')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Time</label>
                            <input type="text" name="time" class="form-control" value="{{ old('time') }}"
                                placeholder="e.g., 10:00 AM - 12:00 PM">
                            @error('time')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Mode</label>
                            <select name="mode" class="form-select">
                                <option value="">Select Mode</option>
                                @foreach ($modes as $mode)
                                    <option value="{{ $mode }}" {{ old('mode') == $mode ? 'selected' : '' }}>
                                        {{ $mode }}</option>
                                @endforeach
                            </select>
                            @error('mode')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Location</label>
                            <input type="text" name="location" class="form-control" value="{{ old('location') }}"
                                placeholder="Only for Offline/Hybrid modes">
                            @error('location')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Create Batch</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Auto-open modals on validation errors --}}
    @if ($errors->any())
        <script>
            $(document).ready(function() {
                @if (session('show_create_modal'))
                    $('#create-batch-modal').modal('show');
                @endif
                @if (session('edit_batch_id'))
                    $('#edit-batch-modal-{{ session('edit_batch_id') }}').modal('show');
                @endif
            });
        </script>
    @endif
@endsection

@push('styles')
    <style>
        .form-select[multiple] {
            height: auto;
        }
    </style>
@endpush
