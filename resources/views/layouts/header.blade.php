<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- /.website title -->
    <title>{{ env('APP_NAME') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">--->
    <!-- CSS Files -->
    <link href="{{ asset('bootstrap/assets/css/bootstrap.min.css') }}" rel="stylesheet" media="screen">
    <link href="{{ asset('bootstrap/assets/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('bootstrap/assets/fonts/icon-7-stroke/css/pe-icon-7-stroke.css') }}" rel="stylesheet">
    <link href="{{ asset('bootstrap/assets/css/animate.css') }}" rel="stylesheet" media="screen">
    <!-- Colors -->
    <link href="{{ asset('bootstrap/assets/css/css-index.css') }}" rel="stylesheet" media="screen">
    <link href="{{ asset('bootstrap/assets/css/owl.theme.css') }}" rel="stylesheet" media="screen">
    <link href="{{ asset('bootstrap/assets/css/owl.carousel.css') }}" rel="stylesheet" media="screen">
    <!-- Google Fonts -->
    <link rel="stylesheet"
        href="http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic" />
    <!--For Birthday Picker-->
    <!-- <script src="//code.jquery.com/jquery-1.11.1.min.js"></script> -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <!-- App Favicon -->
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <!-- Modernizr js -->

    <!-- sfirt_front.blade styles -->
    <link href="{{ asset('css/front.css') }}" rel="stylesheet">

    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script src="../../js/app.js"></script>
</head>
