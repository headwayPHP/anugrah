<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Batch;
use App\Models\ContactRequest;
use App\Models\Course;
use App\Models\Page;
use App\Models\SocialMediaPost;
use Illuminate\Http\Request;
use App\Models\Photo;
use App\Models\ReqRequest;
use Illuminate\Support\Facades\Validator;

class FrontController extends Controller
{

    public function homePage() {
        return view('frontend.pages.index');
    }
    public function contactRequestPage() {
        return view('frontend.pages.contact-us');
    }
    public function saveContactRequest(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',

        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withInput()
                ->withErrors($validator)
                ->with('error', 'Failed to submit the form. Please check your input.');
        }

        $contact = ContactRequest::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,

        ]);

        return redirect()->back()->with('success','successfully submitted the form');
    }


    public function regRequestPage() {
        return view('frontend.pages.register');
    }

    public function saveReqRequest(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'dob' => 'required|date',
            'gender' => 'required|string|in:male,female,other',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withInput()
                ->withErrors($validator)
                ->with('error', 'Failed to submit the form. Please check your input.');
        }

        ReqRequest::create([
            'name' => $request->name,
            'dob' => $request->dob,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
            'city' => $request->city,
            'status' => 'pending', // Default
        ]);

        return redirect()->back()->with('success', 'Successfully submitted the form.');
    }

    public function galleryPage() {
        $photos = Photo::where('status', '1')->get(); // optionally filter for featured

        return view('frontend.pages.gallery', compact('photos'));
    }

    public function aboutUsPage() {
        $about = Page::where('id', 4)->first(); // Use first() to get a single record

        return view('frontend.pages.about-us', compact('about'));
    }

    public function privacyPage() {
        $privacy = Page::where('id', 3)->first(); // Use first() to get a single record

        return view('frontend.pages.privacy-policy', compact('privacy'));
    }

    public function specificPage($id) {
        $privacy = Page::where('id',$id)->first();
        return view('frontend.pages.privacy-policy', compact('privacy'));
    }

    public  function activityPage()
    {

        $activities = Activity::where('status','1')->get();
//        dd($activities);
        return view('frontend.pages.activity', compact('activities'));
    }
    public function showActivityDetails($id)
    {

        $activity = Activity::where('id',$id)->first();
//        dd($activity);
        return view('frontend.pages.activity-details', compact('activity'));
    }

    public function  coursePage()
    {
        $courses = Course::where('status','1')->get();

        return view('frontend.pages.courses',compact('courses'));
    }

    public function courseDetailPage($id)
    {

        $course = Course::where('id',$id)->first();
        $batches = Batch::where('course_id',$id)->get();
//        dd($activity);
        return view('frontend.pages.course-details', compact('course','batches'));
    }



}
