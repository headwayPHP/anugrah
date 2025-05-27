<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class ActivityController extends Controller
{
    public function index(Request $request)
    {
        $activities = Activity::latest()->get();
        return view('admin.activities.index', compact('activities'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'is_featured' => 'nullable|in:0,1',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'nullable|in:0,1',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('show_create_modal', true);
        }

        $data = $validator->validated();

        // Handle featured image upload
        if ($request->hasFile('featured_image')) {
            $image = $request->file('featured_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('activities'), $imageName);
            $data['featured_image'] = 'activities/' . $imageName;
        }

        // Set defaults
        $data['status'] = $data['status'] ?? '1';
        $data['is_featured'] = $data['is_featured'] ?? '0';

        Activity::create($data);

        return redirect()->route('activities.index')
            ->with('success', 'Activity created successfully.');
    }

    public function update(Request $request, Activity $activity)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'is_featured' => 'nullable|in:0,1',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'nullable|in:0,1',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('show_edit_modal', true)
                ->with('edit_activity_id', $activity->id);
        }

        $data = $validator->validated();

        // Handle featured image upload
        if ($request->hasFile('featured_image')) {
            // Delete old image if exists
            if ($activity->featured_image) {
                $oldImagePath = public_path($activity->featured_image);
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }
            }

            // Store new image
            $image = $request->file('featured_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('activities'), $imageName);
            $data['featured_image'] = 'activities/' . $imageName;
        }

        $activity->update($data);

        return redirect()->route('activities.index')
            ->with('success', 'Activity updated successfully.');
    }

    public function destroy(Activity $activity)
    {
        // Delete associated image
        if ($activity->featured_image) {
            $imagePath = public_path($activity->featured_image);
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
        }

        $activity->delete();

        return redirect()->route('activities.index')
            ->with('success', 'Activity deleted successfully.');
    }

    public function toggleStatus(Activity $activity)
    {
        $activity->update(['status' => !$activity->status]);
        return redirect()->back()
            ->with('success', 'Activity status updated successfully.');
    }

    public function toggleFeatured(Activity $activity)
    {
        $activity->update(['is_featured' => !$activity->is_featured]);
        return redirect()->back()
            ->with('success', 'Activity featured status updated successfully.');
    }
}
