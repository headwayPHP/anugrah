@php
    $banner = \App\Models\Setting::where('id', 5)->first();
    $banner_text = \App\Models\Setting::where('id', 6)->first();
    $colour = \App\Models\Setting::where('id', 11)->first();
@endphp
<!-- ======== Hero Area Start ========== -->
<div class="hero-area hero-style-03 christian-hero-bg "
    style="background: url('{{ $banner->value }}') no-repeat center center; background-size: cover; margin-bottom: 90px;">
    <div class="container">
        <div class="row justify-content-start">
            <div class="col-lg-6 col-md-7 mr-auto">
                <div class="hero-content text-left">
                    <h1 class="font-weight--bold" style="color: {{ session('colour') ?? $colour->value }}">
                        {{ $banner_text->value }}</h1>
                    <h4 class="mt-4" style="color: #FEFF7F">वल्लभ कुल भूषण पूज्यपाद श्री अनुग्रह गोस्वामी श्रीजी</h4>
                    <h6 class="mt-4" style="color: white;">श्रीकृष्ण भक्ति का प्रेममय मार्ग — श्री वल्लभधाम श्रीमद
                        वल्लभाचार्य महाप्रभुजी की कृपा से संचालित एक पावन धाम</h6>
                    <div class="ht-btn-area section-space--mt_40">
                        <a href="{{ route('regRequestPage') }}" class="hero-btn"
                            style=".hero-btn:hover {border: 1px solid transparent;}">Register Yourself</a>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
<!-- ======== Hero Area End ========== -->
