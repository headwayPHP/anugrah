<div class="upcoming-event-area mb-3 ">
    <div class="container">
        <div class="row" >
            <div class="col-lg-12">
                <div class="section-title-wrap text-center">
                    <h3 class="section-title center-style">Batches of this course</h3>
                </div>
            </div>
        </div>
        <div class="row" style="justify-content: center">
            @foreach($batches as $batch)
                <div class="col-lg-4 col-md-6 col-12">
                    <!-- Single Activities Start -->
                    <div class="single-activities-wrap">
                        <a href="#" class="activities-imgaes">
                            <img src="{{asset('assets/images/activities/christian-event-01.png')}}" class="img-fluid" alt="">
                        </a>
                        <div class="activities-content text-center">
                            <div class="widget-metadata"><span>course: {{ $batch->course->title }}</span></div>
                            <a href="#">
                                <h4 class="activities-title">{{ $batch->batch_name }}</h4>
                            </a>
                            <p>start date: {{$batch->start_date->format('d-m-y')}}</p>
                            <div class="buy-ticket">
                                <a href="{{route('regRequestPage')}}">Register now</a>
                            </div>
                        </div>
                    </div>
                    <!--// Single Activities End -->
                </div>
            @endforeach

        </div>
    </div>
</div>
