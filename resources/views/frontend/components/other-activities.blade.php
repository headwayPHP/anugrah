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

        <!-- External Navigation Buttons -->
        <div class="text-center mb-4">
            <button class="slider-nav-btn prev-btn" aria-label="Previous activities">
                &larr; Prev
            </button>
            <button class="slider-nav-btn next-btn ms-3" aria-label="Next activities">
                Next &rarr;
            </button>
        </div>

        <!-- Slider Container -->
        <div class="activities-slider-container">
            <div class="activities-slider-track">
                @foreach($activities as $activity)
                <div class="slider-slide">
                    <!-- Single Activities Start -->
                    <div class="single-activities-wrap">
                        <a href="{{ route('front.activity.details', $activity->id) }}" class="activities-imgaes">
                            <img src="{{ asset($activity->featured_image) }}" class="img-fluid"
                                alt="{{ $activity->title }}">
                        </a>
                        <div class="activities-content text-center">
                            <a href="{{ route('front.activity.details', $activity->id) }}">
                                <h4 class="activities-title">{{ \Illuminate\Support\Str::limit($activity->title, 19) }}
                                </h4>
                            </a>
                            <p>{{ \Illuminate\Support\Str::limit($activity->content, 100) }}</p>
                        </div>
                        <div class="ht-btn-area text-center mt-3">
                            <a href="{{ route('front.activity.details', $activity->id) }}" class="hero-btn">Read
                                more</a>
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
    .activities-slider-container {
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
        background-color: {
                {
                session('colour', '#f2b263')
            }
        }

        ;
        color: #fff;
        padding: 8px 18px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-weight: 600;
        transition: background-color 0.3s ease;
    }

    .slider-nav-btn:hover {
        background-color: darken({
                {
                session('colour', '#f2b263')
            }
        }

        , 10%);
    }

    .slider-nav-btn:disabled {
        background-color: #ccc;
        cursor: not-allowed;
    }

    @media (max-width: 992px) {
        .slider-slide {
            flex: 0 0 calc(100% / 2 - 15px);
        }
    }

    @media (max-width: 768px) {
        .slider-slide {
            flex: 0 0 100%;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const track = document.querySelector('.activities-slider-track');
        const slides = document.querySelectorAll('.slider-slide');
        const prevBtn = document.querySelector('.prev-btn');
        const nextBtn = document.querySelector('.next-btn');

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

            if (currentIndex < 0) currentIndex = 0;
            if (currentIndex > slideCount - visibleSlides) {
                currentIndex = slideCount - visibleSlides;
            }

            track.style.transform = `translateX(-${currentIndex * slideWidth}px)`;

            prevBtn.disabled = currentIndex === 0;
            nextBtn.disabled = currentIndex >= slideCount - visibleSlides;
        }

        prevBtn.addEventListener('click', function () {
            currentIndex -= getVisibleSlidesCount();
            updateSlider();
        });

        nextBtn.addEventListener('click', function () {
            currentIndex += getVisibleSlidesCount();
            updateSlider();
        });

        window.addEventListener('resize', updateSlider);
        updateSlider();
    });
</script>