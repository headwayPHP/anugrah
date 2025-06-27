@extends('admin.pages.dashboard')

@section('sub-section')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Dashboard</h4>
        <!-- Button to open modal for creating course -->

    </div>
    <div class="row g-3 mb-3">

        <div class="col-xxl-12 col-xl-12">
            <div class="card py-3 mb-3">
                <div class="card-body py-3">
                    <div class="row g-0">
                        <div class="col-6 col-md-4 border-200 border-bottom border-end pb-4">
                            <h6 class="pb-1 text-700">Total Courses </h6>
                            <p class="font-sans-serif lh-1 mb-1 fs-2">{{ $totalCourses }} </p>

                        </div>
                        <div class="col-6 col-md-4 border-200 border-bottom border-end-md pb-4 ps-3">
                            <h6 class="pb-1 text-700">Total Students </h6>
                            <p class="font-sans-serif lh-1 mb-1 fs-2">{{ $totalStudents }}</p>

                        </div>
                        <div
                            class="col-6 col-md-4 border-200 border-bottom border-end border-end-md-0 pb-4 pt-4 pt-md-0 ps-md-3">
                            <h6 class="pb-1 text-700">Total Activities </h6>
                            <p class="font-sans-serif lh-1 mb-1 fs-2">{{ $totalActivities }}</p>

                        </div>
                        <div
                            class="col-6 col-md-4 border-200 border-bottom border-bottom-md-0 border-end-md pt-4 pb-md-0 ps-3 ps-md-0">
                            <h6 class="pb-1 text-700">Registration Requests</h6>
                            <p class="font-sans-serif lh-1 mb-1 fs-2">{{ $registrations }}</p>

                        </div>
                        <div class="col-6 col-md-4 border-200 border-bottom-md-0 border-end pt-4 pb-md-0 ps-md-3">
                            <h6 class="pb-1 text-700">Contact Requests</h6>
                            <p class="font-sans-serif lh-1 mb-1 fs-2">{{ $contactRequests }}</p>

                        </div>
                        <div class="col-6 col-md-4 pb-0 pt-4 ps-3">
                            <h6 class="pb-1 text-700">Social Posts</h6>
                            <p class="font-sans-serif lh-1 mb-1 fs-2">{{ $socialPosts }}</p>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
