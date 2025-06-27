<!--====================  mobile menu overlay ====================-->
<div class="mobile-menu-overlay" id="mobile-menu-overlay">
    <div class="mobile-menu-overlay__inner">
        <div class="mobile-menu-overlay__header">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-6 col-8">
                        <!-- logo -->
                        <div class="logo">
                            <a href="{{ route('front.home') }}">
                                <img src="{{ asset('assets/images/logo/logo2.png') }}" class="img-fluid" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6 col-4">
                        <!-- mobile menu content -->
                        <div class="mobile-menu-content text-end">
                            <span class="mobile-navigation-close-icon" id="mobile-menu-close-trigger"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mobile-menu-overlay__body">
            <nav class="offcanvas-navigation">
                <ul>
                    <li class="has-children">
                        <a href="{{ route('front.home') }}">Home</a>
                    </li>
                    <li class="has-children">
                        <a href="{{ route('aboutUsPage') }}">About</a>
                    </li>
                    <li class="has-children">
                        <a href="{{ route('coursePage') }}">Courses</a>
                    </li>
                    <li class="has-children">
                        <a href="{{ route('activityPage') }}">Activities</a>
                    </li>
                    <li class="has-children">
                        <a href="{{ route('galleryPage') }}">Gallery</a>
                        {{--                        <ul class="sub-menu"> --}}
                        {{--                            <li><a href="causes.html"><span>Causes</span></a></li> --}}
                        {{--                            <li><a href="gallery.html"><span>Gallery</span></a></li> --}}
                        {{--                            <li><a href="mission-and-vision.html"><span>Mission & Vision</span></a></li> --}}
                        {{--                            <li><a href="causes-details.html"><span>Causes Details</span></a></li> --}}
                        {{--                            <li><a href="events-details.html"><span>Events Details</span></a></li> --}}
                        {{--                        </ul> --}}
                    </li>
                    <li class="has-children">
                        <a href="{{ route('contactRequestPage') }}">Contact</a>
                    </li>
                    <li class="has-children">
                        <a href="{{ route('regRequestPage') }}">Register</a>
                    </li>
                    {{-- <li class="has-children">
                        <a href="javascript:void(0)">Others</a>
                        <ul class="sub-menu"> --}}
                    <li><a href="{{ route('login') }}"><span>Login</span></a></li>
                    @php
                        $pages = \App\Models\Page::where('status', '1')->get();
                    @endphp
                    @foreach ($pages as $page)
                        @if ($page->id != 4)
                            <li>
                                <a href="{{ route('frontend.specific.page', $page->id) }}">
                                    <span>{{ $page->title }}</span>
                                </a>
                            </li>
                        @endif
                    @endforeach
                    {{-- </ul>
                    </li> --}}
                </ul>
            </nav>
        </div>
    </div>
</div>
<!--====================  End of mobile menu overlay  ====================-->
