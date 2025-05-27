@extends('frontend.layout.master')

@section('content')

    <!-- breadcrumb-area start -->
    <div class="breadcrumb-area bg-overlay-black-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 position-relative">
                    <h3 class="breadcrumb-title text-white">Activity Details</h3>
                    <!-- breadcrumb-list start -->
                    <ul class="breadcrumb-list">
                        <li class="breadcrumb-item"><a href="{{ route('front.home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('activityPage') }}">Activities</a></li>
                        <li class="breadcrumb-item active">{{ $activity->title }}</li>
                    </ul>
                    <!-- breadcrumb-list end -->
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb-area end -->

    <div class="site-wrapper-reveal">
        <!-- Activity Details Section Start -->
        <div class="activity-details-area section-space--ptb_90">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <!-- Activity Banner Image -->
                        @if($activity->featured_image)
                            <div class="activity-banner mb-4">
                                <img src="{{ asset($activity->featured_image) }}" alt="{{ $activity->title }}"
                                     class="img-fluid w-100 rounded shadow-sm">
                            </div>
                        @endif

                        <!-- Activity Title -->
                        <h2 class="mb-4" style="font-weight: 700; color: #222;">{{ $activity->title }}</h2>

                        <!-- Activity Content -->
                        <div class="activity-content" style="line-height: 1.8; font-size: 1.1rem; color: #444;">
                            {!! $activity->content !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Activity Details Section End -->
    </div>

@endsection
