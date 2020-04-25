<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <!-- Fonts -->


    <!-- CSS -->
    <link rel="icon" href="{{ asset('/img/logo.png') }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('/assets/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/material-dashboard.css?v=2.1.1') }}">
    <link rel="stylesheet" href="{{ asset('/css/demo.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/datatables/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/animate/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/sweetalert/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
    @stack('style')

    <!-- Styles -->



  <title> {{ page_title($title ?? '') }} </title>

</head>
<body>

    @include('partials.nav')

        <div class="content">
        <div class="container-fluid">

    @yield('content')

    </div>


    @include('partials.footer')
        @yield('footer')
    @include('flash.msg')

    </div>
</body>
</html>
