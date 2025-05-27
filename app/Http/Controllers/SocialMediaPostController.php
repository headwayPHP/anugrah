<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\SocialMediaPost;
use Illuminate\Http\Request;

class SocialMediaPostController extends Controller
{
    public function index()
    {
        $posts = SocialMediaPost::latest()->get();
        return view('admin.social_posts.index', compact('posts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'url' => 'required|url|max:255',
            'date' => 'required|date',
            'status' => 'required|in:0,1',
            'banner' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only('title', 'url', 'date', 'status');

        if ($request->hasFile('banner')) {
            $file = $request->file('banner');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/social'), $filename);
            $data['banner'] = 'uploads/social/' . $filename;
        }

        SocialMediaPost::create($data);

        return redirect()->route('social-posts.index')->with('success', 'Social media post created successfully.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'url' => 'required|url|max:255',
            'date' => 'required|date',
            'status' => 'required|in:0,1',
            'banner' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $post = SocialMediaPost::findOrFail($id);
        $data = $request->only('title', 'url', 'date', 'status');

        if ($request->hasFile('banner')) {
            // Delete old banner if exists
            if ($post->banner && file_exists(public_path($post->banner))) {
                unlink(public_path($post->banner));
            }

            $file = $request->file('banner');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/social'), $filename);
            $data['banner'] = 'uploads/social/' . $filename;
        }

        $post->update($data);

        return redirect()->route('social-posts.index')->with('success', 'Social media post updated successfully.');
    }

    public function destroy($id)
    {
        $post = SocialMediaPost::findOrFail($id);

        // Delete banner file if exists
        if ($post->banner && file_exists(public_path($post->banner))) {
            unlink(public_path($post->banner));
        }

        $post->delete();

        return redirect()->route('social-posts.index')->with('success', 'Social media post deleted successfully.');
    }

    public function statusToggle($id)
    {
        $post = SocialMediaPost::findOrFail($id);
        $post->status = $post->status === '1' ? '0' : '1';
        $post->save();

        return back()->with('success', 'Status updated successfully.');
    }
}
