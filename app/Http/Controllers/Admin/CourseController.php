<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
{
    /**
     * Display a listing of courses.
     */
    public function index()
    {
        $courses = Course::latest()->get();
        return view('admin.courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new course.
     * (Not actually used since we're using modals, but kept for route compatibility)
     */
    public function create()
    {
        return redirect()->route('courses.index');
    }

    /**
     * Store a newly created course.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'desc' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'level' => 'nullable|string|max:255',
            'language' => 'nullable|string|max:255',
            'duration_weeks' => 'nullable|integer',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('show_create_modal', true);
        }

        $filename = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/courses'), $filename);
        }

        $data = $validator->validated();
        $data['status'] = '1'; // Default to active
        $data['image'] = $filename;

        Course::create($data);

        return redirect()->route('courses.index')
            ->with('success', 'Course created successfully.');
    }

    /**
     * Show the form for editing the specified course.
     * (Not actually used since we're using modals, but kept for route compatibility)
     */
    public function edit(Course $course)
    {
        return redirect()->route('courses.index');
    }

    /**
     * Update the specified course.
     */
    public function update(Request $request, Course $course)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'desc' => 'nullable|string',
            'level' => 'nullable|string|max:255',
            'language' => 'nullable|string|max:255',
            'image' => 'nullable|image',
            'duration_weeks' => 'nullable|integer',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('show_edit_modal', true)
                ->with('edit_course_id', $course->id);
        }

        $data = $validator->validated();

        if ($request->hasFile('image')) {
            // Optionally delete old image
            if ($course->image && file_exists(public_path('images/courses/' . $course->image))) {
                unlink(public_path('images/courses/' . $course->image));
            }

            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/courses'), $imageName);
            $data['image'] = $imageName;
        }

        $course->update($data);

        return redirect()->route('courses.index')
            ->with('success', 'Course updated successfully.');
    }

    /**
     * Remove the specified course.
     */
    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('courses.index')
            ->with('success', 'Course deleted successfully.');
    }

    /**
     * Toggle course status.
     */
    public function toggleStatus(Request $request, Course $course)
    {
        $status = $request->input('status');

        if (!in_array($status, ['0', '1'])) {
            return redirect()->back()
                ->withErrors(['status' => 'Invalid status value.']);
        }

        $course->status = $status;
        $course->save();

        return redirect()->back()
            ->with('success', 'Course status updated.');
    }
}
