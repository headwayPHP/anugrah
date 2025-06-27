@extends('admin.pages.dashboard')

@section('sub-section')
    <div class="container">
        <h1>Attendance Management</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Tab Navigation -->
        <ul class="nav nav-tabs" id="attendanceTabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="daily-tab" data-toggle="tab" href="#daily" role="tab">Daily View</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="calendar-tab" data-toggle="tab" href="#calendar" role="tab">Calendar View</a>
            </li>
        </ul>

        <div class="tab-content" id="attendanceTabsContent">
            <!-- Daily View Tab -->
            <div class="tab-pane fade show active" id="daily" role="tabpanel">
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
                        @foreach ($batches as $batch)
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

            <!-- Calendar View Tab -->
            <div class="tab-pane fade" id="calendar" role="tabpanel">
                <div class="form-group mb-4">
                    <label for="calendar_batch_id">Select Batch</label>
                    <select id="calendar_batch_id" class="form-control" name="calendar_batch_id" required>
                        <option value="">Select Batch</option>
                        @foreach ($batches as $batch)
                            <option value="{{ $batch->id }}" {{ $batchId == $batch->id ? 'selected' : '' }}>
                                {{ $batch->batch_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div id="attendance-calendar"></div>
            </div>
        </div>
    </div>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Include FullCalendar CSS from vendors -->
    <link href="{{ asset('vendors/fullcalendar/main.min.css') }}" rel="stylesheet" />

    <!-- Include jQuery (required for Bootstrap tabs) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Include Bootstrap JS (for tab functionality) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Include FullCalendar JS from vendors -->
    <script src="{{ asset('vendors/fullcalendar/main.min.js') }}"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const attendanceDateInput = document.getElementById('attendance_date');
            const batchSelect = document.getElementById('batch_id');
            const calendarBatchSelect = document.getElementById('calendar_batch_id');
            const studentListContainer = document.getElementById('student-list');
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            // Initialize calendar
            let calendarEl = document.getElementById('attendance-calendar');
            let calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                events: function(fetchInfo, successCallback, failureCallback) {
                    const batchId = calendarBatchSelect.value;

                    if (batchId) {
                        fetch('{{ route('attendances.calendarData') }}', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': csrfToken
                                },
                                body: JSON.stringify({
                                    batch_id: batchId,
                                    start: fetchInfo.startStr,
                                    end: fetchInfo.endStr
                                })
                            })
                            .then(response => response.json())
                            .then(data => {
                                successCallback(data);
                            })
                            .catch(error => {
                                failureCallback(error);
                            });
                    } else {
                        successCallback([]);
                    }
                },
                eventClick: function(info) {
                    // When an event is clicked, switch to daily view and set the date
                    $('#attendanceTabs a[href="#daily"]').tab('show');
                    attendanceDateInput.value = info.event.startStr;
                    batchSelect.value = calendarBatchSelect.value;
                    loadStudents();
                },
                dateClick: function(info) {
                    // When a date is clicked, switch to daily view and set the date
                    $('#attendanceTabs a[href="#daily"]').tab('show');
                    attendanceDateInput.value = info.dateStr;
                    batchSelect.value = calendarBatchSelect.value;
                    loadStudents();
                }
            });

            // Trigger FullCalendar render when the tab becomes visible
            $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
                const target = $(e.target).attr("href");
                if (target === '#calendar') {
                    calendar.render(); // Force re-render when tab is shown
                }
            });

            calendar.render();

            // Load students on change (for daily view)
            attendanceDateInput.addEventListener('change', loadStudents);
            batchSelect.addEventListener('change', loadStudents);

            // Load calendar data when batch changes
            calendarBatchSelect.addEventListener('change', function() {
                calendar.refetchEvents();
            });

            // Load initial data
            loadStudents();

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

            // Event delegation for both tabs
            document.addEventListener('click', function(event) {
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
                            if (data.success) {
                                loadStudents();
                                calendar.refetchEvents();
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
                            if (data.success) {
                                loadStudents();
                                calendar.refetchEvents();
                            }
                        })
                        .catch(error => console.error('Error marking attendance:', error));
                }
            });
        });
    </script>

    <style>
        .fc .fc-h-event .fc-event-main {
            color: #fff;
        }
    </style>
@endsection
