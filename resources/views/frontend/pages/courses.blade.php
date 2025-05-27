@extends('frontend.layout.master')

@section('content')

    <!-- breadcrumb-area start -->
    <div class="breadcrumb-area--bg-two bg-overlay-black-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 position-relative">
                    <h3 class="breadcrumb-title text-white">Courses</h3>
                    <!-- breadcrumb-list start -->
                    <ul class="breadcrumb-list">
                        <li class="breadcrumb-item"><a href="{{route('front.home')}}">Home</a></li>
                        <li class="breadcrumb-item active">Courses</li>
                    </ul>
                    <!-- breadcrumb-list end -->
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb-area end -->








    <div class="site-wrapper-reveal">


        <!-- ======== Events Area Start ========== -->
        <div class="events-area section-space--pb_120 section-space--pt_90">
            <div class="container">
                <div class="row">


                    @foreach($courses as $course)
                        <div class="col-lg-4 col-md-6">
                            <!-- Single Events Wrap Start -->
                            <div class="single-event-wrap mt-40">
                                <a href="{{route('courseDetailPage', $course->id)}}" class="event-image">
                                    <img src="{{ asset('images/courses/' . $course->image) }}" class="img-fluid" alt="Event Image">
                                </a>
                                <div class="event-content">
                                    <div class="content-title">
                                        <h4 class="mb-15"><a href="{{route('courseDetailPage', $course->id)}}">{{ $course->title }}</a></h4>

                                        <p>{{ \Illuminate\Support\Str::limit($course->desc, 100) }}</p>
                                    </div>
                                    <div class="ticket-button-box mt-20">
                                        <a href="{{route('courseDetailPage', $course->id)}}" class="btn ticket-btn">View More</a>
                                    </div>
                                </div>
                            </div>
                            <!--// Single Events Wrap End -->
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
        <!-- ======== Events Area End ========== -->

    </div>


@endsection
