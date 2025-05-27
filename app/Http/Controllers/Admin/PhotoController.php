<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Photo;
use Illuminate\Http\Request;

class PhotoController extends Controller
{
    public function index()
    {
        $photos = Photo::latest()->get();
        return view('admin.photos.index', compact('photos'));
    }

    public function show($id)
    {
        $photo = Photo::findOrFail($id);
        return view('admin.photos.show', compact('photo'));
    }

    public function edit($id)
    {
        $photo = Photo::findOrFail($id);
        return view('admin.photos.edit', compact('photo'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'alt_text' => 'nullable|string|max:255',
            'image' => 'nullable|image',
        ]);

        $photo = Photo::findOrFail($id);

        $data = $request->only('title', 'alt_text');

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/photos'), $imageName);
            $data['image'] = $imageName;
        }

        $photo->update($data);
        return redirect()->route('photos.index')->with('success', 'Photo updated successfully.');
    }

    public function destroy($id)
    {
        $photo = Photo::findOrFail($id);
        $photo->delete();
        return redirect()->route('photos.index')->with('success', 'Photo deleted successfully.');
    }

    public function statusUpdate($id)
    {
        $photo = Photo::findOrFail($id);
        $photo->status = $photo->status === '1' ? '0' : '1';
        $photo->save();

        return back()->with('success', 'Photo status updated.');
    }

    public function isFeaturedToggle($id)
    {
        $photo = Photo::findOrFail($id);
        $photo->is_featured = $photo->is_featured ? 0 : 1;
        $photo->save();

        return back()->with('success', 'Photo featured status updated.');
    }

    public function create(Request $request)
    {

        $request->validate([
            'title' => 'required|string|max:255',
            'alt_text' => 'required|string|max:255',
            'image' => 'required|image',
            'status' => 'required|in:0,1'
        ]);

        $filename = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/photos'), $filename);
        }

        Photo::create([
            'title' => $request->title,
            'alt_text' => $request->alt_text,
            'image' => $filename,
            'status' => $request->status
        ]);

        return redirect()->back()->with('success', 'Photo added successfully.');
    }

}
