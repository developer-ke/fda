<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- /.website title -->
    <title>{{ env('APP_NAME') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">--->
    <!-- CSS Files -->
    <link href="{{ asset('bstp/assets/css/bootstrap.min.css') }}" rel="stylesheet" media="screen">
    <link href="{{ asset('bstp/assets/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('bstp/assets/fonts/icon-7-stroke/css/pe-icon-7-stroke.css') }}" rel="stylesheet">
    <link href="{{ asset('bstp/assets/css/animate.css') }}" rel="stylesheet" media="screen">
    <!-- Colors -->
    <link href="{{ asset('bstp/assets/css/css-index.css') }}" rel="stylesheet" media="screen">
    <link href="{{ asset('bstp/assets/css/owl.theme.css') }}" rel="stylesheet" media="screen">
    <link href="{{ asset('bstp/assets/css/owl.carousel.css') }}" rel="stylesheet" media="screen">
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
    <style>
        * {
            font-family: new roman --bs-font-sans-serif: system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", "Noto Sans", "Liberation Sans", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
        }

        #Partners {
            min-height: 100vh;
            background-color: #C63D0F;
        }

        #Partners h2 {
            color: white;
        }
    </style>
</head>

<body data-spy="scroll" data-target="#navbar-scroll">
    <div id="top">
        @include('layouts.message')
    </div>
    <div id="myCarousel" class="hero-carousel carousel slide hidden-xs hidden-sm" data-ride="carousel">
        <div class="logo wow fadeInDown">
            <a href="">
                <img src="{{ asset('logo.png') }}" alt="logo">
            </a>
        </div>
        @php
            $counter = 0;
        @endphp
        <ol class="carousel-indicators">
            @foreach ($advertOnes->where('status', 1) as $advert)
                <!-- Indicators -->
                <li data-target="#myCarousel" data-slide-to="@php echo $counter @endphp"
                    class="@if ($counter == 0) active @endif">
                </li>
                @php
                    $counter += 1;
                @endphp
            @endforeach
        </ol>


        <!-- Wrapper for slides -->
        <div class="carousel-inner" style="height: 100vh">
            @php
                $counter = 0;
            @endphp
            @foreach ($advertOnes->where('status', 1) as $advert)
                <div class="item @if ($counter === 0) active @endif">
                    <img src="{{ asset('assets/cms/' . $advert->image) }}" alt="Chania" id='img3'>
                    <div class="container">
                        <div class="carousel-caption  hidden-xs hidden-sm" id="caption">
                            <div class="Ad-Spaces" id='caption1' style="background-color: {{ $advert->div_bg }};">
                                <!-- /.main title -->
                                <h1 class="wow
                                fadeInLeft"
                                    style="color: {{ $advert->header_color }};">
                                    {{ $advert->header }}
                                </h1>
                                <!-- /.header paragraph -->
                                <div class="landing-text wow fadeInUp">
                                    <p style="color: {{ $advert->body_text_color }};">
                                        {{ $advert->body_text }}</p>
                                </div>
                            </div>
                            <!-- /.header button -->
                            <div class="head-btn wow fadeInLeft">
                                <a onmouseover="this.style.background='none'; this.style.border='1px solid #808000'; this.style.color='#808000';"
                                    onMouseOut="this.style.background=' #808000'; this.style.color='#FFF';"
                                    style="background-color: {{ $advert->btn_bg }}; color:{{ $advert->btn_color }}"
                                    href="{{ $advert->url }}" class="btn-primary btn_left_link">
                                    {{ $advert->btn_text }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @php
                    $counter += 1;
                @endphp
            @endforeach

        </div>
    </div>
    <!-- /.parallax full screen background image -->
    <div class="fullscreen landing parallax"
        style="background-image: url(&quot;{{ asset('bootstrap/assets/images/carouselImages/SlideThree.jpg') }}&quot;); background-attachment: fixed; background-size: 1023.26px 682px; background-position: 50% -114.058px;"
        data-img-width="2000" data-img-height="1333" data-diff="100">
        <div class="container" style="background-color: rgba(0, 0, 0, 0.5);">
            <div class="hidden-md hidden-lg">
                <!-- /.logo -->
                <div class="logo wow fadeInDown animated animated" id="logo">
                    <a href="">
                        <img src="{{ asset('bootstrap/assets/images/logo2.png') }}" alt="logo">
                    </a>
                </div>
                <!-- /.main title -->
                <h1 class="wow fadeInLeft animated animated" id='mainh1'>
                    You Lose It, We Find It!
                </h1>

                <!-- /.header paragraph -->
                <div class="landing-text wow fadeInUp animated animated" id='hp'>
                    <p>Found Document Centre is a fully incorporated local firm dedicated to the effective and efficient
                        recovery
                        of lost documents and other properties within the shortest time possible.</p>
                </div>
                <!-- /.header button -->
                <div class="head-btn wow fadeInLeft animated animated" id="hbtn">
                    <a href="#feature" class="btn-primary">Our Partners</a>
                    <a href="#download" class="btn-default">Lost Document</a>
                </div>

            </div>
            <!-- col col-md-6 mx-auto -->
            <div class="custom-overlay">
                <!-- <div class="landing-report " id='tab'> -->
                <div class="signup-header landing-report wow fadeInUp animated">

                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible  show" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                <span class="sr-only">Close</span>
                            </button>
                            <strong>Success !</strong>
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert  alert-dismissible" role="alert" style="background-color: red;">
                            {{ session('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <ul class="nav nav-tabs " role="tablist">
                        <li class="nav-item active " id="myTab">
                            <a class="nav-link " data-toggle="tab" data-target ="#found" id="form-found"
                                href="#" role="tab">Report Found Document</a>
                        </li>
                        <li class="nav-item" id="myTabb">
                            <a class="nav-link" data-toggle="tab" data-target ="#lost" id="form-lost"
                                href="#" role="tab">Report Lost Document</a>
                        </li>
                    </ul>
                    {{-- report found document form --}}
                    <div class="tab-content found-container">
                        <div class="tab-pane active" id="found" role="tabpanel">
                            <span class="alert-danger"> </span>
                            <p id='tp'>Provide below, information of the document you found.</p>
                            <form class="form-header" action="{{ route('report_found_document') }}"
                                class="form-header" id="freport-form" method="post" accept-charset="utf-8">
                                @csrf
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <div class="form-group form-inline">
                                    <select name="document_type_id" id="fdocumentType" class='form-control' required>
                                        <option value="" selected="selected" disabled>Select document Type
                                        </option>
                                        @foreach ($types as $document_type)
                                            <option value="{{ $document_type->id }}">
                                                {{ $document_type->name }}</option>
                                        @endforeach
                                    </select>
                                    <input class="form-control " name="document_serial_number" id="fserialno"
                                        type="text" placeholder="Enter Document/Serial No" required
                                        value="{{ old('document_serial_number') }}">
                                </div>
                                <div class="form-group form-inline">
                                    <input class="form-control institution" name="institution_on_doc"
                                        id="institutionFound" type="text"
                                        placeholder="Enter institution on document"
                                        value="{{ old('institution_on_doc') }}">
                                    <select name="country_id" id="fcountry" class='form-control' required>
                                        <option value="" selected="selected" disabled>Country on document
                                        </option>
                                        @foreach ($countries as $country)
                                            <option value="{{ $country->id }}">{{ $country->name }}
                                            </option>
                                        @endforeach
                                    </select>

                                </div>
                                <div class="form-group form-inline hidden">
                                    <input class="form-control" name="latitude" id="latitude" type="text"
                                        placeholder="latitude" required value="{{ old('latitude') }}">
                                    <input class="form-control" name="longitude" id="longitude" type="text"
                                        placeholder="longituder" required value="{{ old('longitude') }}">
                                </div>
                                <div class="form-group form-inline">
                                    <input class="form-control flocation" name="coordinates" id="flocation"
                                        type="text" placeholder="Click the button on the right" required
                                        value="{{ old('coordinates') }}" readonly>
                                    <button type="button" class="btn-info form-control GeoLocationBtn"
                                        id='btn'>
                                        <i class="fa fa-crosshairs" aria-hidden="true"></i> </button>
                                </div>

                                <div class="form-group form-inline">
                                    <input class="form-control" name="Owners_first_name" id="fownerfirstname"
                                        type="text" placeholder="Owner's first name" required
                                        value="{{ old('Owners_first_name') }}">
                                    <input class="form-control" name="Owners_last_name" id="fownerlastname"
                                        type="text" placeholder="Owner's last name" required
                                        value="{{ old('Owners_last_name') }}">
                                </div>
                                <br>
                                <p style="color: whitesmoke;">
                                    Reporter's details.
                                    <br>
                                    Kindly provide your details as a reporter.
                                </p>
                                <div class="form-group form-inline">
                                    <input class="form-control " name="email_address" id="femailaddress"
                                        type="email" placeholder="Your email" value="{{ old('email_address') }}"
                                        required>
                                    <input class="form-control " name="fcountrycode" id="fcountrycode"
                                        type="text" placeholder="Code" value="{{ old('fcountrycode') }}"
                                        required>
                                    <input class="form-control " name="phone_number" id="fphonenumber"
                                        type="text" placeholder="Phone number" value="{{ old('phone_number') }}"
                                        required>
                                </div>

                                <div class="form-group form-inline">
                                    <input class="form-control " name="ffirst_name" id="freportername"
                                        type="text" placeholder="First name" value="{{ old('first_name') }}"
                                        required>
                                    <input class="form-control " name="flast_name" id="freporterlastname"
                                        type="text" placeholder="Last name" value="{{ old('last_name') }}"
                                        required>
                                </div>
                                <br>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <p class="privacy text-left">
                                            <!-- MADE THIS PART SIMILAR TO ABOVE -->
                                            <input type="checkbox" name="fterm" id="fterm" required>I agree
                                            to <a href="">Terms & Policies.</a>
                                        </p>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <button id='fsubmit' type="submit" class="btn btn-primary"
                                        disabled>Submit</button>
                                </div>

                            </form>
                        </div>

                        {{-- report lost documents form --}}
                        <div class="tab-pane" id="lost" role="tabpanel">
                            <p id='lp'>Provide information for lost document below.</p>
                            <form action="{{ route('report_lost_document') }}" class="form-header" id="lreport-form"
                                method="post" accept-charset="utf-8">
                                @csrf
                                <input type="hidden" name="rtype" value="Lost">
                                <!-- <input type="hidden" name="id" value="bfdba52708"> -->
                                <div class="form-group form-inline">
                                    <select name="document_type_id" id="ldocumentType" class='form-control' required>
                                        <option value="" selected="selected" disabled>Select document Type
                                        </option>
                                        @foreach ($types as $document_type)
                                            <option value="{{ $document_type->id }}">
                                                {{ $document_type->name }}</option>
                                        @endforeach
                                    </select>
                                    <input class="form-control " name="document_serial_number" id="lserialno"
                                        type="text" placeholder="Enter Document/Serial No" value=""
                                        required>
                                </div>
                                <div class="form-group form-inline">
                                    <input class="form-control institution" name="institution_on_doc"
                                        id="institution-found" type="text"
                                        placeholder="Enter institution on documen(Optional)"
                                        value="{{ old('institution_on_doc') }}">

                                    <select name="country_id" id="lcountry" class='form-control' required>
                                        <option value="" selected="selected" disabled>Country on Document
                                        </option>
                                        @foreach ($countries as $country)
                                            <option value="{{ $country->id }}">{{ $country->name }}
                                            </option>
                                        @endforeach
                                    </select>

                                </div>
                                <div class="form-group form-inline">
                                    <input class="form-control " name="locationLost" id="llocation" type="text"
                                        placeholder="Location you Lost it" value="" required>
                                    <input class="form-control " name="police_refNo" id="policeRef" type="text"
                                        placeholder="Police report ref no." value="">
                                    <!-- <button type="button" class="btn-info form-control"> Get Coordinates </button> -->
                                </div>
                                <div class="form-group form-inline">
                                    <input class="form-control " name="fname" id="lownerfirstname" type="text"
                                        placeholder="Your first name" value="" required>
                                    <input class="form-control " name="lname" id="lownerlastname" type="text"
                                        placeholder="Your last name" value="" required>
                                </div>


                                <p>Return Address</p>
                                <p id='tp'> Provide your return address and detail below</p>
                                <!-- <div class="form-group form-inline">
                                                <input class="form-control " name="email_address" id="lemailaddress" type="email" placeholder="Your email"  value="{{ old('email_address') }}" required>
                                                <input  class="form-control " name="lcountrycode" id="lcountrycode" type="text" placeholder="Code" value="{{ old('fcountrycode') }}" required>
                                                <input class="form-control " name="phone_number" id="lphonenumber" type="text" placeholder="Phone number" value="{{ old('phone_number') }}" required>
                                            </div>  -->
                                <div class="form-group form-inline">
                                    <input class="form-control " name="email_address" id="femailaddress"
                                        type="email" placeholder="Your email" value="{{ old('email_address') }}"
                                        required>
                                    <input class="form-control " name="lcountrycode" id="fcountrycode"
                                        type="text" placeholder="Code" value="{{ old('fcountrycode') }}"
                                        required>
                                    <input class="form-control " name="lphone_number" id="fphonenumber"
                                        type="text" placeholder="Phone number" value="{{ old('phone_number') }}"
                                        required>
                                </div>

                                <div class="form-group">
                                    <input class="form-control " name="return_address" id="ReturnAddress"
                                        type="text" placeholder="Post and physical address" value=""
                                        required>
                                </div>

                                <div class="form-group"> </div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <p class="privacy text-left">
                                            <!-- MADE THIS PART SIMILAR TO ABOVE -->
                                            <input type="checkbox" name="lostTerm" id="lostTerm" required>I
                                            agree to <a href="">Terms & Policies.</a>
                                        </p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" id="lbtn" class="btn btn-primary"
                                        disabled>Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- NAVIGATION -->
    <div id="menu">
        <nav class="navbar-wrapper navbar-default" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse"
                        data-target=".navbar-backyard">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand site-name" href="#top">
                        <img src="{{ asset('logo.png') }}" alt="logo">
                    </a>
                </div>
                <div id="navbar-scroll" class="collapse navbar-collapse navbar-backyard navbar-right">
                    <ul class="nav navbar-nav">
                        <li>
                            <a href="#top">Home</a>
                        </li>
                        <li class="dropdown">
                            <a href="#about">About Us <b class="caret"></b></a>
                            <ul class="dropdown-menu" id="menu1">
                                <li>
                                    <a href="#ourplatform">Our Platform</a>
                                </li>
                                <li>
                                    <a href="#service">Our
                                        Services</a><!-- This section also need some styling and to be given appropriate content -->
                                </li>
                                <!--<li>
                                            <a href="#">Our Team</a>
                                            </li>--> <!-- Subtitle hidden because content not yet in place -->
                                <li>
                                    <a href="#reportingflow">Reporting
                                        Flow</a><!-- The ID should be customized to reflect the body of the section. Comment above the section should also be made appropriate -->
                                </li>
                                <li>
                                    <a href="#download">Our
                                        Partners</a><!-- The ID should be customized to reflect the body of the section. Comment above the section should also be made appropriate -->
                                </li>
                                <!-- <li class="">
                                        <a href="#package">Our Stats</a>
                                    </li> -->
                            </ul>
                        </li>
                        <li class="dropdown">
                            <!-- The href ID change from service to Stats section which is named as packe with comment pricing section. This should also be customised -->
                            <a href="#package" data-toggle="dropdown" class="dropdown-toggle">
                                Our Stats
                                <!-- <b class="caret"></b> --><!-- Since there is no dropdown, this has been hidden -->
                            </a>
                        </li>
                        <li>
                            <a href="#testi">Clients Say</a>
                        </li>
                        <li>
                            <a href="#contact">Contact</a>
                        </li>
                        <li>
                            <a href="{{ route('login') }}">Login</a>
                        </li>
                        <li>
                            <a href="{{ route('register') }}">Register</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <!-- Our Platform Section -->
    <div id="ourplatform">
        @include('layouts.ourplatform')
    </div>

    <!-- Service Section  -->
    <!-- This section had comments with the word "feature". These have been changed to "service"-->
    <div id="service">
        @include('layouts.services')
    </div>
    <!-- / Reporting Flow Section   -->
    <section id="reportingflow" class="order-process-step">
        <div class="col-md-10 col-md-offset-1 col-sm-12 text-center service-title">
            <!-- /.Reporting Flow title -->
            <h2 class="text-center wow fadeInLeft animated" id="rh">Reporting Flow</h2>
            <div class="title-line wow fadeInRight animated" id="rd"></div>
        </div>
        <div class="container frontend">
            <div class="clearfix"></div>
            <div class="block process-block">
                <!--<h2 class="text-center" style="margin-top: 15px; font-weight: 400;  margin-bottom: 25px;">Services</h2>-->
                <div class="row text-center">
                    <ol class="process">
                        <li class="col-md-3 col-sm-6 col-xs-12">
                            <i class="fa fa-eye" aria-hidden="true"></i>
                            <h4>Find an Item</h4>
                        </li>
                        <li class="col-md-3 col-sm-6 col-xs-12">
                            <i class="fa fa-bullhorn"></i>
                            <h4>Report to Us</h4>
                        </li>
                        <li class="col-md-3 col-sm-6 col-xs-12">
                            <i class="fa fa-file"></i>
                            <h4>Report a Lost Item</h4>
                        </li>
                        <li class="col-md-3 col-sm-6 col-xs-12">
                            <i class="fa fa-thumbs-o-up"></i>
                            <h4>Get your Item!</h4>
                        </li>
                    </ol>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
        </div>
    </section>
    <section id="Partners" class="min-vh-100 align-items-center justify-content-center">
        <div class="container">
            <h2 class="text-center wow fadeInLeft partner-style">Our Partners</h2>
            <div class="row" style="margin-top: 20px">
                <div class="col-md-12">
                    <div id="Carousel" class="carousel slide">
                        @php
                            $totalPartners = count($partners);
                            $partnersPerSlide = 8;
                            $totalSlides = ceil($totalPartners / $partnersPerSlide);
                        @endphp

                        <ol class="carousel-indicators">
                            @for ($i = 0; $i < $totalSlides; $i++)
                                <li data-target="#Carousel" data-slide-to="{{ $i }}"
                                    class="@if ($i === 0) active @endif"></li>
                            @endfor
                        </ol>

                        <!-- Carousel items -->
                        <div class="carousel-inner">
                            @for ($i = 0; $i <= $totalSlides; $i++)
                                <div class="carousel-item @if ($i === 0) active @endif">
                                    <div class="row">
                                        @for ($j = 0; $j < $partnersPerSlide; $j++)
                                            @php
                                                $index = $i * $partnersPerSlide + $j;
                                            @endphp
                                            @if ($index < $totalPartners)
                                                <div class="col-12 col-md-3 mb-5">
                                                    <div class="card h-100" style="margin-bottom: 20px">
                                                        <img src="{{ asset('assets/cms/' . $partners[$index]->logo) }}"
                                                            alt="Logo" class="card-img-top img-fluidm"
                                                            height="200px" width="300px">
                                                    </div>
                                                </div>
                                            @endif
                                        @endfor
                                    </div>
                                </div>
                            @endfor
                        </div>
                        <!--.carousel-inner-->
                    </div>
                    <!--.Carousel-->
                </div>

            </div>

        </div>
        <!--.container-->
    </section>

    <!-- /.pricing section -->
    <div id="package" class="counters align-items-center justify-content-center">
        <div class="container">
            <div class="text-center">
                <!-- /.pricing title -->
                <h2>Our Stats</h2>
                <div class="title-line wow fadeInRight"></div>
            </div>
            <div class="row package-option">
                <!-- /.package 1 -->
                <div class="col-sm-3">
                    <div class="price-box ">
                        <!-- /.price -->
                        <div class="price-group text-center">
                            <span class="price ">
                                {{ $visits->count() }}
                            </span>
                            <h3>Visitors</h3>
                        </div>
                    </div>
                </div>
                <!-- /.package 2 -->
                <div class="col-sm-3">
                    <div class="price-box " data-wow-delay="0.2s">
                        <!-- /.price -->
                        <div class="price-group text-center">
                            <span class="price ">{{ $lostDocuments->where('status', 0)->count() }}</span>
                            <h3>Lost</h3>
                        </div>
                    </div>
                </div>
                <!-- /.package 3 -->
                <div class="col-sm-3">
                    <div class="price-box " data-wow-delay="0.4s">
                        <!-- /.price -->
                        <div class="price-group text-center">
                            <span class="price">{{ $foundDocuments->where('status', 0)->count() }}</span>
                            <h3>Found</h3>
                        </div>
                    </div>
                </div>
                <!-- /.package 4 -->
                <div class="col-sm-3">
                    <div class="price-box " data-wow-delay="0.6s">
                        <!-- /.price -->
                        <div class="price-group text-center">
                            <span
                                class="price">{{ $foundDocuments->where('status', 3)->count() + $lostDocuments->where('status', 3)->count() }}</span>
                            <h3>Claimed</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.client section -->

    <!-- /.testimonial section -->
    <div id="testi">
        @include('layouts.testimony')
    </div>
    <!-- /.contact section -->
    <div id="contact">
        @include('layouts.contact')
    </div>
    <!--/.footer -->
    @include('layouts/footer')
    <!-- /.javascript files -->
    <script src="{{ asset('bstp/assets/js/jquery.js') }}"></script>
    <script src="{{ asset('bstp/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('bstp/assets/js/custom.js') }}"></script>
    <script src="{{ asset('bstp/assets/js/jquery.sticky.js') }}"></script>
    <script src="{{ asset('bstp/assets/js/wow.min.js') }}"></script>
    <script src="{{ asset('bstp/assets/js/owl.carousel.min.js') }}"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        new WOW().init();
        $(allInView);
        $(window).scroll(allInView);


        function isScrolledIntoView(elem) {
            var docViewTop = $(window).scrollTop();
            var docViewBottom = docViewTop + $(window).height();

            var elemTop = $(elem).offset().top;
            var elemBottom = elemTop + $(elem).height();

            return ((elemBottom <= docViewBottom) && (elemTop >= docViewTop));
        }


        function allInView() {


            $('.count').each(function() {
                $(this).prop('Counter', 0).animate({
                    Counter: $(this).text()
                }, {
                    duration: 4000,
                    easing: 'swing',
                    step: function(now) {
                        $(this).text(Math.ceil(now));
                    }
                });
            });
        }

        $('#myTab a').click(function(e) {
            e.preventDefault()
            $(this).tab('show')
        });
        //show the first tab form, report found document
        $(function() {
            $('#myTab a:first').tab('show')
        })

        //Carousel interval
        $(document).ready(function() {
            $('#Carousel').carousel({
                interval: 3000
            })
        });
    </script>
    <script>
        var resizefunc = [];
    </script>
    <script>
        var resizefunc = [];
    </script>
    <script src="{{ asset('assets/js/app.js') }}"></script>

</body>

</html>
