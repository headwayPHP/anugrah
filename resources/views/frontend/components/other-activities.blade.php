@php
    $activities = \App\Models\Activity::where('status', '1')->limit(10)->get();
@endphp

<!-- ======== Others Activities Area Start ========== -->
<div class="others-activities-area section-space--pb_120">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title-wrap text-center">
                    <h3 class="section-title center-style">Activities</h3>
                </div>
            </div>
        </div>

        <!-- Outer wrapper for full positioning -->
        <div class="activities-slider-wrapper position-relative d-flex justify-content-center align-items-center">
            <!-- Prev Button (Left) -->
            <button class="slider-nav-btn prev-btn me-3" aria-label="Previous activities">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M15 18l-6-6 6-6" />
                </svg>
            </button>

            <!-- Slider Container -->
            <div class="activities-slider-container">
                <div class="activities-slider-track">
                    @foreach ($activities as $activity)
                        <div class="slider-slide">
                            <div class="single-activities-wrap pb-1">
                                <a href="{{ route('front.activity.details', $activity->id) }}"
                                    class="activities-imgaes">
                                    <img src="{{ asset($activity->featured_image) }}" class="img-fluid"
                                        alt="{{ \Illuminate\Support\Str::ucfirst($activity->title) }}
">
                                </a>
                                <div class="activities-content text-center">
                                    <a href="{{ route('front.activity.details', $activity->id) }}">
                                        <h5 class="activities-title">
                                            {{ \Illuminate\Support\Str::ucfirst(\Illuminate\Support\Str::limit($activity->title, 19)) }}

                                        </h5>
                                    </a>
                                    <p>{{ \Illuminate\Support\Str::limit($activity->content, 100) }}</p>
                                </div>
                                <div class="ht-btn-area text-center mt-3 mb-3">
                                    <a href="{{ route('front.activity.details', $activity->id) }}" class="hero-btn">Read
                                        more</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Next Button (Right) -->
            <button class="slider-nav-btn next-btn ms-3" aria-label="Next activities">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M9 18l6-6-6-6" />
                </svg>
            </button>
        </div>
    </div>
</div>
<!-- ======== Others Activities Area End ========== -->

<style>
    .activities-slider-wrapper {
        width: 100%;
        max-width: 1200px;
        margin: 0 auto;
    }

    .activities-slider-container {
        overflow: hidden;
        width: 1080px;
        max-width: 100%;
    }

    .activities-slider-track {
        display: flex;
        transition: transform 0.5s ease;
        gap: 20px;
        padding: 10px 0;
    }

    .slider-slide {
        flex: 0 0 340px;
        min-width: 340px;
    }

    .slider-nav-btn {
        /* background-color: var(--primary, #f2b263); */
        /* border: 1 px solid var(--primary, #f2b263); */
        border-radius: 50%;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .slider-nav-btn:hover {
        /* background-color: #fff; */
        /* border: 1px solid var(--primary, #f2b263); */
    }

    .slider-nav-btn svg {
        width: 20px;
        height: 20px;
    }

    .slider-nav-btn:disabled {
        opacity: 0.5;
        cursor: not-allowed;
        pointer-events: none;
    }

    @media (max-width: 1100px) {
        .activities-slider-container {
            width: 700px;
        }
    }

    @media (max-width: 750px) {
        .activities-slider-container {
            width: 340px;
            padding: 0 10px;
        }

        .slider-slide {
            flex: 0 0 100%;
            min-width: 100%;
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

        function getVisibleSlidesCount() {
            if (window.innerWidth < 768) return 1;
            if (window.innerWidth < 992) return 2;
            return 3;
        }

        function updateSlider() {
            const visibleSlides = getVisibleSlidesCount();
            const slideWidth = slides[0].getBoundingClientRect().width + 20;

            currentIndex = Math.max(0, Math.min(currentIndex, slideCount - visibleSlides));

            track.style.transform = `translateX(-${currentIndex * slideWidth}px)`;

            prevBtn.disabled = currentIndex === 0;
            nextBtn.disabled = currentIndex >= slideCount - visibleSlides;
        }

        prevBtn.addEventListener('click', function() {
            const visibleSlides = getVisibleSlidesCount();
            currentIndex -= visibleSlides;
            updateSlider();
        });

        nextBtn.addEventListener('click', function() {
            const visibleSlides = getVisibleSlidesCount();
            currentIndex += visibleSlides;
            updateSlider();
        });

        window.addEventListener('resize', updateSlider);

        updateSlider();
    });
</script>
