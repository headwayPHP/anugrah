@extends('admin.layout.master')


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
            <div class="row flex-center min-vh-100 py-6">
                <div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 col-xxl-4"><a class="d-flex flex-center mb-4" href="../../../index-2.html"><img class="me-2" src="{{asset('assets/img/icons/spot-illustrations/falcon.png')}}" alt="" width="58" /><span class="font-sans-serif fw-bolder fs-5 d-inline-block">falcon</span></a>
                    <div class="card">
                        <div class="card-body p-4 p-sm-5">
                            <div class="text-center"><img class="d-block mx-auto mb-4" src="{{asset('assets/img/icons/spot-illustrations/45.png')}}" alt="shield" width="100" />
                                <h4>See you again!</h4>
                                <p>Thanks for using Falcon. You are <br />now successfully signed out.</p><a class="btn btn-primary btn-sm mt-3" href="{{route('login')}}"><span class="fas fa-chevron-left me-1" data-fa-transform="shrink-4 down-1"></span>Return to Login</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main><!-- ===============================================-->
    <!--    End of Main Content-->
    <!-- ===============================================-->

@endsection
