@extends('frontend.layout.master')

@php
    $address = \App\Models\Setting::where('id',7)->first();
    $mobile = \App\Models\Setting::where('id',8)->first();
    $email = \App\Models\Setting::where('id',9)->first();
    $googl_map_url = \App\Models\Setting::where('id',12)->first();
@endphp
@section('content')


    <!-- breadcrumb-area start -->
<div class="breadcrumb-area--bg-two bg-overlay-black-4">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 position-relative">
                <h3 class="breadcrumb-title text-white">{{$course->title}}</h3>
                <!-- breadcrumb-list start -->
                <ul class="breadcrumb-list">
                    <li class="breadcrumb-item"><a href="{{route('front.home')}}">Home</a></li>
                    <li class="breadcrumb-item active">{{ $course->title }}</li>
                </ul>
                <!-- breadcrumb-list end -->
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb-area end -->








<div class="site-wrapper-reveal">

    <!-- ======== Donation Area Start ========== -->
    <div class="donation-area section-space--pb_120 section-space--pt_90">
        <div class="container">
            <div class="row">

                <div class="col-lg-12">
                    <!-- Single Donation Wrap Start -->
                    <div class="single-donation-wrap row align-items-center justify-content-between">
                        <div class="col-lg-5">
                            <div class="donation-image">
                                <img src="{{ asset('images/courses/' . $course->image) }}" class="img-fluid" alt="Donation Image">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="donation-content ml-lg-5">
                                <div class="donation-title mb-30">
                                    <h4 class="mb-15">{{$course->title}}</h4>
{{--                                    <div class="event-date"><span>3 Feb 2023 </span> <span>@09.00am to 01.00pm</span></div>--}}
                                </div>

                                <p>{{$course->desc}}</p>

{{--                                <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English.</p>--}}

                            </div>
                        </div>
                    </div>
                    <!--// Single Donation Wrap End -->
                </div>

            </div>
        </div>
    </div>
    <!-- ======== Donation Area End ========== -->

    <!--=========== Causes Details Area Start ==========-->
    <div class="causes-details-area section-space--pb_120">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="mission-wrap mr-lg-5">
                        <div class="section-title-wrap text-left">
                            <h4 class="section-title-normal mb-30">Other Details</h4>
                        </div>

                        <div class="target-content">
                            <ul class="mt-30 mision-list">
                                <li><b>Duration</b>: {{$course->duration_weeks}} weeks <br/> <b>Language</b>: {{$course->language}} <br/> <b>Level</b>: {{$course->level}}</li>
                            </ul>
                        </div>

                    </div>

                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="target-wrap ml-lg-5 small-mt__40 ">
                        <div class="section-title-wrap text-left">
                            <h4 class="section-title-normal mb-30">Event Venue </h4>
                        </div>

                        <div class="target-content">
                            <ul class="venue-list">
                                <li>{{ $address->value }}</li>

                            </ul>
                        </div>

                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="target-wrap ml-lg-5 tablet-mt__40 small-mt__40 ">
                        <div class="section-title-wrap text-left">
                            <h4 class="section-title-normal mb-30">Event Map </h4>
                        </div>

                        <div class="target-content">
                            <div id="googleMap-1" class="embed-responsive-item googleMap-2" data-lat="40.730610" data-Long="-73.935242">
                                <iframe src="{{$googl_map_url->value}}" style="border:0;width:100%;height:100%;" allowfullscreen="" loading="lazy"></iframe>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--=========== Causes Details Area End ==========-->
    @include('frontend.components.course-batches',$batches)
   @include('frontend.components.register-yourself')

</div>

@endsection
