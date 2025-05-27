
@extends('admin.pages.dashboard')

@section('sub-section')

@if($students->isEmpty())
    <p>No students found for this batch and date.</p>
@else
    <h4>Students in Batch: {{ $batches->firstWhere('id', $batchId)->batch_name ?? 'N/A' }} for Date: {{ $attendanceDate ?? \Carbon\Carbon::today()->toDateString() }}</h4>
    <form action="{{ route('attendances.mark') }}" method="POST">
        @csrf
        <input type="hidden" name="attendance_date" value="{{ $attendanceDate }}">
        <input type="hidden" name="batch_id" value="{{ $batchId }}">

        <ul class="list-group">
            @foreach($students as $student)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span>{{ $student->name }}</span>

                    <!-- Present Button -->
                    @php
                        $attendance = $student->attendances->where('attendance_date', $attendanceDate)->first();
                    @endphp

                    @if($attendance && $attendance->status == '1')
                        <button type="button" class="btn btn-danger undo-btn" data-student-id="{{ $student->id }}" data-attendance-date="{{ $attendanceDate }}">Undo</button>
                    @else
                        <button type="submit" name="student_id" value="{{ $student->id }}" class="btn btn-success present-btn">Present</button>
                    @endif
                </li>
            @endforeach
        </ul>
    </form>
@endif
@endsection
