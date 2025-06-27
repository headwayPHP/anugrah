@extends('frontend.layout.master')

@section('content')
    <!-- breadcrumb-area start -->
    <div class="breadcrumb-area bg-overlay-black-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 position-relative">
                    <h3 class="breadcrumb-title text-black">Activities</h3>
                    <!-- breadcrumb-list start -->
                    <ul class="breadcrumb-list">
                        <li class="breadcrumb-item"><a href="{{ route('front.home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Activities</li>
                    </ul>
                    <!-- breadcrumb-list end -->
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb-area end -->









    <div class="site-wrapper-reveal">

        <!-- ======== Service Area Start ========== -->
        <div class="service-area section-space--pb_120  section-space--pt_90">
            <div class="container">
                <div class="row">

                    @foreach ($activities as $activity)
                        <div class="col-lg-4 col-md-6">
                            <!-- Single Service Start -->
                            <div class="single-service-wrap mt-40">
                                <div class="service-image">
                                    <a href="{{ route('front.activity.details', $activity->id) }}"><img
                                            src="{{ asset($activity->featured_image) }}" class="img-fluid"
                                            alt="Service image"></a>
                                </div>
                                <div class="service-content">
                                    <h4 class="service-title"><a
                                            href="{{ route('front.activity.details', $activity->id) }}">
                                            {{ \Illuminate\Support\Str::ucfirst(\Illuminate\Support\Str::limit($activity->title, 20)) }}
                                        </a>
                                    </h4>
                                    <p>{{ \Illuminate\Support\Str::limit($activity->content, 80) }}</p>


                                </div>
                            </div>
                            <div class="ht-btn-area text-center mt-3">
                                <a href="{{ route('front.activity.details', $activity->id) }}" class="hero-btn">Read
                                    more</a>
                            </div>
                            <!--// Single Service End -->
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
        <!-- ======== Service Area End ========== -->

    </div>
@endsection
