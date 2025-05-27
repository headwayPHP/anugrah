@php
    $address = \App\Models\Setting::where('id',7)->first();
    $mobile = \App\Models\Setting::where('id',8)->first();
    $email = \App\Models\Setting::where('id',9)->first();

       $instagram = \App\Models\Setting::where('id',2)->first();
    $facebook = \App\Models\Setting::where('id',3)->first();
    $youtube = \App\Models\Setting::where('id',4)->first();
@endphp
    <!--========== Footer Area Start ==========-->
<footer class="footer-area bg-footer">
    <div class="footer-top section-space--ptb_80 section-pb text-white">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="widget-footer mt-30">
                        <div class="footer-title">
                            <h6>Contact & Address</h6>
                        </div>
                        <div class="footer-contents">
                            <ul>
                                <li>
                                    <i class="fa fa-map-marker" aria-hidden="true" style="margin-right: 8px;"></i>
                                    {{$address->value}}
                                </li>

                                <li>
                                    <i class="fa fa-envelope" aria-hidden="true" style="margin-right: 8px;"></i>
                                    <a href="mailto:{{$email->value}}">{{$email->value}}</a>
                                </li>
                                <li>
                                    <i class="fa fa-phone" aria-hidden="true" style="margin-right: 8px;"></i>
                                    {{$mobile->value}}
                                </li>
                            </ul>

                            <div class="social-links mt-3">
                                <p class="mb-2">Follow Us</p>
                                <a href="{{$instagram->value}}" target="_blank"
                                   style="margin-right: 10px;">
                                    <i class="fa fa-instagram" aria-hidden="true"></i>
                                </a>
                                <a href="{{$facebook->value}}" target="_blank"
                                   style="margin-right: 10px;">
                                    <i class="fa fa-facebook" aria-hidden="true"></i>
                                </a>
                                <a href="{{$youtube->value}}" target="_blank">
                                    <i class="fa fa-youtube-play" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-2 col-md-6">
                    <div class="widget-footer mt-30">
                        <div class="footer-title">
                            <h6>Related Links</h6>
                        </div>
                        <div class="footer-contents">
                            <ul>
                                <li><a href="{{route('front.home')}}">Home</a></li>
                                <li><a href="{{route('aboutUsPage')}}">About</a></li>
                                <li><a href="{{route('coursePage')}}">Courses</a></li>
                                <li><a href="{{route('activityPage')}}">Activities</a></li>
                                <li><a href="{{route('galleryPage')}}">Gallary</a></li>
                                <li><a href="{{route('contactRequestPage')}}">Contact</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="widget-footer mt-30">
                        <div class="footer-title">
                            <h6>Information</h6>
                        </div>
                        <div class="footer-contents">
                            <ul>
                                <li>Sun Rise: 6:00 am</li>
                                <li>Sun Sat: 5:50 pm</li>
                                <li>Start Time: 9:00 am</li>
                                <li>End Time: 11.00 pm</li>
                                <li>Lunch: 01:30 pm</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="widget-footer mt-30">
                        <div class="footer-title">
                            <h6>Spiritual Thought</h6>
                        </div>
                        <div class="footer-contents">
                            <ul>
                                <li>"Serve others with love and humility."</li>
                                <li>"Inner peace begins the moment you choose not to allow another person to control
                                    your emotions."
                                </li>
                                <li>"Meditation brings wisdom; lack of meditation leaves ignorance."</li>
                                <li>~ Wisdom from the scriptures</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!--                    <div class="col-lg-4 col-md-6">-->
                <!--                        <div class="widget-footer mt-30">-->
                <!--                            <div class="footer-title">-->
                <!--                                <h6>Related Links</h6>-->
                <!--                            </div>-->
                <!--                            <div class="footer-logo mb-15">-->
                <!--                                <a href="index-2.html"><img src="assets/images/logo/footer-logo.png" alt=""></a>-->
                <!--                            </div>-->
                <!--                            <div class="footer-contents">-->
                <!--                                <p> Subscribe to our Newsletter & stay update. </p>-->
                <!--                                <div class="newsletter-box">-->
                <!--                                    <input type="text" placeholder="Enter your mail address">-->
                <!--                                    <button><i class="flaticon-paper-plane"></i></button>-->
                <!--                                </div>-->

                <!--                                <ul class="footer-social-share mt-20">-->
                <!--                                    <li><a href="#"><i class="flaticon-facebook"></i></a></li>-->
                <!--                                    <li><a href="#"><i class="flaticon-twitter"></i></a></li>-->
                <!--                                    <li><a href="#"><i class="flaticon-pinterest-social-logo"></i></a></li>-->
                <!--                                    <li><a href="#"><i class="flaticon-youtube"></i></a></li>-->
                <!--                                </ul>-->

                <!--                            </div>-->
                <!--                        </div>-->
                <!--                    </div>-->
            </div>
        </div>
    </div>
    <div class="footer-bottom-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="copy-right-box">
                        <p class="text-white">Copyright &copy; 2025 Headway Business solutions LLP <a
                                href="https://headway.org.in/" target="_blank">All Right Reserved</a>.</p>
                        <p class=" text-white"><a href="{{route('privacyPage')}}">Privacy policy</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!--==========// Footer Area End ==========-->

