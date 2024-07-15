@extends('errors.layout_errors')

@section('title', 'Mantenimiento')

@section('content')
    <div class="home-btn d-none d-sm-block">
        <a href="{{route('menu')}}" class="text-dark"><i class="fas fa-home h2"></i></a>
    </div>

    <section class="my-5 pt-sm-5">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <div class="home-wrapper">
                        <div class="mb-5">
                            <a href="{{route('menu')}}" class="d-block auth-logo">
                                <img src="{{asset("assets/theme/adminskote/images/logo-dark.png")}}" alt="" height="20" class="auth-logo-dark mx-auto">
                                <img src="{{asset("assets/theme/adminskote/images/logo-light.png")}}" alt="" height="20" class="auth-logo-light mx-auto">
                            </a>
                        </div>


                        <div class="row justify-content-center">
                            <div class="col-sm-4">
                                <div class="maintenance-img">
                                    <img src="{{asset("assets/theme/adminskote/images/maintenance.svg")}}" alt="" class="img-fluid mx-auto d-block">
                                </div>
                            </div>
                        </div>
                        <h3 class="mt-5">El sitio está en mantenimiento</h3>
                        <p>Por favor, vuelve a consultarnos en algún momento.</p>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="card mt-4 maintenance-box">
                                    <div class="card-body">
                                        <i class="bx bx-broadcast mb-4 h1 text-primary"></i>
                                        <h5 class="font-size-15 text-uppercase">¿POR QUÉ EL SITIO ESTÁ CAÍDO?</h5>
                                        <p class="text-muted mb-0">Hay muchas variaciones disponibles o está en desarrollo.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card mt-4 maintenance-box">
                                    <div class="card-body">
                                        <i class="bx bx-time-five mb-4 h1 text-primary"></i>
                                        <h5 class="font-size-15 text-uppercase">¿CUÁL ES EL TIEMPO DE INACTIVIDAD?</h5>
                                        <p class="text-muted mb-0">El tiempo aún no está definido.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card mt-4 maintenance-box">
                                    <div class="card-body">
                                        <i class="bx bx-envelope mb-4 h1 text-primary"></i>
                                        <h5 class="font-size-15 text-uppercase">¿NECESITAS APOYO?</h5>
                                        <p class="text-muted mb-0">
                                            Si desea dar el uso del sitio pongase en contacto con el proveedor. <a href="mailto:copycenterimportaciones@gmail.com" class="text-decoration-underline">copycenterimportaciones@gmail.com</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
