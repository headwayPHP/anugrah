@php
    $socials = \App\Models\SocialMediaPost::where('status', '1')->latest()->limit(3)->get();
@endphp

<!============ Social media videos section ======== -->
<div class="social-videos-area section-space--pb_120 section-space--pt_90">
    <div class="container">
        <div class="row">
{{--            <div class="col-lg-12">--}}
{{--                <div class="section-title-wrap text-center section-space--mb_60">--}}
{{--                    <h3 class="heading">Social Media Videos</h3>--}}
{{--                    <p class="text mt-20">Watch our latest content from Instagram & YouTube</p>--}}
{{--                </div>--}}
{{--            </div>--}}
            <div class="col-lg-12">
                <div class="section-title-wrap text-center">
                    <h3 class="section-title center-style">Social Media Videos</h3>
{{--                    <p class="text mt-20">Watch our latest content from Instagram & YouTube</p>--}}
                </div>
            </div>
        </div>
        <div class="row">


            @foreach($socials as $social)
                <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                    <div class="px_blog_box">
                        <div class="px_blog_img" style="height: 300px; overflow: hidden; position: relative;">
                            <a href="{{ $social->url }}" target="_blank" rel="noopener noreferrer">
                                @if($social->banner)
                                    <img src="{{ asset($social->banner) }}" alt="{{ $social->title }}"
                                         style="width: 100%; height: 100%; object-fit: cover; object-position: center;">
                                @else
                                    <img src="{{ asset('assets/images/default-social-banner.jpg') }}" alt="{{ $social->title }}"
                                         style="width: 100%; height: 100%; object-fit: cover; object-position: center;">
                                @endif
                                <div class="social-hover">
                                    <i class="fa fa-external-link"></i>
                                </div>
                                <span class="px_btn">{{ \Carbon\Carbon::parse($social->date)->format('F d, Y') }}</span>
                            </a>
                        </div>

                        <h4 class="px_subheading">
                            <a href="{{ $social->url }}" target="_blank" rel="noopener noreferrer">{{ $social->title }}</a>
                        </h4>
                    </div>
                </div>
            @endforeach



        </div>
    </div>
</div>
<!============ Social media videos section ======== -->
