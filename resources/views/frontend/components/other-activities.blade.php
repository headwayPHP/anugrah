@php
$activities = \App\Models\Activity::where('status','1')->limit(10)->get();
@endphp

<!-- ======== Others Activities Area Start ========== -->
<div class="others-activities-area section-space--pb_120" style="margin-top: 5em;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title-wrap text-center">
                    <h3 class="section-title center-style">Activities</h3>
                </div>
            </div>
        </div>

        <!-- Slider Container -->
        <div class="activities-slider-container position-relative">
            <!-- Navigation Buttons -->
            <button class="slider-nav-btn prev-btn" aria-label="Previous activities">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M15 18l-6-6 6-6" />
                </svg>
            </button>

            <button class="slider-nav-btn next-btn" aria-label="Next activities">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M9 18l6-6-6-6" />
                </svg>
            </button>

            <!-- Slider Track -->
            <div class="activities-slider-track">
                @foreach($activities as $activity)
                <div class="slider-slide">
                    <!-- Single Activities Start -->
                    <div class="single-activities-wrap">
                        <a href="{{route('front.activity.details', $activity->id)}}" class="activities-imgaes">
                            <img src="{{asset($activity->featured_image)}}" class="img-fluid"
                                alt="{{ $activity->title }}">
                        </a>
                        <div class="activities-content text-center">
                            <a href="{{route('front.activity.details', $activity->id)}}">
                                <h4 class="activities-title">{{ \Illuminate\Support\Str::limit($activity->title, 19) }}
                                </h4>
                            </a>
                            <p>{{ \Illuminate\Support\Str::limit($activity->content, 100) }}</p>
                        </div>
                        <div class="ht-btn-area text-center mt-3">
                            <a href="{{route('front.activity.details', $activity->id)}}" class="hero-btn">Read more</a>
                        </div>
                    </div>
                    <!--// Single Activities End -->
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<!-- ======== Others Activities Area End ========== -->

<style>
    /* Slider Styles */
    .activities-slider-container {
        position: relative;
        padding: 0 40px;
        overflow: hidden;
    }

    .activities-slider-track {
        display: flex;
        transition: transform 0.5s ease;
        gap: 20px;
        padding: 10px 0;
    }

    .slider-slide {
        flex: 0 0 calc(100% / 3 - 20px);
        min-width: 0;
    }

    .slider-nav-btn {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        width: 40px;
        height: 40px;
        border-radius: 50%;
        /* background-color: #4a6fdc; */
        /* Custom button color */
        /* color: white; */
        border: none;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 10;
        transition: all 0.3s ease;
    }

    .slider-nav-btn:hover {
        /* background-color: #3a5bc7; */
        /* Darker shade on hover */
    }

    .slider-nav-btn svg {
        width: 20px;
        height: 20px;
    }

    .prev-btn {
        left: 0;
    }

    .next-btn {
        right: 0;
    }

    /* Responsive Styles */
    @media (max-width: 992px) {
        .slider-slide {
            flex: 0 0 calc(100% / 2 - 15px);
        }
    }

    @media (max-width: 768px) {
        .slider-slide {
            flex: 0 0 100%;
        }

        .activities-slider-container {
            padding: 0 30px;
        }

        .slider-nav-btn {
            width: 30px;
            height: 30px;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const track = document.querySelector('.activities-slider-track');
        const slides = document.querySelectorAll('.slider-slide');
        const prevBtn = document.querySelector('.prev-btn');
        const nextBtn = document.querySelector('.next-btn');

        if (!track || !slides.length || !prevBtn || !nextBtn) return;

        let currentIndex = 0;
        const slideCount = slides.length;

        // Calculate how many slides to move based on visible slides
        function getVisibleSlidesCount() {
            if (window.innerWidth < 768) return 1;
            if (window.innerWidth < 992) return 2;
            return 3;
        }

        function updateSlider() {
            const visibleSlides = getVisibleSlidesCount();
            const slideWidth = slides[0].getBoundingClientRect().width + 20; // including gap

            // Handle boundaries
            if (currentIndex < 0) currentIndex = 0;
            if (currentIndex > slideCount - visibleSlides) {
                currentIndex = slideCount - visibleSlides;
            }

            track.style.transform = `translateX(-${currentIndex * slideWidth}px)`;

            // Disable buttons at boundaries
            prevBtn.disabled = currentIndex === 0;
            nextBtn.disabled = currentIndex >= slideCount - visibleSlides;
        }

        prevBtn.addEventListener('click', function() {
            const visibleSlides = getVisibleSlidesCount();
            currentIndex = Math.max(0, currentIndex - visibleSlides);
            updateSlider();
        });

        nextBtn.addEventListener('click', function() {
            const visibleSlides = getVisibleSlidesCount();
            currentIndex = Math.min(slideCount - visibleSlides, currentIndex + visibleSlides);
            updateSlider();
        });

        // Handle window resize
        window.addEventListener('resize', function() {
            updateSlider();
        });

        // Initialize slider
        updateSlider();
    });
</script>