<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class PageController extends Controller
{
    public function index()
    {
        // Fetch all pages in descending order
        $pages = Page::latest()->get();
        return view('admin.pages.index', compact('pages'));
    }

    public function create()
    {
        // Render view for creating a new page
        return view('admin.pages.create');
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'status' => 'required|in:0,1',
            'image' => 'nullable|image', // Optional image validation
        ]);

        // Prepare the data to be inserted
        $data = $request->all();

        // Handle image upload if provided
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('pages'), $filename); // Move the file to 'public/pages/'
            $data['image'] = 'pages/' . $filename; // Save the relative path in the database
        }

        // Create a new Page instance and assign the data manually
        $page = new Page();
        $page->title = $data['title'];
        $page->content = $data['content'];
        $page->status = $data['status'];
        $page->image = isset($data['image']) ? $data['image'] : null; // Only set image if it was uploaded

        // Save the Page to the database
        $page->save();

        // Redirect with success message
        return redirect()->route('pages.index')->with('success', 'Page created successfully.');
    }

    public function edit(Page $page)
    {
        // Render edit view with page data
        return view('admin.pages.edit', compact('page'));
    }



// In your PageController
    public function update(Request $request, $id)
    {
        $page = Page::findOrFail($id);
        $data = $request->all();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('pages'), $filename);
            $data['image'] = 'pages/' . $filename;
        }

        $page->update($data);

        return redirect()->route('pages.index')->with('success', 'Page updated successfully.');
    }
    public function destroy(Page $page)
    {
        // Delete image if exists
        if ($page->image) {
            Storage::delete('public/' . $page->image);
        }

        // Delete the page
        $page->delete();

        // Redirect with success message
        return redirect()->route('pages.index')->with('success', 'Page deleted successfully.');
    }

    public function toggleStatus(Request $request, Page $page)
    {
        $validated = $request->validate([
            'status' => 'required|in:0,1',
        ]);

        $page->status = $validated['status'];
        $page->save();

        return back()->with('success', 'Status updated successfully.');
    }}
