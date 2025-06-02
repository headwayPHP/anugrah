@php
use App\Models\Page;$about = Page::where('id', 4)->first(); // Use first() to get a single record
@endphp

<!-- ======== Tai About Area Start ========== -->
<div class="tai-about-area" style="margin-bottom: 2em;">
    <div class="container pl-0 pr-0">
        <div class="row no-gutters align-items-center justify-content-center">
            <!-- Image Section -->
            <div class="col-lg-5" style="display: flex; justify-content: center">
                {{-- <div class="about-tai-image">--}}
                    {{-- <img src="{{ asset($about->image)  }}" class="img-fluid" --}} {{-- alt="Christian Images"
                        style="width: 100%; height: auto; display: block;">--}}
                    {{-- </div>--}}
                <div class="about-tai-image square-img-wrapper">
                    <img src="{{ asset($about->image)  }}" alt="Christian Images" class="square-img">
                </div>
            </div>

            <!-- Content Section (First Part Only) -->
            <div class="col-lg-5 small-mt__30 tablet-mt__30 small-mb__60 tablet-mb__60">
                <div class="about-tai-content col-06__right">
                    <div class="section-title-wrap">
                        <h3 class="section-title left-style">About श्री Anugrah Goswami</h3>
                    </div>
                    @if(isset($about) && $about->content)
                    @php
                    // Extract first paragraph
                    $paragraphs = explode('</p>', $about->content);
                    $firstParagraph = count($paragraphs) > 0 ? $paragraphs[0] . '</p>' : '';
                    @endphp
                    <div class="content-first-part">
                        {!! $firstParagraph !!}
                    </div>
                    @else
                    <!-- Fallback content -->
                    <p>It is a long established fact that a reader will be distracted by the readable content of
                        a page when looking at its layout. The point of using Lorem Ipsum is that it has a
                        more-or-less normal distribution of letters.</p>
                    @endif

                    <div class="about-us-button mt-40">
                        <a class="about-us-btn" href="{{route('aboutUsPage')}}">Discover</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ======== Tai About Area End ========== -->
