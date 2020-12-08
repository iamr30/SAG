<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Last-Modified" content="0">
    <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Cdu') }}</title>



    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href=" {{ asset('css/slick.css') }}" rel="stylesheet">
    <link href="{{ asset('css/slick-theme.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/fonts/fontawesome-all.min.css')}}">
    <link rel="stylesheet" href="https://unpkg.com/vue-multiselect@2.1.0/dist/vue-multiselect.min.css">

    <!-- Scripts -->
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/slick.js') }}"></script>
    <script src="{{ asset('js/index.js') }}"></script>

</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-lg bg-multiply fixed-top">
        <div class="container">
            <div class="col-md-6">
                <a class="navbar-brand" href="#"><img src="{{ asset('images/logos/logoBlanco.png') }}" width="20%"> </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
            <div class="col-md-6 ">
                <div class="collapse navbar-collapse row d-flex justify-content-end align-items-end">
                    <div class="col-md-12">

                        <form class="form-inline">
                            <div>
                                <a href="/admin/usuarioscdu/agregar" class="btn-a mr-4 nav-link active"><span>Ingresar</span> <i class="fas fa-user"></i></a>
                            </div>
                            <div class="input-group">
                                <div class="input-group-append">
                                    <input class="form-control" type="search" placeholder="Search" aria-label="Search">
                                    <button class="btn btn-light" type="button"><i class="el-icon el-icon-search"></i> </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-12">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item active">
                                <a class="nav-link" href="#"> Alberca <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#"> Aire libre </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#"> Gimnasio </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#"> Salon Multiusos </a>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </nav>
    <header>
        <div id="home-carousel" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#home-carousel" data-slide-to="0" class="active"></li>
                <li data-target="#home-carousel" data-slide-to="1"></li>
                <li data-target="#home-carousel" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner" role="listbox">
                <!-- Slide One - Set the background image for this slide in the line below -->
                <div class="carousel-item active" style="background-image: url({{ asset('images/home/home_slide.png') }})">

                </div>
                <!-- Slide Two - Set the background image for this slide in the line below -->
                <div class="carousel-item" style="background-image: url({{ asset('images/home/home_slide.png') }})">

                </div>
                <!-- Slide Three - Set the background image for this slide in the line below -->
                <div class="carousel-item" style="background-image: url({{ asset('images/home/home_slide.png') }})">
                </div>
            </div>
            <a class="carousel-control-prev" href="#home-carousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#home-carousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </header>

    <main class="mt-4 p-4">
        @yield('content')
    </main>
    <footer class="footer">
        <div class="container pt-5">
            <div class="row ">
                <div class="col-md-4">
                    <h3 class="title-b">CONTACTO</h3>
                    <p>
                        Paseo de Las Peñas 3500, Colinas de San Javier, 44660 Guadalajara, Jalisco, México.
                    </p>
                    <p>
                        relacionespublicas@clubsanjavier.org.mx
                        Tel: 33 3793 8450
                    </p>
                </div>
                <div class="col-md-4">
                    <form class="form">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Nombre</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Correo</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="email">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Mensaje</label>
                            <div class="col-sm-10">
                             <textarea rows="4" class="form-control"></textarea>
                            </div>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </footer>
</div>
</body>
</html>
