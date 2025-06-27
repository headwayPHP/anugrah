@extends('frontend.layout.master')
@php
    $address = \App\Models\Setting::where('id', 7)->first();
    $mobile = \App\Models\Setting::where('id', 8)->first();
    $email = \App\Models\Setting::where('id', 9)->first();
    $googl_map_url = \App\Models\Setting::where('id', 12)->first();
@endphp
@section('content')
    <!-- breadcrumb-area start -->
    <div class="breadcrumb-area--bg-two bg-overlay-black-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 position-relative">
                    <h3 class="breadcrumb-title text-black">Contact</h3>
                    <!-- breadcrumb-list start -->
                    <ul class="breadcrumb-list">
                        <li class="breadcrumb-item"><a href="{{ route('front.home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Contact</li>
                    </ul>
                    <!-- breadcrumb-list end -->
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb-area end -->








    <div class="site-wrapper-reveal">

        <div class="contact-page-wrapper section-space--pt_120">
            <div class="contact-form-area ">
                <div class="container">
                    <div class="row align-items-stretch equal-height-row">
                        <div class="col-lg-6">
                            <div id="googleMap-1" class="embed-responsive-item googleMap-1">
                                <iframe src="{{ $googl_map_url->value }}" style="border:0;width:100%;height:450px;"
                                    allowfullscreen="" loading="lazy"></iframe>

                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="contact-form-wrap ml-lg-5">
                                <h3 class="title mb-40">Contact Form</h3>
                                <form id="contact-form" action="{{ route('saveContactRequest') }}" method="POST">
                                    @csrf
                                    <div class="contact-form__one">
                                        <div class="contact-input">
                                            <label for="Name">Name</label>
                                            <div class="contact-inner">
                                                <input name="name" type="text" placeholder="Enter you name" required>
                                            </div>
                                        </div>

                                        <div class="contact-input">
                                            <label for="Phone">Phone</label>
                                            <div class="contact-inner">
                                                <input name="phone" type="number" class="no-spinner"
                                                    placeholder="Your Phone Number" required>
                                            </div>
                                        </div>

                                        <div class="contact-input">
                                            <label for="Email">Email</label>
                                            <div class="contact-inner">
                                                <input name="email" type="email" placeholder="Your Email Address "
                                                    required>
                                            </div>
                                        </div>
                                        <div class="submit-input">
                                            <button class="hero-btn" type="submit">Submit</button>
                                            <p class="form-messege"></p>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="row justify-content-center ">
                    <div class="col-lg-3">
                        <div class="single-contact-info">
                            <div class="contact-icon">
                                <i class="flaticon-placeholder"></i>
                            </div>
                            <div class="contact-info">
                                <h4>Address</h4>
                                <p>{{ $address->value }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="single-contact-info">
                            <div class="contact-icon">
                                <i class="flaticon-call"></i>
                            </div>
                            <div class="contact-info">
                                <h4>Phone</h4>
                                <p><a href="tel:{{ $mobile->value }}">{{ $mobile->value }}</a></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="single-contact-info">
                            <div class="contact-icon">
                                <i class="flaticon-paper-plane-1"></i>
                            </div>
                            <div class="contact-info">
                                <h4>Mail</h4>
                                <p><a href="mailto:{{ $email->value }}">{{ $email->value }}</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



        </div>




    </div>
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show position-fixed top-0 end-0 m-3 z-1030" role="alert"
            style="min-width: 300px;">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif



    @if ($errors->any())
        <div id="validation-alert"
            class="alert alert-danger alert-dismissible fade show position-fixed top-0 end-0 m-3 z-1030" role="alert"
            style="min-width: 300px;">
            <strong>Validation Errors:</strong>
            <ul class="mb-0 mt-1 ps-3">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

        <script>
            setTimeout(() => {
                const alertBox = document.getElementById('validation-alert');
                if (alertBox) {
                    alertBox.classList.remove('show');
                    alertBox.classList.add('fade');
                    setTimeout(() => alertBox.remove(), 300); // wait for fade to finish
                }
            }, 2500); // 2.5 seconds
        </script>
    @endif


@endsection

<style>
    .equal-height-row {
        display: flex;
        flex-wrap: wrap;
    }

    .equal-height-row>[class^="col-"] {
        display: flex;
        flex-direction: column;
    }

    .equal-height-box {
        flex: 1;
        height: 100%;
    }

    .single-contact-info {
        transform: scale(0.8);
        transform-origin: top left;
    }

    .contact-info p {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        /* number of lines to show */
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    /* For Chrome, Safari, Edge, Opera */
    .no-spinner::-webkit-outer-spin-button,
    .no-spinner::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    /* For Firefox */
    .no-spinner {
        -moz-appearance: textfield;
    }


    @media (max-width: 990px) {
        .contact-form-wrap {
            margin-top: 3em;
            text-align: center;
        }
    }
</style>
