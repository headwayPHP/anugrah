<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Course;
use App\Models\Batch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $courses = Course::where('status', '1')->get();
        $selectedCourse = $request->course_id;
        $selectedBatch = $request->batch_id;

        // Handle AJAX request for batches
        if ($request->ajax()) {
            $batches = Batch::when($selectedCourse, function ($query) use ($selectedCourse) {
                return $query->where('course_id', $selectedCourse);
            })->where('status', '1')->get();

            return response()->json($batches); // return as JSON
        }

        $batches = Batch::when($selectedCourse, function ($query) use ($selectedCourse) {
            return $query->where('course_id', $selectedCourse);
        })->where('status', '1')->get();

        $students = Student::query()
            ->when($selectedBatch, function ($query) use ($selectedBatch) {
                return $query->where('batch_id', $selectedBatch);
            })
            ->with(['batch', 'course'])
            ->latest()
            ->get();

        return view('admin.students.index', compact(
            'students',
            'courses',
            'batches',
            'selectedCourse',
            'selectedBatch'
        ));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'batch_id' => 'required|exists:batches,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
            'phone' => 'required|string|max:20',
            'dob' => 'required|date|before:today',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('show_create_modal', true);
        }

        Student::create($validator->validated() + [
                'kit_given' => '0',
                'status' => '1'
            ]);

        return redirect()->route('students.index', [
            'course_id' => $request->course_id,
            'batch_id' => $request->batch_id
        ])
            ->with('success', 'Student created successfully.');
    }

    public function update(Request $request, Student $student)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email,' . $student->id,
            'phone' => 'required|string|max:20',
            'dob' => 'required|date|before:today',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('show_edit_modal', true)
                ->with('edit_student_id', $student->id);
        }

        $student->update($validator->validated());

        return redirect()->route('students.index', [
            'course_id' => $request->course_id,
            'batch_id' => $request->batch_id
        ])
            ->with('success', 'Student updated successfully.');
    }

    public function destroy(Student $student)
    {
        $courseId = request('course_id');
        $batchId = request('batch_id');

        $student->delete();

        return redirect()->route('students.index', [
            'course_id' => $courseId,
            'batch_id' => $batchId
        ])
            ->with('success', 'Student deleted successfully.');
    }

    public function toggleStatus(Request $request, Student $student)
    {
        $validated = $request->validate([
            'status' => 'required|in:0,1'
        ]);

        $student->update($validated);

        return redirect()->back()
            ->with('success', 'Student status updated.');
    }

    public function toggleKitStatus(Request $request, Student $student)
    {
        $validated = $request->validate([
            'kit_given' => 'required|in:0,1'
        ]);

        $student->update($validated);

        return redirect()->back()
            ->with('success', 'Kit status updated.');
    }
}
