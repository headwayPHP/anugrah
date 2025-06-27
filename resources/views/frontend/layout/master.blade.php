@php
    $instagram = \App\Models\Setting::where('id', 2)->first();
    $facebook = \App\Models\Setting::where('id', 3)->first();
    $youtube = \App\Models\Setting::where('id', 4)->first();
    $colour = \App\Models\Setting::where('id', 11)->first();

    session(['colour' => $colour->value]);
@endphp
<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Anugrah Goswami</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('assets/images/favicon.ico') }}">

    <!-- CSS
    ============================================ -->
    <!-- Add this in the <head> tag -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Vendor & Plugins CSS (Please remove the comment from below vendor.min.css & plugins.min.css for better website load performance and remove css files from avobe) -->
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/vendor.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/plugins.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Main Style CSS -->
    {{--    <link rel="stylesheet" href="{{asset('assets/css/style.min.css')}}"> --}}
    <style>
        :root {
            --primary: {{ session('colour', '#f2b263') }};
        }

        input:-webkit-autofill,
        textarea:-webkit-autofill {
            background-color: #fff !important;
            color: {{ $colour->value }} !important;
            -webkit-text-fill-color: {{ $colour->value }} !important;
            transition: background-color 5000s ease-in-out 0s;
        }
    </style>

    <link href="{{ asset('assets/css/style.min.css?v=' . time()) }}" rel="stylesheet">


</head>

<body>


    <div class="icon-bar">
        <a href="{{ $instagram->value }}" target="_blank" class="instagram"><i class="fa fa-instagram"></i></a>
        <!--    <a href="#" class="twitter"><i class="fa fa-twitter"></i></a>-->
        <!--    <a href="#" class="google"><i class="fa fa-google"></i></a>-->
        <a href="{{ $facebook->value }}" target="_blank" class="facebook"><i class="fa fa-facebook"></i></a>
        <a href="{{ $youtube->value }}" target="_blank" class="youtube"><i class="fa fa-youtube"></i></a>
    </div>

    @include('frontend.layout.header')
    @yield('content')
    @include('frontend.layout.footer')



    <!--====================  scroll top ====================-->
    <a href="#" class="scroll-top" id="scroll-top">
        <i class="arrow-top flaticon-up-arrow"></i>
        <i class="arrow-bottom flaticon-up-arrow"></i>
    </a>
    <!--====================  End of scroll top  ====================-->


    @include('frontend.layout.mobile-menu')

    <!-- JS
============================================ -->

    <!-- Modernizer JS -->
    <script src="{{ asset('assets/js/vendor/modernizr-2.8.3.min.js') }}"></script>

    <!-- jquery JS -->
    <script src="{{ asset('assets/js/vendor/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/jquery-migrate-3.3.0.min.js') }}"></script>

    <!-- Bootstrap JS -->
    <script src="{{ asset('assets/js/plugins/plugins.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/js/vendor/bootstrap.min.js') }}"></script>
    <!-- Add before closing </body> -->


    <!-- Plugins JS (Please remove the comment from below plugins.min.js for better website load performance and remove plugin js files from avobe) -->


    <!-- Main JS -->
    <script src="{{ asset('assets/js/main.js') }}"></script>


</body>


<!-- Mirrored from htmldemo.net/stomv/stomv/index-3.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 23 Apr 2025 05:49:25 GMT -->

</html>
