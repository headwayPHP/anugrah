@extends('frontend.layout.master')

@section('content')
    <div class="site-wrapper-reveal no-overflow">
    @include('frontend.components.hero')
    @include('frontend.components.register-yourself')
        <div class="bg-gray">
        @include('frontend.components.short-services')
            @include('frontend.components.short-about')
        </div>
    @include('frontend.components.short-classes')
@include('frontend.components.other-activities')
    @include('frontend.components.upcoming-classes')
    @include('frontend.components.short-videos')
@endsection
