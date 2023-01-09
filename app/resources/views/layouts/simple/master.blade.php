<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="A network built for you powered by you, get access to events, fine dining, & accommodations that would otherwise go unused, a marketplace built for excess. ">
    @yield('meta')
    <link rel="icon" href="{{asset('assets/images/favicon.png')}}" type="image/x-icon">
    <link rel="shortcut icon" href="{{asset('assets/images/favicon.png')}}" type="image/x-icon">
    <link rel="apple-touch-icon" sizes="57x57" href="{{asset('assets/images/favicons/apple-icon-57x57.png')}}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{asset('assets/images/favicons//apple-icon-60x60.png')}}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{asset('assets/images/favicons/apple-icon-72x72.png')}}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('assets/images/favicons/apple-icon-76x76.png')}}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{asset('assets/images/favicons/apple-icon-114x114.png')}}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{asset('assets/images/favicons/apple-icon-120x120.png')}}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{asset('assets/images/favicons/apple-icon-144x144.png')}}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{asset('assets/images/favicons/apple-icon-152x152.png')}}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('assets/images/favicons/apple-icon-180x180.png')}}">
    <link rel="icon" type="image/png" sizes="192x192"  href="{{asset('assets/images/favicons/android-icon-192x192.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('assets/images/favicons/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{asset('assets/images/favicons/favicon-96x96.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets/images/favicons/favicon-16x16.png')}}">
    <link rel="manifest" href="{{asset('assets/images/favicons/manifest.json')}}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{asset('assets/images/favicons/ms-icon-144x144.png')}}">
    <meta name="theme-color" content="#ffffff">
    <title>@yield('title')</title>
    <!-- Google font-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;1,100;1,300;1,400;1,700&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i&amp;display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900&amp;display=swap"
        rel="stylesheet">

    <style>
    @font-face {
        font-family: "Lato";
        src: url("{{asset('/assets/fonts/Lato/Lato-Regular.ttf')}}");
    }

    @font-face {
        font-family: "SF Pro Text";
        src: url("{{asset('/assets/fonts/sfprotext/SFProText-Regular.ttf')}}");

    }

    @font-face {
        font-family: "Montserrat";
        src: url("{{asset('/assets/fonts/Montserrat/Montserrat-Regular.ttf')}}");
    }

    @font-face {
        font-family: "Canela";
        src: url("{{asset('/assets/fonts/CanelaFamily/Canela-Regular-Trial.otf')}}");
    }
    </style>
    @include('layouts.simple.css')
    @yield('style')
</head>

<body @if(Route::current()->getName() == 'index') onload="startTime()" @endif>
    <div class="loader-wrapper">
        <div class="loader-index"><span></span></div>
        <svg>
            <defs></defs>
            <filter id="goo">
                <fegaussianblur in="SourceGraphic" stddeviation="11" result="blur"></fegaussianblur>
                <fecolormatrix in="blur" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 19 -9" result="goo">
                </fecolormatrix>
            </filter>
        </svg>
    </div>
    <!-- tap on top starts-->
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
    <!-- tap on tap ends-->
    <!-- page-wrapper Start-->
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
        <!-- Page Header Start-->
        @include('layouts.simple.header')
        <!-- Page Header Ends  -->
        <!-- Page Body Start-->
        <div class="page-body-wrapper">
            <!-- Page Sidebar Start-->
            @include('layouts.simple.sidebar')
            <!-- Page Sidebar Ends-->
            <div class="page-body">
                <!-- Container-fluid starts-->
                @yield('content')
                <!-- Container-fluid Ends-->
            </div>
            <!-- footer start-->
            @include('layouts.simple.footer')

        </div>
    </div>
    <!-- latest jquery-->
    @include('layouts.simple.script')
    <!-- Plugin used-->

    <script type="text/javascript">
    if ($(".page-wrapper").hasClass("horizontal-wrapper")) {
        $(".according-menu.other").css("display", "none");
        $(".sidebar-submenu").css("display", "block");
    }
    </script>
</body>

</html>
