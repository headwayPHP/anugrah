@extends('frontend.layout.master')

@section('content')

    <!-- breadcrumb-area start -->
    <div class="breadcrumb-area--bg-two bg-overlay-black-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 position-relative">
                    <h3 class="breadcrumb-title text-black">Gallery</h3>
                    <!-- breadcrumb-list start -->
                    <ul class="breadcrumb-list">
                        <li class="breadcrumb-item"><a href="{{route('front.home')}}">Home</a></li>
                        <li class="breadcrumb-item active">Gallery</li>
                    </ul>
                    <!-- breadcrumb-list end -->
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb-area end -->








    <div class="site-wrapper-reveal">

        <div class="gallery-area section-space--pb_120 section-space--pt_90">
            <div class="container">
                <div class="row">
                    @foreach($photos as $photo)
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <!-- Single Gallery Start  -->
                            <div class="single-gallery-wrap">
                                <a href="{{ asset('images/photos/' . $photo->image) }}" class="img-popup">
                                    <div style="width: 100%; aspect-ratio: 1 / 1; overflow: hidden; border-radius: 8px;">
                                        <img src="{{ asset('images/photos/' . $photo->image) }}"
                                             alt="{{ $photo->alt_text }}"
                                             style="width: 100%; height: 100%; object-fit: cover; display: block;">
                                    </div>
                                </a>
                            </div><!-- Single Gallery End -->
                        </div>

                    @endforeach


                </div>
            </div>
        </div>

    </div>

@endsection
