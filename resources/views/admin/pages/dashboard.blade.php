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
           @include('admin.layout.side-menu')
            <div class="content">
                @include('admin.layout.top-bar')
                 @yield('sub-section')
                <footer class="footer">
                    <div class="row g-0 justify-content-between fs--1 mt-4 mb-3">
                        <div class="col-12 col-sm-auto text-center">
                            <p class="mb-0 text-600">Made by  <span
                                    class="d-none d-sm-inline-block">| </span><br class="d-sm-none"/> 2025 &copy; <a
                                    href="#">Durgesh Hirani</a></p>
                        </div>
                        <div class="col-12 col-sm-auto text-center">
                            <p class="mb-0 text-600">v3.15.0</p>
                        </div>
                    </div>
                </footer>
            </div>
            <div class="modal fade" id="authentication-modal" tabindex="-1" role="dialog"
                 aria-labelledby="authentication-modal-label" aria-hidden="true">
                <div class="modal-dialog mt-6" role="document">
                    <div class="modal-content border-0">
                        <div class="modal-header px-5 position-relative modal-shape-header bg-shape">
                            <div class="position-relative z-1" data-bs-theme="light">
                                <h4 class="mb-0 text-white" id="authentication-modal-label">Register</h4>
                                <p class="fs--1 mb-0 text-white">Please create your free Falcon account</p>
                            </div>
                            <button class="btn-close btn-close-white position-absolute top-0 end-0 mt-2 me-2"
                                    data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body py-4 px-5">
                            <form>
                                <div class="mb-3"><label class="form-label" for="modal-auth-name">Name</label><input
                                        class="form-control" type="text" autocomplete="on" id="modal-auth-name"/></div>
                                <div class="mb-3"><label class="form-label" for="modal-auth-email">Email address</label><input
                                        class="form-control" type="email" autocomplete="on" id="modal-auth-email"/>
                                </div>
                                <div class="row gx-2">
                                    <div class="mb-3 col-sm-6"><label class="form-label" for="modal-auth-password">Password</label><input
                                            class="form-control" type="password" autocomplete="on"
                                            id="modal-auth-password"/></div>
                                    <div class="mb-3 col-sm-6"><label class="form-label"
                                                                      for="modal-auth-confirm-password">Confirm
                                            Password</label><input class="form-control" type="password"
                                                                   autocomplete="on" id="modal-auth-confirm-password"/>
                                    </div>
                                </div>
                                <div class="form-check"><input class="form-check-input" type="checkbox"
                                                               id="modal-auth-register-checkbox"/><label
                                        class="form-label" for="modal-auth-register-checkbox">I accept the <a href="#!">terms </a>and
                                        <a href="#!">privacy policy</a></label></div>
                                <div class="mb-3">
                                    <button class="btn btn-primary d-block w-100 mt-3" type="submit" name="submit">
                                        Register
                                    </button>
                                </div>
                            </form>
                            <div class="position-relative mt-5">
                                <hr/>
                                <div class="divider-content-center">or register with</div>
                            </div>
                            <div class="row g-2 mt-2">
                                <div class="col-sm-6"><a class="btn btn-outline-google-plus btn-sm d-block w-100"
                                                         href="#"><span class="fab fa-google-plus-g me-2"
                                                                        data-fa-transform="grow-8"></span> google</a>
                                </div>
                                <div class="col-sm-6"><a class="btn btn-outline-facebook btn-sm d-block w-100" href="#"><span
                                            class="fab fa-facebook-square me-2" data-fa-transform="grow-8"></span>
                                        facebook</a></div>
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
