@extends('admin.pages.dashboard')

@section('sub-section')
    <div class="container">
        <h1>Attendance Management</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Date Picker -->
        <div class="form-group mb-4">
            <label for="attendance_date">Select Date</label>
            <input type="date" class="form-control" id="attendance_date" name="attendance_date"
                   value="{{ old('attendance_date', \Carbon\Carbon::today()->toDateString()) }}" required>
        </div>

        <!-- Batch Dropdown -->
        <div class="form-group mb-4">
            <label for="batch_id">Select Batch</label>
            <select id="batch_id" class="form-control" name="batch_id" required>
                <option value="">Select Batch</option>
                @foreach($batches as $batch)
                    <option value="{{ $batch->id }}" {{ $batchId == $batch->id ? 'selected' : '' }}>
                        {{ $batch->batch_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Students List -->
        <div id="student-list" class="mb-4">
            <p>Select a batch and date to view students.</p>
        </div>
    </div>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const attendanceDateInput = document.getElementById('attendance_date');
            const batchSelect = document.getElementById('batch_id');
            const studentListContainer = document.getElementById('student-list');

            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            // Load students on change
            attendanceDateInput.addEventListener('change', loadStudents);
            batchSelect.addEventListener('change', loadStudents);

            loadStudents(); // Load on page load

            function loadStudents() {
                const attendanceDate = attendanceDateInput.value || new Date().toISOString().split('T')[0];
                const batchId = batchSelect.value;

                if (attendanceDate && batchId) {
                    fetch('{{ route('attendances.loadStudents') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        },
                        body: JSON.stringify({
                            attendance_date: attendanceDate,
                            batch_id: batchId
                        })
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.status) {
                                studentListContainer.innerHTML = generateStudentList(data.data, attendanceDate);
                            } else {
                                studentListContainer.innerHTML = '<p>No students found.</p>';
                            }
                        })
                        .catch(error => console.error('Error loading students:', error));
                } else {
                    studentListContainer.innerHTML = '<p>Please select both date and batch.</p>';
                }
            }

            function generateStudentList(students, attendanceDate) {
                if (students.length === 0) {
                    return '<p>No students found for this batch and date.</p>';
                }

                let html = '<ul class="list-group">';
                students.forEach(student => {
                    const isPresent = student.attendance_date === attendanceDate && student.status === '1';
                    html += `
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>${student.name}</span>
                            ${isPresent
                        ? `<button type="button" class="btn btn-danger undo-btn" data-student-id="${student.id}" data-attendance-date="${attendanceDate}">Undo</button>`
                        : `<button type="button" class="btn btn-success present-btn" data-student-id="${student.id}" data-batch-id="${batchSelect.value}">Present</button>`
                    }
                        </li>`;
                });
                html += '</ul>';
                return html;
            }

            studentListContainer.addEventListener('click', function (event) {
                if (event.target.classList.contains('undo-btn')) {
                    const studentId = event.target.getAttribute('data-student-id');
                    const attendanceDate = event.target.getAttribute('data-attendance-date');

                    fetch('{{ route('attendances.unmark') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        },
                        body: JSON.stringify({
                            student_id: studentId,
                            attendance_date: attendanceDate
                        })
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {  // Use data.success instead of data.status
                                loadStudents(); // Only reload after successful unmark
                            }
                        })
                        .catch(error => console.error('Error unmarking attendance:', error));

                } else if (event.target.classList.contains('present-btn')) {
                    const studentId = event.target.getAttribute('data-student-id');
                    const batchId = event.target.getAttribute('data-batch-id');
                    const attendanceDate = attendanceDateInput.value;

                    fetch('{{ route('attendances.mark') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        },
                        body: JSON.stringify({
                            student_id: studentId,
                            attendance_date: attendanceDate,
                            batch_id: batchId
                        })
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {  // Use data.success instead of data.status
                                loadStudents(); // Only reload after successful mark
                            }
                        })
                        .catch(error => console.error('Error marking attendance:', error));
                }
            });
;
;
        });
    </script>
@endsection
