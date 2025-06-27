<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SettingsController extends Controller
{
    // Show the settings page with values from the table
    public function edit()
    {
        $settings = Setting::all(); // Get all settings

        return view('admin.settings.edit', compact('settings'));
    }

    public function update(Request $request)
    {
        $settings = Setting::all();
        $colour = null;

        foreach ($settings as $setting) {
            $name = $setting->name;

            // Handle file upload for 'banner'
            if ($name === 'banner' && $request->hasFile('banner')) {
                $file = $request->file('banner');
                $filename = 'banner_' . time() . '.' . $file->getClientOriginalExtension();

                // Manually move the file to the public/uploads/settings directory
                $filePath = public_path('uploads/settings/' . $filename);

                // Ensure the directory exists
                if (!file_exists(public_path('uploads/settings'))) {
                    mkdir(public_path('uploads/settings'), 0777, true);
                }

                // Move the file to the public directory
                $file->move(public_path('uploads/settings'), $filename);

                // Store the relative path to the database
                $setting->value = 'uploads/settings/' . $filename;
                $setting->save();
            }
            // Handle other fields
            elseif ($request->has($name)) {
                $setting->value = $request->input($name);
                $setting->save();
            }

            // Retrieve and update the colour setting
            if ($name === 'colour') {
                $colour = $setting->value;
            }
        }

        // Store the updated colour in the session
        if ($colour) {
            session(['colour' => $colour]);  // Save the colour value in the session
        }

        return redirect()->back()->with('success', 'Settings updated successfully.');
    }


    // Update settings
    //    public function update(Request $request)
    //    {
    //        $request->validate([
    //            'name' => 'required|string|max:255',
    //            'value' => 'required|string|max:255',
    //            'status' => 'required|in:0,1',
    //            'group' => 'required|string|max:255',
    //            'desc' => 'nullable|string',
    //            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Handle image upload
    //        ]);
    //
    //        // Loop through all the settings and update them
    //        foreach ($request->input('settings') as $id => $data) {
    //            $setting = Setting::findOrFail($id);
    //
    //            // If a new logo is uploaded, store it and save the path
    //            if ($request->hasFile('logo')) {
    //                $logoPath = $request->file('logo')->store('logos', 'public'); // Store logo in the 'public/logos' directory
    //                $data['logo'] = $logoPath; // Assign the stored path to the data array
    //            }
    //
    //            // Update setting
    //            $setting->update([
    //                'name' => $data['name'],
    //                'value' => $data['value'],
    //                'status' => $data['status'],
    //                'group' => $data['group'],
    //                'desc' => $data['desc'] ?? null,
    //                'logo' => $data['logo'] ?? $setting->logo, // Keep the existing logo if not updated
    //            ]);
    //        }
    //
    //        return redirect()->route('settings.edit')->with('success', 'Settings updated successfully.');
    //    }

    // Show form for creating a new setting
    public function create()
    {
        return view('admin.settings.create');
    }

    // Store a newly created setting
    //    public function store(Request $request)
    //    {
    //        // Validation rules
    //        $validator = Validator::make($request->all(), [
    //            'name' => 'required|string|max:255',
    //            'value' => 'required|string|max:255', // General validation for value
    //            'status' => 'required|in:0,1',
    //            'group' => 'required|string|max:255',
    //            'desc' => 'nullable|string',
    //            'input_type' => 'required|in:text,image,pdf,video,link', // Validation for input types
    //            'file' => 'nullable|file|mimes:jpg,jpeg,png,pdf,mp4,avi|max:10240', // Validation for file upload
    //        ]);
    //
    //        // Check if validation fails
    //        if ($validator->fails()) {
    //            return redirect()->back()
    //                ->withInput()  // Retain the previous input values
    //                ->withErrors($validator)  // Return validation errors
    //                ->with('error', 'Failed to submit the form. Please check your input.');
    //        }
    //
    //        // Retrieve the input type (either 'text', 'image', 'pdf', 'video', or 'link')
    //        $inputType = $request->input('input_type');
    //        $value = '';
    //
    //        // Handle different input types
    //        if ($inputType == 'image' && $request->hasFile('file')) {
    //            // Handle image upload
    //            $filePath = $request->file('file')->store('uploads/images', 'public');
    //            $value = $filePath; // Store the file path for image
    //        } elseif ($inputType == 'pdf' && $request->hasFile('file')) {
    //            // Handle PDF upload
    //            $filePath = $request->file('file')->store('uploads/pdfs', 'public');
    //            $value = $filePath; // Store the file path for PDF
    //        } elseif ($inputType == 'video' && $request->hasFile('file')) {
    //            // Handle video upload
    //            $filePath = $request->file('file')->store('uploads/videos', 'public');
    //            $value = $filePath; // Store the file path for video
    //        } elseif ($inputType == 'link') {
    //            // For link, store the URL directly
    //            $value = $request->input('value'); // Assuming the user provides a link in 'value'
    //        } else {
    //            // If the input type is 'text', simply use the provided 'value'
    //            $value = $request->input('value');
    //        }
    //
    //        // Create a new setting in the database
    //        Setting::create([
    //            'name' => $request->name,
    //            'value' => $value,
    //            'status' => $request->status,
    //            'group' => $request->group,
    //            'desc' => $request->desc,
    //            'input_type' => $inputType, // Store the selected input type (text, image, pdf, video, link)
    //        ]);
    //
    //        // Redirect with success message
    //        return redirect()->route('settings.create')->with('success', 'New setting added successfully.');
    //    }

    public function store(Request $request)
    {
        $inputType = $request->input('input_type');

        // Dynamic validation rules
        $rules = [
            'name' => 'required|string|max:255',
            'status' => 'required|in:0,1',
            'group' => 'required|string|max:255',
            'desc' => 'nullable|string',
            'input_type' => 'required|in:text,image,pdf,video,link',
        ];

        // Conditional validation based on input_type
        if (in_array($inputType, ['image', 'pdf', 'video'])) {
            $rules['file'] = 'required|file|mimes:jpg,jpeg,png,pdf,mp4,avi|max:10240';
        } else {
            $rules['value'] = 'required|string|max:255';
        }

        // Validate the request
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()
                ->withInput()
                ->withErrors($validator)
                ->with('error', 'Failed to submit the form. Please check your input.');
        }

        // Determine the value based on input_type
        $value = '';
        if (in_array($inputType, ['image', 'pdf', 'video']) && $request->hasFile('file')) {
            $folder = match ($inputType) {
                'image' => 'uploads/images',
                'pdf' => 'uploads/pdfs',
                'video' => 'uploads/videos',
            };
            $filePath = $request->file('file')->store($folder, 'public');
            $value = $filePath;
        } elseif (in_array($inputType, ['text', 'link'])) {
            $value = $request->input('value');
        }

        // Store the setting
        Setting::create([
            'name' => $request->name,
            'value' => $value,
            'status' => $request->status,
            'group' => $request->group,
            'desc' => $request->desc,
            'input_type' => $inputType,
        ]);

        return redirect()->route('settings.edit')->with('success', 'New setting added successfully.');
    }
}
