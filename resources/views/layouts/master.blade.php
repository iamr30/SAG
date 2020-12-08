{{--<!doctype html>--}}
{{--<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">--}}
{{--<head>--}}
{{--    <meta charset="utf-8">--}}
{{--    <meta name="viewport" content="width=device-width, initial-scale=1">--}}
{{--    <meta http-equiv="Expires" content="0">--}}
{{--    <meta http-equiv="Last-Modified" content="0">--}}
{{--    <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">--}}
{{--    <meta http-equiv="Pragma" content="no-cache">--}}
{{--    <!-- CSRF Token -->--}}
{{--    <meta name="csrf-token" content="{{ csrf_token() }}">--}}

{{--    <title>{{ config('app.name', 'Laravel') }}</title>--}}

{{--    <!-- Scripts -->--}}
{{--    <script src="{{ asset('js/app.js') }}" defer></script>--}}
{{--    <!-- Fonts -->--}}
{{--    <link rel="dns-prefetch" href="//fonts.gstatic.com">--}}
{{--    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">--}}

{{--    <!-- Styles -->--}}
{{--    <link href="{{ asset('css/app.css') }}" rel="stylesheet">--}}
{{--    <link href="{{ asset('css/master.css') }}" rel="stylesheet">--}}
{{--    <link rel="stylesheet" href="https://unpkg.com/vue-multiselect@2.1.0/dist/vue-multiselect.min.css">--}}
{{--</head>--}}
{{--<body>--}}
{{--<div id="app">--}}
{{--    <el-container>--}}
{{--        @if(Illuminate\Support\Facades\Auth::check())--}}
{{--            <sidebar-menu-component-guest></sidebar-menu-component-guest>--}}

{{--        @else--}}
{{--            <sidebar-menu-component></sidebar-menu-component>--}}
{{--        @endif--}}
{{--        <el-container>--}}
{{--            <el-header style="text-align: right; font-size: 12px; background-color: #e10127" class="d-flex align-items-center justify-content-end">--}}
{{--                <el-row class="d-flex justify-items-end  align-items-center">--}}
{{--                    @if(Illuminate\Support\Facades\Auth::check())--}}
{{--                        <span class="text-white">{{Illuminate\Support\Facades\Auth::user()->name}} &nbsp;</span>--}}
{{--                        <el-avatar shape="square" size="small"--}}
{{--                                   src="https://cube.elemecdn.com/9/c2/f0ee8a3c7c9638a54940382568c9dpng.png"></el-avatar>--}}
{{--                        <el-dropdown>--}}
{{--                            <i class="el-icon-arrow-down text-white" style="margin-right: 15px"></i>--}}
{{--                            <el-dropdown-menu slot="dropdown" >--}}
{{--                                <el-dropdown-item onclick="window.location.href='home'">Inicio</el-dropdown-item>--}}
{{--                                <el-dropdown-item onclick=" document.getElementById('logout-form').submit()"> Cerrar--}}
{{--                                    sesión--}}
{{--                                </el-dropdown-item>--}}
{{--                                <form id="logout-form" action="{{ route('logout') }}" method="POST"--}}
{{--                                      style="display: none;">--}}
{{--                                    @csrf--}}
{{--                                </form>--}}
{{--                                <!--el-dropdown-item>Delete</el-dropdown-item-->--}}
{{--                            </el-dropdown-menu>--}}
{{--                        </el-dropdown>--}}
{{--                    @else--}}
{{--                        <a class="text-white" href="{{ route('login') }}">Iniciar sesión &nbsp;&nbsp;</a>--}}
{{--                        <a class="text-white" href="{{ route('register') }}">Registrarse</a>--}}
{{--                    @endif--}}
{{--                </el-row>--}}
{{--            </el-header>--}}

{{--            <el-main>--}}
{{--                @yield('content')--}}
{{--            </el-main>--}}
{{--        </el-container>--}}
{{--    </el-container>--}}
{{--</div>--}}
{{--</body>--}}
{{--</html>--}}
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

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{asset('css/bootstrap_template.css')}}">
    <link rel="stylesheet" href="{{asset('css/fonts/fontawesome-all.min.css')}}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/master.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/vue-multiselect@2.1.0/dist/vue-multiselect.min.css">


</head>
<body id="page-top">
<div id="app">
    <div id="wrapper">
        @if(Illuminate\Support\Facades\Auth::check())
            <sidebar-menu-component></sidebar-menu-component>

        @else
            <sidebar-menu-component-guest></sidebar-menu-component-guest>

        @endif
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                @if(Illuminate\Support\Facades\Auth::check())
                    <top-menu-component></top-menu-component>
                @else
                    <top-menu-component-guest></top-menu-component-guest>
                @endif

                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>

        </div>


    </div>
</div>
<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<script src="{{asset('js/chart.min.js')}}"></script>
<script src="{{asset('js/bs-init.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
<script src="{{asset('js/theme.js')}}"></script>
</body>
</html>
