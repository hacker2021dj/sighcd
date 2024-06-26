<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8"/>
        <title>@yield('title') | SIGHCD</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{asset("assets/theme/$theme/images/favicon.ico")}}">

        <!-- Bootstrap Css -->
        <link href="{{asset("assets/theme/$theme/css/bootstrap.min.css")}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="{{asset("assets/theme/$theme/css/icons.min.css")}}" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="{{asset("assets/theme/$theme/css/app.min.css")}}" id="app-style" rel="stylesheet" type="text/css" />
    </head>

    <body>
        @yield('content')

        <script type="text/javascript">
            var base_url = "{{Request::root()}}";
        </script>

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
    </body>
</html>
