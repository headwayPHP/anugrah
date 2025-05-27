<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Batch;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AttendanceController extends Controller
{
    /**
     * Show the attendance management page with batches and students.
     */
    public function index(Request $request)
    {
        $batches = Batch::all();
        $batchId = $request->batch_id;
        $attendanceDate = $request->attendance_date ?? Carbon::today()->toDateString();

        $students = [];
        if ($batchId) {
            $students = Student::where('batch_id', $batchId)->where('status','1')->get();
        }

        $events = Attendance::all()->map(function($attendance) {
            return [
                'title' => 'Present - ' . $attendance->student->name,
                'start' => $attendance->attendance_date,
                'color' => '#28a745'
            ];
        });

        return view('admin.attendances.index', compact('batches', 'students', 'batchId', 'attendanceDate','events'));
    }

//    public function index(Request $request)
//    {
//        $batches = Batch::all();
//        $batchId = $request->batch_id;
//        $attendanceDate = $request->attendance_date ?? Carbon::today()->toDateString();
//
//        $students = [];
//        if ($batchId) {
//            $students = Student::where('batch_id', $batchId)
//                ->with(['attendances' => function($query) use ($attendanceDate) {
//                    $query->where('attendance_date', $attendanceDate);
//                }])
//                ->get();
//        }
//
//        // Get all attendance records with student names for the calendar
//        $attendances = Attendance::when($batchId, function($query) use ($batchId) {
//            $query->where('batch_id', $batchId);
//        })
//            ->with('student')
//            ->get();
//
//        // Group by date for counts and student lists
//        $groupedAttendances = $attendances->groupBy('attendance_date');
//
//        $events = $groupedAttendances->map(function($items, $date) {
//            $studentNames = $items->map(function($attendance) {
//                return $attendance->student->name;
//            })->implode(', ');
//
//            return [
//                'title' => $items->count() . ' Present',
//                'start' => $date,
//                'color' => '#28a745',
//                'extendedProps' => [
//                    'count' => $items->count(),
//                    'students' => $studentNames
//                ]
//            ];
//        })->values();
//
//        return view('admin.attendances.index', compact(
//            'batches',
//            'students',
//            'batchId',
//            'attendanceDate',
//            'events'
//        ));
//    }
    /**
     * Load the students for the given date and batch.
     */
    public function loadStudents(Request $request)
    {
//        $request->validate([
//            'attendance_date' => 'required|date',
//            'batch_id' => 'required|integer'
//        ]);

        // Format the attendance_date to ensure it's in the correct format
        $attendanceDate = Carbon::parse($request->attendance_date)->format('Y-m-d'); // Ensure it's in Y-m-d format

        // Fetch all students for the given batch_id
        $students = DB::table('students')
            ->leftJoin('attendances', function ($join) use ($attendanceDate) {
                $join->on('students.id', '=', 'attendances.student_id')
                    ->where('attendances.attendance_date', '=', $attendanceDate);
            })
            ->where('students.batch_id', '=', $request->batch_id)
            ->where('students.status', '1')
            ->select('students.id', 'students.name', 'students.email', 'attendances.attendance_date', 'attendances.remarks', 'attendances.status')
            ->get();

        // Check if there are students in the batch
        if ($students->isEmpty()) {
            return response()->json([
                'status' => false,
                'message' => 'No students found for the specified batch and date'
            ]);
        }

        // Return the students with their attendance data
        return response()->json([
            'status' => true,
            'data' => $students
        ]);
    }

    /**
     * Mark a student as present.
     */
    public function markAttendance(Request $request)
    {
//        dd($request->all());
        $attendanceDate = $request->attendance_date;
        $batchId = $request->batch_id;
        $studentId = $request->student_id;

        $attendance = Attendance::where('student_id', $studentId)
            ->where('attendance_date', $attendanceDate)
            ->first();

        if (!$attendance) {
            Attendance::create([
                'batch_id' => $batchId,
                'student_id' => $studentId,
                'attendance_date' => $attendanceDate,
                'status' => 1 // Mark as present
            ]);

//            return redirect()->back()->with('success', 'Attendance marked successfully.');
            return response()->json(['success' => true, 'message' => 'Successfully marked.']);
        }

//        return redirect()->back()->with('error', 'Attendance already marked for this student on this date.');

        return response()->json(['success' => false, 'message' => 'Attendance not found']);
    }

    /**
     * Undo the attendance (mark as absent).
     */
    public function unmarkAttendance(Request $request)
    {
        $studentId = $request->student_id;
        $attendanceDate = $request->attendance_date;

        $attendance = Attendance::where('student_id', $studentId)
            ->where('attendance_date', $attendanceDate)
            ->first();

        if ($attendance) {
            $attendance->delete();

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Attendance not found']);
    }

    public function toggleStatus(Request $request)
    {
        $data = $request->validate([
            'student_id' => 'required|exists:students,id',
            'attendance_date' => 'required|date',
            'batch_id' => 'required|exists:batches,id',
            'status' => 'required|in:0,1',
        ]);

        Attendance::updateOrCreate(
            [
                'student_id' => $data['student_id'],
                'attendance_date' => $data['attendance_date'],
            ],
            [
                'batch_id' => $data['batch_id'],
                'status' => $data['status'],
            ]
        );

        return redirect()->back();
    }

}
