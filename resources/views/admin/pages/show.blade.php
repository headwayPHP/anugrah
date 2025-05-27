@extends('admin.pages.dashboard')

@section('sub-section')
    @php
        // Assuming $page is passed from the controller
    @endphp

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>View Page</h4>
        <a href="{{ route('pages.index') }}" class="btn btn-secondary btn-sm">Back to Pages</a>
    </div>

    <div class="row g-0">
        <div class="col-lg-8 pe-lg-2">
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="fs-0 mb-3">{{ $page->title }}</h5>
                    <div class="content">{!! $page->content !!}</div>
                    <h5 class="fs-0 mt-5 mb-2">Tags</h5>
                    <!-- Add your tags here if applicable -->
                    <h5 class="fs-0 mt-5 mb-2">Share with friends</h5>
                    <div class="icon-group">
                        <a class="icon-item text-facebook" href="#!">
                            <svg class="svg-inline--fa fa-facebook-f fa-w-10" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="facebook-f" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg="">
                                <path fill="currentColor" d="M279.14 288l14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S260.43 0 225.36 0c-73.22 0-121.08 44.38-121.08 124.72v70.62H22.89V288h81.39v224h100.17V288z"></path>
                            </svg>
                        </a>
                        <a class="icon-item text-twitter" href="#!">
                            <svg class="svg-inline--fa fa-twitter fa-w-16" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="twitter" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
                                <path fill="currentColor" d="M459.37 151.716c.325 4.548.325 9.097.325 13.645 0 138.72-105.583 298.558-298.558 298.558-59.452 0-114.68-17.219-161.137-47.106 8.447.974 16.568 1.299 25.34 1.299 49.055 0 94.213-16.568 130.274-44.832-46.132-.975-84.792-31.188-98.112-72.772 6.498.974 12.995 1.624 19.818 1.624 9.421 0 18.843-1.3 27.614-3.573-48.081-9.747-84.143-51.98-84.143-102.985v-1.299c13.969 7.797 30.214 12.67 47.431 13.319-28.264-18.843-46.781-51.005-46.781-87.391 0-19.492 5.197-37.36 14.294-52.954 51.655 63.675 129.3 105.258 216.365 109.807-1.624-7.797-2.599-15.918-2.599-24.04 0-57.828 46.782-104.934 104.934-104.934 30.213 0 57.502 12.67 76.67 33.137 23.715-4.548 46.456-13.32 66.599-25.34-7.798 24.366-24.366 44.833-46.132 57.827 21.117-2.273 41.584-8.122 60.426-16.243-14.292 20.791-32.161 39.308-52.628 54.253z"></path>
                            </svg>
                        </a>
                        <a class="icon-item text-google-plus" href="#!">
                            <svg class="svg-inline--fa fa-google-plus-g fa-w-20" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="google-plus-g" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" data-fa-i2svg="">
                                <path fill="currentColor" d="M386.061 228.496c1.834 9.692 3.143 19.384 3.143 31.956C389.204 370.205 315.599 448 204.8 448c-106.084 0-192-85.915-192-192s85.916-192 192-192c51.864 0 95.083 18.859 128.611 50.292l-52.126 50.03c-14.145-13.621-39.028-29.599-76.485-29.599-65.484 0-118.92 54.221-118.92 121.277 0 67.056 53.436 121.277 118.92 121.277 75.961 0 104.513-54.745 108.965-82.773H204.8v-66.009h181.261zm185.406 6.437V179.2h-56.001v55.733h-55.733v56.001h55.733v55.733h56.001v-55.733H627.2v-56.001h-55.733z"></path>
                            </svg>
                        </a>
                        <a class="icon-item text-linkedin" href="#!">
                            <svg class="svg-inline--fa fa-linkedin-in fa-w-14" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="linkedin-in" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg="">
                                <path fill="currentColor" d="M100.28 448H7.4V148.9h92.88zM53.79 108.1C24.09 108.1 0 83.5 0 53.8a53.79 53.79 0 0 1 107.58 0c0 29.7-24.1 54.3-53.79 54.3zM447.9 448h-92.68V302.4c0-34.7-.7-79.2-48.29-79.2-48.29 0-55.69 37.7-55.69 76.7V448h-92.78V148.9h89.08v40.8h1.3c12.4-23.5 42.69-48.3 87.88-48.3 94 0 111.28 61.9 111.28 142.3V448z"></path>
                            </svg>
                        </a>
                        <a class="icon-item text-700" href="#!">
                            <svg class="svg-inline--fa fa-medium-m fa-w-16" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="medium-m" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
                                <path fill="currentColor" d="M71.5 142.3c.6-5.9-1.7-11.8-6.1-15.8L20.3 72.1V64h140.2l108.4 237.7L364.2 64h133.7v8.1l-38.6 37c-3.3 2.5-5 6.7-4.3 10.8v272c-.7 4.1 1 8.3 4.3 10.8l37.7 37v8.1H307.3v-8.1l39.1-37.9c3.8-3.8 3.8-5 3.8-10.8V171.2L241.5 447.1h-14.7L100.4 171.2v184.9c-1.1 7.8 1.5 15.6 7 21.2l50.8 61.6v8.1h-144v-8L65 377.3c5.4-5.6 7.9-13.5 6.5-21.2V142.3z"></path>
                            </svg>
                        </a>
                    </div>
                    <!-- Add your map here if applicable -->
                </div>
            </div>
        </div>
        <div class="col-lg-4 ps-lg-2">
            <div class="sticky-sidebar">
                <div class="card mb-3 fs--1">
                    <div class="card-body">
                        <h6>Date And Time</h6>
                        <div class="d-flex align-items-center mb-2">
                            <div class="calendar me-2">
                                <span class="calendar-month">{{ $page->created_at->format('M') }}</span>
                                <span class="calendar-day">{{ $page->created_at->format('d') }}</span>
                            </div>
                            <div>
                                <p class="mb-0">Created At: {{ $page->created_at->format('H:i:s') }}</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-2">
                            <div class="calendar me-2">
                                <span class="calendar-month">{{ $page->updated_at->format('M') }}</span>
                                <span class="calendar-day">{{ $page->updated_at->format('d') }}</span>
                            </div>
                            <div>
                                <p class="mb-0">Updated At: {{ $page->updated_at->format('H:i:s') }}</p>
                            </div>
                        </div>
                        <h6 class="mt-4">Status</h6>
                        <p class="fs--1 mb-0">{{ $page->status == 1 ? 'Active' : 'Inactive' }}</p>
                    </div>
                </div>
                <div class="card mb-3 mb-lg-0">
                    <div class="card-header bg-light">
                        <h5 class="mb-0">Related Pages</h5>
                    </div>
                    <div class="card-body fs--1">
                        <!-- Add related pages here if applicable -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
