@extends('frontend.layout.master')

@section('content')

    <!-- breadcrumb-area start -->
    <div class="breadcrumb-area bg-overlay-black-0">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 position-relative">
                    <h3 class="breadcrumb-title text-black">{{ $about->title }}</h3>
                    <!-- breadcrumb-list start -->
                    <ul class="breadcrumb-list ">
                        <li class="breadcrumb-item text-black"><a href="{{ route('front.home') }}">Home</a></li>
                        <li class="breadcrumb-item text-black active">{{ $about->title }}</li>
                    </ul>
                    <!-- breadcrumb-list end -->
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb-area end -->

    <div class="site-wrapper-reveal">
        <!-- ======== News-Style About Area Start ========== -->
        <div class="church-about-area section-space--ptb_120">
            <div class="container">
                <div class="row align-items-start">
                    <!-- Image Section -->
                    <div class="col-lg-6 mb-4 mb-lg-0 ">
                        <div class="about-tai-image text-center text-lg-start">
                            @if($about->image)
                                <img src="{{ asset($about->image) }}" class="img-fluid rounded" width="500" height="500"
                                     alt="About Image" style="max-height: 500px; object-fit: cover;">
                            @else
                                <img src="assets/images/banners/about.png" class="img-fluid rounded"
                                     alt="Default About Image" style="max-height: 500px; object-fit: cover;">
                            @endif


                        </div>
                    </div>

                    <!-- Content beside image -->
                    <div class="col-lg-6">
                        <div class="about-tai-content ps-lg-5">
                            <div class="section-title-wrap">
                                <h3 class="section-title--two left-style mb-30">{{ $about->title }}</h3>
                            </div>
                            @if($about->content)
                                @php
                                    // Split content at first closing paragraph tag
                                    $contentParts = preg_split('/(<\/p>)/i', $about->content, 2, PREG_SPLIT_DELIM_CAPTURE);
                                    $firstPart = isset($contentParts[0]) ? $contentParts[0].$contentParts[1] : '';
                                @endphp
                                    <!-- In your blade template, replace the content section with this: -->
                                <div class="content-text html-content">
                                    @if($about->content)
                                        @php
                                            // Remove &nbsp; and empty paragraphs
                                            $cleanContent = preg_replace('/&nbsp;|<p>\s*&nbsp;\s*<\/p>|<h[1-6]>\s*&nbsp;\s*<\/h[1-6]>/i', '', $about->content);
                                            // Split content at first closing paragraph tag
                                            $contentParts = preg_split('/(<\/p>)/i', $cleanContent, 2, PREG_SPLIT_DELIM_CAPTURE);
                                            $firstPart = isset($contentParts[0]) ? $contentParts[0].$contentParts[1] : '';
                                        @endphp
                                        {!! $firstPart !!}
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Remaining content below image -->
                    <!-- And for the remaining content: -->
                    <div class="col-12 mt-5">
                        <div class="about-tai-content html-content">
                            @if($about->content && isset($contentParts[2]))
                                {!! $contentParts[2] !!}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ======== News-Style About Area End ========== -->

        <!-- Rest of your content remains unchanged -->
        <!--=========== fun fact Area Start ==========-->
        <div class="fun-fact-wrapper section-space--pb_90">
            <div class="container">
                <div class="fun-fact-style-one">
                    <div class="single-fun-fact">
                        <div class="fun-fact--one text-center">
                            <img src="assets/images/icons/counter-01.png" class="img-fluid" alt="Image">
                            <div class="content mt-20">
                                <h6 class="fun-fact__text mb-10">Support Work</h6>
                                <h2 class="fun-fact__count"><span class="counter">85</span>%</h2>
                            </div>
                        </div>
                    </div>
                    <div class="single-fun-fact">
                        <div class="fun-fact--one text-center">
                            <img src="assets/images/icons/counter-02.png" class="img-fluid" alt="Image">
                            <div class="content mt-20">
                                <h6 class="fun-fact__text mb-10">Trusted Client's</h6>
                                <h2 class="fun-fact__count"><span class="counter">528</span>+</h2>
                            </div>
                        </div>
                    </div>
                    <div class="single-fun-fact">
                        <div class="fun-fact--one text-center">
                            <img src="assets/images/icons/counter-03.png" class="img-fluid" alt="Image">
                            <div class="content mt-20">
                                <h6 class="fun-fact__text mb-10">Client Satisfaction</h6>
                                <h2 class="fun-fact__count"><span class="counter">100</span>%</h2>
                            </div>
                        </div>
                    </div>
                    <div class="single-fun-fact">
                        <div class="fun-fact--one text-center">
                            <img src="assets/images/icons/counter-04.png" class="img-fluid" alt="Image">
                            <div class="content mt-20">
                                <h6 class="fun-fact__text mb-10">Cup Coffee</h6>
                                <h2 class="fun-fact__count"><span class="counter">9876</span></h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--=========== fun fact Area End ==========-->

        <!--=========== Video Area Start ==========-->
        <div class="about-video-area section-space--pb_120">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="section-title-wrap text-center section-space--mb_40">
                            <h3 class="section-title--two  center-style mb-30">Anugrah Pathshala Video</h3>
                        </div>
                    </div>
                </div>
                <div class="about-video-box justify-content-center about-video-bg">
                    <div class="col-lg-6 ml-auto mr-auto">
                        <div class="video-content-wrap text-center">
                            <div class="icon">
                                <a href="https://www.youtube.com/watch?v=vQaG9yKyhpY" class="video-link popup-youtube">
                                    <img src="assets/images/icons/play-circle.png" alt="Video Icon">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--=========== Video Area End ==========-->
    </div>

    <style>
        /* Improved HTML content styling */
        .html-content {
            line-height: 1.8;
            color: #555;
        }

        .html-content p {
            margin-bottom: 1.5rem;
        }

        .html-content h2,
        .html-content h3,
        .html-content h4 {
            margin-top: 2rem;
            margin-bottom: 1.2rem;
            color: #333;
        }

        .html-content ul,
        .html-content ol {
            margin-bottom: 1.5rem;
            padding-left: 2rem;
        }

        .html-content li {
            margin-bottom: 0.5rem;
        }

        .html-content img {
            max-width: 100%;
            height: auto;
            margin: 1rem 0;
            border-radius: 4px;
        }

        .html-content blockquote {
            border-left: 4px solid #ddd;
            padding-left: 1.5rem;
            margin: 1.5rem 0;
            color: #666;
            font-style: italic;
        }

        .html-content a {
            color: #0066cc;
            text-decoration: underline;
        }

        .html-content table {
            width: 100%;
            margin: 1.5rem 0;
            border-collapse: collapse;
        }

        .html-content table th,
        .html-content table td {
            padding: 0.75rem;
            border: 1px solid #ddd;
        }
    </style>

@endsection
