@php
    $activities = \App\Models\Activity::where('status','1')->limit(3)->get();
 @endphp

<!-- ======== Others Activities Area Start ========== -->
<div class="others-activities-area section-space--pb_120">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title-wrap text-center">
                    <h3 class="section-title center-style">Others Activities</h3>
                </div>
            </div>
        </div>
        <div class="row">

            @foreach($activities as $activity)
                <div class="col-lg-4 col-md-6 col-12">
                    <!-- Single Activities Start -->
                    <div class="single-activities-wrap">
                        <a href="{{route('front.activity.details', $activity->id)}}" class="activities-imgaes">
                            <img src="{{asset($activity->featured_image)}}" class="img-fluid" alt="">
                        </a>
                        <div class="activities-content text-center">
{{--                            <div class="widget-metadata"><span>South Temple</span></div>--}}
                            <a href="{{route('front.activity.details', $activity->id)}}">
                                <h4 class="activities-title">{{$activity->title}}</h4>
                            </a>
                            <p>{{ \Illuminate\Support\Str::limit($activity->content, 100) }}</p>
                        </div>
                    </div>
                    <!--// Single Activities End -->
                </div>
            @endforeach

        </div>
    </div>
</div>
<!-- ======== Others Activities Area End ========== -->
