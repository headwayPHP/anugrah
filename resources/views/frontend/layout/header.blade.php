<!--====================  header area ====================-->
<div class="header-area header-area--default">


    <!-- Header Bottom Wrap Start -->
    <header class="header-area header-sticky">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 d-flex align-items-center justify-content-between">
                    <div class="header__logo">
                        <div class="logo">
                            <a href="{{route('front.home')}}"><img src="{{asset('assets/images/logo/logo2.png')}}" alt="" width="100"></a>
                        </div>
                    </div>
                    <div class="header-right">
                        <div class="header__navigation menu-style-three d-none d-lg-block">
                            <nav class="navigation-menu">
                                <ul>
                                    <li class="has-children has-children--multilevel-submenu">
                                        <a href="{{route('front.home')}}"><span>Home</span></a>

                                    </li>
                                    <li class="has-children">
                                        <a href="{{ route('aboutUsPage') }}"><span>About</span></a>
                                    </li>
                                    <li class="has-children">
                                        <a href="{{route('coursePage')}}"><span>Courses</span></a>
                                    </li>
                                    <li class="has-children has-children--multilevel-submenu">
                                        <a href="{{route('activityPage')}}"><span>Activities</span></a>
                                        <!-- <ul class="submenu">
                                            <li><a href="it-services.html"><span>IT Services</span></a></li>
                                        </ul> -->
                                    </li>
                                    <li class="has-children has-children--multilevel-submenu">
                                        <a href="{{route('galleryPage')}}"><span>Gallary</span></a>
{{--                                        <ul class="submenu">--}}
{{--                                            <li><a href="causes.html"><span>Causes</span></a></li>--}}
{{--                                            <li><a href="gallery.html"><span>Gallery</span></a></li>--}}
{{--                                            <li><a href="mission-and-vision.html"><span>Mission & Vision</span></a></li>--}}
{{--                                            <li><a href="causes-details.html"><span>Causes Details</span></a></li>--}}
{{--                                            <li><a href="events-details.html"><span>Events Details</span></a></li>--}}
{{--                                        </ul>--}}
                                    </li>
                                    <li class="has-children">
                                        <a href="{{route('contactRequestPage')}}"><span>Contact</span></a>
                                    </li>
{{--                                    <li class="has-children">--}}
{{--                                        <a href="{{route('regRequestPage')}}"><span>Register</span></a>--}}
{{--                                    </li>--}}
                                    <li class="has-children">
                                        <a href="{{route('login')}}"><span>Login</span></a>
                                    </li>
{{--                                    <li class="has-children has-children--multilevel-submenu">--}}
{{--                                        <a href="#"><span>Others</span></a>--}}
{{--                                        <ul class="submenu">--}}
{{--                                            <li><a href="{{ route('login') }}"><span>Login</span></a></li>--}}
{{--                                            @php--}}
{{--                                                $pages = \App\Models\Page::where('status','1')->get();--}}
{{--                                            @endphp--}}
{{--                                            @foreach ($pages as $page)--}}
{{--                                                @if ($page->id != 4)--}}
{{--                                                    <li>--}}
{{--                                                        <a href="{{ route('frontend.specific.page', $page->id) }}">--}}
{{--                                                            <span>{{ $page->title }}</span>--}}
{{--                                                        </a>--}}
{{--                                                    </li>--}}
{{--                                                @endif--}}
{{--                                            @endforeach--}}


{{--                                        </ul>--}}
{{--                                    </li>--}}

                                </ul>


                            </nav>

                        </div>

                        <!--                        <div class="header-btn text-end d-none d-sm-block ml-lg-4">-->
                        <!--                            <a class="btn-circle btn-default btn" href="#">Donate</a>-->
                        <!--                        </div>-->

                        <!-- mobile menu -->
                        <div class="mobile-navigation-icon d-block d-lg-none" id="mobile-menu-trigger">
                            <i></i>
                        </div>
                    </div>
                    <button class="btn single-by-ticket-btn"><a href="{{route('regRequestPage')}}">Register</a></button>
                </div>
            </div>
        </div>
    </header>
    <!-- Header Bottom Wrap End -->

</div>
<!--====================  End of header area  ====================-->
