@extends('frontend.layout.master')

@section('content')
    <!-- breadcrumb-area start -->
    <div class="breadcrumb-area--bg-two bg-overlay-black-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 position-relative">
                    <h3 class="breadcrumb-title text-black">Register for upcoming classes</h3>
                    <!-- breadcrumb-list start -->
                    <ul class="breadcrumb-list">
                        <li class="breadcrumb-item"><a href="{{ route('front.home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Register</li>
                    </ul>
                    <!-- breadcrumb-list end -->
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb-area end -->




    <style>
        input[type=number]::-webkit-outer-spin-button,
        input[type=number]::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>


    <div class="site-wrapper-reveal">

        <div class="contact-page-wrapper mb-lg-5" style="padding-top: 4em;">


            <div class="contact-form-area ">
                <div class="container">
                    <div class="row align-items-center justify-content-center">

                        <div class="col-lg-8">
                            <div class="contact-form-wrap ml-lg-5">
                                <h3 class="title mb-40 text-center">Registration Form</h3>
                                <form id="registration-form" action="{{ route('saveReqRequest') }}" method="POST">
                                    @csrf
                                    <div class="contact-form__one">
                                        <div class="contact-input">
                                            <label for="full_name">Full Name <span class="required">*</span></label>
                                            <div class="contact-inner">
                                                <input name="name" type="text" placeholder="Enter your full name"
                                                    required>
                                            </div>
                                        </div>

                                        <div class="contact-input">
                                            <label for="dob_age">Date of Birth</label>
                                            <div class="contact-inner">
                                                <input name="dob" type="date" placeholder="DD/MM/YYYY" required>
                                            </div>
                                        </div>

                                        <div class="contact-input">
                                            <label for="gender">Gender</label>
                                            <div class="contact-inner">
                                                <select name="gender" class="form-control" required>
                                                    <option value="">Select Gender</option>
                                                    <option value="male">Male</option>
                                                    <option value="female">Female</option>
                                                    <option value="other">Other</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="contact-input">
                                            <label for="mobile">Mobile Number <span class="required">*</span></label>
                                            <div class="contact-inner">
                                                <input name="phone" type="number" placeholder="Your mobile number"
                                                    required>
                                            </div>
                                        </div>

                                        <div class="contact-input">
                                            <label for="email">Email Address</label>
                                            <div class="contact-inner">
                                                <input name="email" type="email" placeholder="Your email address"
                                                    required>
                                            </div>
                                        </div>

                                        <div class="contact-input">
                                            <label for="address">Address</label>
                                            <div class="contact-inner">
                                                <textarea name="address" placeholder="Your full address" required></textarea>
                                            </div>
                                        </div>

                                        <div class="contact-input">
                                            <label for="city">City / Area / Locality</label>
                                            <div class="contact-inner">
                                                <input name="city" type="text" placeholder="Your city or locality"
                                                    required>
                                            </div>
                                        </div>

                                        <div class="submit-input">
                                            <button class="hero-btn" type="submit">Register Now</button>
                                            <p class="form-messege"></p>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    @if (session('success'))
        <div id="success-alert"
            class="alert alert-success alert-dismissible fade show position-fixed top-0 end-0 m-3 z-1030" role="alert"
            style="min-width: 300px;">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if ($errors->any())
        <div id="error-alert" class="alert alert-danger alert-dismissible fade show position-fixed top-0 end-0 m-3 z-1030"
            role="alert" style="min-width: 300px;">
            <strong>Validation Errors:</strong>
            <ul class="mb-0 mt-1 ps-3">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Add this script at the bottom -->
    <script>
        setTimeout(() => {
            const successAlert = document.getElementById('success-alert');
            const errorAlert = document.getElementById('error-alert');

            if (successAlert) {
                successAlert.classList.remove('show');
                successAlert.classList.add('fade');
            }

            if (errorAlert) {
                errorAlert.classList.remove('show');
                errorAlert.classList.add('fade');
            }
        }, 2500); // 2.5 seconds
    </script>


    {{--    @include('frontend.components.upcoming-classes') --}}

@endsection
