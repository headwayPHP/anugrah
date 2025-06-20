@extends('frontend.layout.master')

@section('content')

    <!-- ===============================================-->
    <!--    Main Content-->
    <!-- ===============================================-->
    <main class="main" id="top">
        <div class="container" data-layout="container">
            <script>
                var isFluid = JSON.parse(localStorage.getItem('isFluid'));
                if (isFluid) {
                    var container = document.querySelector('[data-layout]');
                    container.classList.remove('container');
                    container.classList.add('container-fluid');
                }
            </script>
            <div class="row flex-center min-vh-100 py-6 text-center">
                <div class="col-sm-10 col-md-8 col-lg-6 col-xxl-5"><a class="d-flex flex-center mb-4"
                                                                      href="{{route('front.home')}}"><img class="me-2"
                                                                                                     src="../../assets/img/icons/spot-illustrations/falcon.png"
                                                                                                     alt="" width="58"/><span
                            class="font-sans-serif fw-bolder fs-5 d-inline-block">Anugrah Goswami</span></a>
                    <div class="card">
                        <div class="card-body p-4 p-sm-5">
                            <div class="fw-black lh-1 text-300 fs-error">404</div>
                            <p class="lead mt-4 text-800 font-sans-serif fw-semi-bold w-md-75 w-xl-100 mx-auto">The page
                                you're looking for is not found.</p>
                            <hr/>
                            <p>Make sure the address is correct and that the page hasn't moved. If you think this is a
                                mistake, <a href="mailto:info@exmaple.com">contact us</a>.</p><a
                                class="btn btn-primary btn-sm mt-3" href="{{route('front.home')}}"><span
                                    class="fas fa-home me-2"></span>Take me home</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main><!-- ===============================================-->
    <!--    End of Main Content-->
    <!-- ===============================================-->

@endsection
