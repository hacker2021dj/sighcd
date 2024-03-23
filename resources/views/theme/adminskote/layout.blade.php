<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8"/>
        <title>@yield('title', 'SIGHCD') | SIGHCD</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{asset("assets/theme/$theme/images/favicon.ico")}}">

        <!-- Bootstrap Css -->
        <link href="{{asset("assets/theme/$theme/css/bootstrap.min.css")}}" id="bootstrap-style" rel="stylesheet" type="text/css"/>
        <!-- Icons Css -->
        <link href="{{asset("assets/theme/$theme/css/icons.min.css")}}" rel="stylesheet" type="text/css"/>
        <!-- App Css-->
        <link href="{{asset("assets/theme/$theme/css/app.min.css")}}" id="app-style" rel="stylesheet" type="text/css"/>

        @yield('styles')
    </head>

    <body data-sidebar="dark">
        {{--  Begin page  --}}
        <div id="layout-wrapper">
            @include("theme.$theme.header")
            @include("theme.$theme.aside")

            <div class="main-content">
                <div class="page-content">
                    <div class="container-fluid">
                        @yield('header')

                        @yield('content')
                    </div>
                </div>

                @include("theme.$theme.footer")
            </div>

        </div>
        {{--  End page  --}}

        {{-- Begin  Right Sidebar  --}}
        <div class="right-bar">
            @include("theme.$theme.rsedibar")
        </div>
        {{-- End Right Sidebar   --}}

        <!-- App js -->
        <script src="{{asset("assets/theme/$theme/js/plugin.js")}}"></script>
        <!-- JAVASCRIPT -->
        <script src="{{asset("assets/theme/$theme/libs/jquery/jquery.min.js")}}"></script>
        <script src="{{asset("assets/theme/$theme/libs/bootstrap/js/bootstrap.bundle.min.js")}}"></script>
        <script src="{{asset("assets/theme/$theme/libs/metismenu/metisMenu.min.js")}}"></script>
        <script src="{{asset("assets/theme/$theme/libs/simplebar/simplebar.min.js")}}"></script>
        <script src="{{asset("assets/theme/$theme/libs/node-waves/waves.min.js")}}"></script>

        <!-- App js -->
        <script src="{{asset("assets/theme/$theme/js/app.js")}}"></script>

        @yield('scripts')
    </body>
