@php
    $courses = \App\Models\Course::where('status','1')->limit(4)->get();
@endphp

    <!-- ======== Classes Area Start ========== -->
<div class="classes-area section-space--ptb_120">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title-wrap text-center">
                    <h3 class="section-title center-style">Our Spiritual Classes</h3>
                </div>
            </div>
        </div>
        <div class="row" style="justify-content: center">
            @foreach($courses as $course)
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Single Spiritual Start -->
                    <div class="single-spiritual-wrap">
                        <div class="spitiutal-title">
                            <h4>{{$course->title}}</h4>
                        </div>
                        <div class="spitital-content">
                            <p>{{ \Illuminate\Support\Str::limit($course->desc, 100) }}</p>
                        </div>
                        <div class="classes-time">
                            Duration: {{$course->duration_weeks}} <br/>  Language: {{$course->language}} <br/> Level: {{$course->level}}
                        </div>

                    </div>
                    <!--// Single Spiritual End -->
                </div>
            @endforeach

        </div>
    </div>
</div>
<!-- ======== Classes Area End ========== -->
