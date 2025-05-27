<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Batch;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BatchController extends Controller
{

    // BatchController.php
    public function getBatchesByCourse(Request $request)
    {
        $courseId = $request->input('course_id');

        if (!$courseId) {
            return response()->json([]);
        }

        $batches = Batch::where('course_id', $courseId)->get();

        return response()->json($batches);
    }
    public function index(Request $request)
    {
        $courses = Course::where('status','1')->get();
        $selectedCourse = $request->course_id;

        $batches = Batch::query()
            ->when($selectedCourse, fn($q) => $q->where('course_id', $selectedCourse))
            ->with('course')
            ->latest()
            ->get();

        return view('admin.batches.index', compact('batches', 'courses', 'selectedCourse'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'course_id' => 'required|exists:courses,id',
            'batch_name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'day_of_week' => 'nullable|array', // Changed to array validation
            'time' => 'nullable|string',
            'mode' => 'nullable|string|in:Online,Offline,Hybrid',
            'location' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('show_create_modal', true);
        }

        // Convert the array of days to a string
        $data = $validator->validated();
        if (isset($data['day_of_week'])) {
            $data['day_of_week'] = implode(',', $data['day_of_week']);
        }

        // Create the batch with the validated data
        Batch::create($data + ['status' => '1']);

        return redirect()->route('batches.index', ['course_id' => $request->course_id])
            ->with('success', 'Batch created successfully.');
    }

    public function update(Request $request, Batch $batch)
    {
        $validator = Validator::make($request->all(), [
            'batch_name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'day_of_week' => 'nullable|array', // Changed to array validation
            'time' => 'nullable|string',
            'mode' => 'nullable|string|in:Online,Offline,Hybrid',
            'location' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('show_edit_modal', true)
                ->with('edit_batch_id', $batch->id);
        }

        // Convert the array of days to a string
        $data = $validator->validated();
        if (isset($data['day_of_week'])) {
            $data['day_of_week'] = implode(',', $data['day_of_week']);
        }

        // Update the batch with the validated data
        $batch->update($data);

        return redirect()->route('batches.index', ['course_id' => $batch->course_id])
            ->with('success', 'Batch updated successfully.');
    }

    public function destroy(Batch $batch)
    {
        $courseId = $batch->course_id;
        $batch->delete();

        return redirect()->route('batches.index', ['course_id' => $courseId])
            ->with('success', 'Batch deleted successfully.');
    }

    public function toggleStatus(Request $request, Batch $batch)
    {
        $validated = $request->validate([
            'status' => 'required|in:0,1'
        ]);

        $batch->update($validated);

        return redirect()->back()
            ->with('success', 'Batch status updated.');
    }
}
