@php
    $banner = \App\Models\Setting::where('id',5)->first();
    $banner_text = \App\Models\Setting::where('id',6)->first();
@endphp
    <!-- ======== Hero Area Start ========== -->
<div class="hero-area hero-style-03 christian-hero-bg" style="background: url('{{$banner->value}}') no-repeat center center; background-size: cover;">
    <div class="container">
        <div class="row justify-content-end">
            <div class="col-lg-5 col-md-7 ml-auto">
{{--                <div class="hero-content text-left">--}}
{{--                    <h2 class="text-black">{{$banner_text->value}}</h2>--}}
{{--                    <div class="ht-btn-area section-space--mt_40">--}}
{{--                        <a href="#" class="hero-btn">Learn more</a>--}}
{{--                    </div>--}}


{{--                </div>--}}
            </div>
        </div>
    </div>
</div>
<!-- ======== Hero Area End ========== -->
