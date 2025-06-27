@php
    use App\Models\Page;
    $about = Page::where('id', 4)->first();
@endphp

<!-- ======== Tai About Area Start ========== -->
<div class="tai-about-area section-space--pb_120">
    <div class="container">
        <div class="row align-items-start justify-content-between">

            <!-- Image Section -->
            <div class="col-lg-6 col-md-12 mb-4 mb-lg-0 d-flex justify-content-center">
                {{-- <div class="about-tai-image w-100"> --}}
                {{-- <img src="{{ asset($about->image) }}" alt="Christian Images" class="img-fluid w-100"
                    style="max-height: 60%; object-fit: cover; object-position: 1em -5em;"> --}}

                <img src="{{ asset($about->image) }}" class="img-fluid w-100"
                    style="height: auto; max-height: 450px; object-fit: cover;">

                {{-- </div> --}}


            </div>



            <!-- Content Section -->
            <div class="col-lg-6 col-md-12">
                <div class="about-tai-content px-3">
                    <div class="section-title-wrap">
                        <h3 class="section-title left-style" style="margin-bottom: 20px;">About श्री Anugrah Goswami
                        </h3>
                    </div>

                    @if (isset($about) && $about->content)
                        @php
                            $paragraphs = explode('</p>', $about->content);
                            $firstParagraph = count($paragraphs) > 0 ? $paragraphs[0] . '</p>' : '';
                        @endphp
                        <div class="content-first-part mt-3" style="text-align: justify; line-height: 2em;">
                            {!! $firstParagraph !!}
                        </div>
                    @else
                        <p class="mt-3" style="text-align: justify;">
                            It is a long established fact that a reader will be distracted by the
                            readable content of a page when looking at its layout. The point of using Lorem Ipsum
                            is that it has a more-or-less normal distribution of letters.
                        </p>
                    @endif

                    <div class="ht-btn-area " style="margin-top: 20px;">
                        <a href="{{ route('aboutUsPage') }}" class="hero-btn">Discover</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- ======== Tai About Area End ========== -->
