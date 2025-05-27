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
                <div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 col-xxl-4">

                    {{--                <a class="d-flex flex-center mb-4"--}}
                    {{--                                                                           href="../../../index-2.html"><img--}}
                    {{--                        class="me-2" src="../../../assets/img/icons/spot-illustrations/falcon.png" alt=""--}}
                    {{--                        width="58"/><span class="font-sans-serif fw-bolder fs-5 d-inline-block">falcon</span></a>--}}
                    <div class="card">
                        <div class="card-body p-4 p-sm-5">
                            <div class="mb-5">
                                <div class="col-auto text-center">
                                    <h5>Log in</h5>
                                </div>
                                {{--                            <div class="col-auto fs--1 text-600"><span class="mb-0 undefined">or</span> <span><a--}}
                                {{--                                        href="register.html">Create an account</a></span></div>--}}
                            </div>
                            <form action="{{ route('post.login') }}" method="POST">
                                @csrf
                                <div class="mb-3"><input class="form-control" type="email" name="email" placeholder="Email address"/>
                                </div>
                                <div class="mb-3"><input class="form-control" type="password" name="password" placeholder="Password"/></div>

                                <div class="mb-3">
                                    <button class="btn btn-primary d-block w-100 mt-3" type="submit" name="submit">Log in
                                    </button>
                                </div>
                            </form>
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    {{ $errors->first() }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main><!-- ===============================================-->
    <!--    End of Main Content-->
    <!-- ===============================================-->
@endsection
