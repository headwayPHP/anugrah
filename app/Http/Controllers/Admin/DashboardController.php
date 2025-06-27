<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;

class DashboardController extends Controller
{
    public function index()
    {
        $totalCourses = \App\Models\Course::count();
        $totalStudents = Student::count();
        $totalActivities = \App\Models\Activity::count();
        $registrations = \App\Models\ReqRequest::count();
        $contactRequests = \App\Models\ContactRequest::count();
        $socialPosts = \App\Models\SocialMediaPost::count();
        return view('admin.pages.dashboard-home', compact(
            'totalCourses',
            'totalStudents',
            'totalActivities',
            'registrations',
            'contactRequests',
            'socialPosts'
        ));
    }
}
