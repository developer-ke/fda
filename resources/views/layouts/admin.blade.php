<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('logo.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('favicon.ico') }}">
    <title>
        {{ env('APP_NAME') }}
    </title>
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <!-- Nucleo Icons -->
    <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />

    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>

    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    {{-- css for leaflet maps --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('assets/css/material-dashboard.css?v=3.1.0') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.5/css/dataTables.dataTables.css" />
    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.jqueryui.min.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css"> --}}
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <style>
        .fda-bg,
        .fda-bg:active,
        .fda-bg:hover {
            background-color: #C63D0F;
        }

        .fda-color {
            color: #C63D0F;
        }
    </style>
</head>


<body class="g-sidenav-show  bg-gray-100">
    <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-2 fixed-start ms-2"
        style="background-color:#C63D0F;" id="sidenav-main">
        <div class="sidenav-header">
            <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
                aria-hidden="true" id="iconSidenav"></i>
            <a class="navbar-brand m-0" href="{{ route('admin') }}" target="_blank">
                <img src="{{ asset('favicon.ico') }}" class="navbar-brand-img h-100" alt="main_logo">
                <span class="ms-1 font-weight-bold text-white">FoundDocument</span>
            </a>
        </div>
        <hr class="horizontal light mt-0 mb-2">
        <div class="collapse navbar-collapse  w-auto h-auto" id="sidenav-collapse-main">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link text-white " href="{{ route('admin') }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">dashboard</i>
                        </div>
                        <span class="nav-link-text ms-1">Dashboard</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-white " href="{{ route('admin.countries') }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="opacity-10">
                                <span class="fa fa-globe"></span>
                            </i>
                        </div>
                        <span class="nav-link-text ms-1">Countries</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-white " href="{{ route('admin.institutions') }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="opacity-10">
                                <span class="fa fa-bank"></span>
                            </i>
                        </div>
                        <span class="nav-link-text ms-1">Institutions</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white text-capitalize" href="{{ route('admin.contact-us') }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="opacity-10">
                                <span class="fa fa-exclamation-circle"></span>
                            </i>
                        </div>
                        <span class="nav-link-text ms-1">client support</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#documentsDropdown" class="nav-link text-white text-capitalize"
                        aria-controls="documentsDropdown" role="button" aria-expanded="false">
                        <div class="text-white text-center me-3 d-flex align-items-center justify-content-center">
                            <i class="opacity-10 ps-1">
                                <i class="fa fa-file"></i>
                            </i>
                        </div>
                        <span class="nav-link-text">documents</span>
                    </a>
                    <div class="collapse" id="documentsDropdown" style="">
                        <ul class="nav ">
                            <li class="nav-item text-capitalize">
                                <a class="nav-link text-white" href="{{ route('admin.lostDocuments') }}">
                                    <span class="sidenav-mini-icon">
                                        L
                                    </span>
                                    <span class="sidenav-normal  ms-2  ps-1">lost documents</span>
                                </a>
                            </li>
                            <li class="nav-item text-capitalize">
                                <a class="nav-link text-white" href="{{ route('admin.foundDocuments') }}">
                                    <span class="sidenav-mini-icon">F</span>
                                    <span class="sidenav-normal  ms-2  ps-1">found documents</span>
                                </a>
                            </li>
                            <li class="nav-item text-capitalize">
                                <a class="nav-link text-white" href="{{ route('admin.documentTypes') }}">
                                    <span class="sidenav-mini-icon">T</span>
                                    <span class="sidenav-normal  ms-2  ps-1">Types of documents</span>
                                </a>
                            </li>
                            <li class="nav-item text-capitalize">
                                <a class="nav-link text-white" href="{{ route('admin.claimedDocuments') }}">
                                    <span class="sidenav-mini-icon">C</span>
                                    <span class="sidenav-normal  ms-2  ps-1">claimed documents</span>
                                </a>
                            </li>
                            <li class="nav-item text-capitalize">
                                <a class="nav-link text-white" href="{{ route('admin.matchedDocuments') }}">
                                    <span class="sidenav-mini-icon">m</span>
                                    <span class="sidenav-normal  ms-2  ps-1">matched documents</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                {{-- start of drawers --}}
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#drawerDropdown" class="nav-link text-white text-capitalize"
                        aria-controls="drawerDropdown" role="button" aria-expanded="false">
                        <div class="text-white text-center me-3 d-flex align-items-center justify-content-center">
                            <i class="opacity-10 ps-1">
                                <i class="bi bi-file-spreadsheet-fill"></i>
                            </i>
                        </div>
                        <span class="nav-link-text">drawers</span>
                    </a>
                    <div class="collapse" id="drawerDropdown" style="">
                        <ul class="nav ">
                            <li class="nav-item text-capitalize">
                                <a class="nav-link text-white" href="{{ route('admin.clientsDrawer') }}">
                                    <span class="sidenav-mini-icon">c</span>
                                    <span class="sidenav-normal  ms-2  ps-1">client drawers</span>
                                </a>
                            </li>
                            <li class="nav-item text-capitalize">
                                <a class="nav-link text-white" href="{{ route('admin.myDrawer') }}">
                                    <span class="sidenav-mini-icon">m</span>
                                    <span class="sidenav-normal  ms-2  ps-1">my drawer</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                {{-- end of drawers --}}
                {{-- start of  cms --}}
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#cmsDropdown" class="nav-link text-white text-capitalize"
                        aria-controls="cmsDropdown" role="button" aria-expanded="false">
                        <div class="text-white text-center me-3 d-flex align-items-center justify-content-center">
                            <i class="opacity-10 ps-1">
                                <i class="fa fa-adn"></i>
                            </i>
                        </div>
                        <span class="nav-link-text">CMS</span>
                    </a>
                    <div class="collapse" id="cmsDropdown" style="">
                        <ul class="nav ">
                            <li class="nav-item text-capitalize">
                                <a class="nav-link text-white" href="{{ route('admin.cms1') }}">
                                    <span class="sidenav-mini-icon">F</span>
                                    <span class="sidenav-normal  ms-2  ps-1">first carousel</span>
                                </a>
                            </li>
                            <li class="nav-item text-capitalize">
                                <a class="nav-link text-white" href="{{ route('admin.cms2') }}">
                                    <span class="sidenav-mini-icon">s</span>
                                    <span class="sidenav-normal  ms-2  ps-1">second carousel</span>
                                </a>
                            </li>
                            <li class="nav-item text-capitalize">
                                <a class="nav-link text-white" href="{{ route('admin.partner') }}">
                                    <span class="sidenav-mini-icon">p</span>
                                    <span class="sidenav-normal  ms-2  ps-1">partners</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                {{-- end of cms --}}
                <li class="nav-item">
                    <a class="nav-link text-white text-capitalize " href="{{ route('admin.users') }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-users"></i>
                        </div>
                        <span class="nav-link-text ms-1">user management</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white text-capitalize " href="{{ route('admin.profile') }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-user-circle"></i>
                        </div>
                        <span class="nav-link-text ms-1">profile</span>
                    </a>
                </li>

                <li class="nav-item">
                    <form action="{{ route('logout') }}" id="logoutForm" method="post">
                        @csrf
                        <a class="nav-link text-white text-capitalize"
                            onclick="document.querySelector('#logoutForm').submit()">
                            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="fa fa-lock"></i>
                            </div>
                            <span class="nav-link-text ms-1">logout</span>
                        </a>
                    </form>
                </li>
            </ul>
        </div>
    </aside>

    <main class="main-content position-relative  h-100 border-radius-lg">
        <!-- Navbar -->
        <nav class="navbar navbar-main navbar-expand-lg position-sticky mt-2 top-1 px-0 mx-2 border-radius-xl z-index-sticky blur shadow-blur left-auto bg-gradient-danger"
            id="navbarBlur" data-scroll="true">
            <div class="container-fluid rounde-3 py-1">
                <div class="sidenav-toggler sidenav-toggler-inner d-xl-block d-none me-2 ">
                    <a href="javascript:;" class="nav-link p-0 text-body">
                        <div class="sidenav-toggler-inner">
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                        </div>
                    </a>
                </div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6">
                        <li class="breadcrumb-item text-sm text-capitalize"><a class="opacity-5 text-white"
                                href="javascript:;">admin</a></li>
                        <li class="breadcrumb-item text-sm text-light active text-capitalize" aria-current="page">
                            @php
                                echo $note;
                            @endphp
                        </li>
                    </ol>
                </nav>
                <div class="collapse navbar-collapse mt-sm-0  me-md-0 me-sm-4 justify-content-end" id="navbar">
                    <ul class="navbar-nav  justify-content-end">
                        <li class="nav-item  d-flex align-items-center mt-1">
                            <a href="javascript:;" class="nav-link text-light p-0">
                                <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>
                            </a>
                        </li>
                        <li class="nav-item dropdown mx-3 d-flex align-items-center mt-1">
                            <a href="javascript:;" class="nav-link text-light p-0" id="dropdownMenuButton"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-bell cursor-pointer">
                                    @php
                                        $notifications =
                                            session('users') +
                                            session('drawers') +
                                            session('institutions') +
                                            session('lostDocuments') +
                                            session('messages') +
                                            session('foundDocuments') +
                                            session('adverts');
                                    @endphp
                                    <span
                                        class="position-absolute top-0 translate-middle px-1 py-1 badge badge-sm rounded-circle bg-gradient-dark shadow"
                                        id="noteSpan" @if ($notifications == 0) hidden @endif>
                                        @php
                                            echo $notifications;
                                        @endphp
                                    </span>
                                </i>
                            </a>

                            <ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4"
                                aria-labelledby="dropdownMenuButton">
                                @if (session()->has('users'))
                                    <li class="mb-2">
                                        <a class="dropdown-item border-radius-md" href="{{ route('admin.users') }}">
                                            <div class="d-flex py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="text-sm font-weight-normal mb-1">
                                                        <span class="font-weight-bold">New message</span> from users
                                                        management
                                                        <span class="badge rounded-circle bg-danger px-1 py-1">
                                                            {{ session('users') }}
                                                        </span>
                                                    </h6>
                                                    <p class="text-xs text-secondary mb-0">
                                                        <i class="fa fa-clock me-1"></i>
                                                        minutes ago
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                @endif
                                @if (session()->has('drawers'))
                                    <li class="mb-2">
                                        <a class="dropdown-item border-radius-md"
                                            href="{{ route('admin.myDrawer') }}">
                                            <div class="d-flex py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="text-sm font-weight-normal mb-1">
                                                        <span class="font-weight-bold">New message</span> From my
                                                        drawer
                                                        <span class="badge rounded-circle bg-danger px-1 py-1">
                                                            {{ session('drawers') }}
                                                        </span>
                                                    </h6>
                                                    <p class="text-xs text-secondary mb-0">
                                                        <i class="fa fa-clock me-1"></i>
                                                        minutes ago
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                @endif

                                @if (session()->has('lostDocuments'))
                                    <li class="mb-2">
                                        <a class="dropdown-item border-radius-md"
                                            href="{{ route('admin.lostDocuments') }}">
                                            <div class="d-flex py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="text-sm font-weight-normal mb-1">
                                                        <span class="font-weight-bold">New message</span>
                                                        New lost documents
                                                        <span class="badge rounded-circle bg-danger px-1 py-1">
                                                            {{ session('lostDocuments') }}
                                                        </span>
                                                    </h6>
                                                    <p class="text-xs text-secondary mb-0">
                                                        <i class="fa fa-clock me-1"></i>
                                                        minutes ago
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                @endif
                                @if (session()->has('messages'))
                                    <li class="mb-2">
                                        <a class="dropdown-item border-radius-md"
                                            href="{{ route('admin.contact-us') }}">
                                            <div class="d-flex py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="text-sm font-weight-normal mb-1">
                                                        <span class="font-weight-bold">New message</span>
                                                        From unreplied messages
                                                        <span class="badge rounded-circle bg-danger px-1 py-1">
                                                            {{ session('messages') }}
                                                        </span>
                                                    </h6>
                                                    <p class="text-xs text-secondary mb-0">
                                                        <i class="fa fa-clock me-1"></i>
                                                        minutes ago
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                @endif
                                @if (session()->has('foundDocuments'))
                                    <li class="mb-2">
                                        <a class="dropdown-item border-radius-md"
                                            href="{{ route('admin.foundDocuments') }}">
                                            <div class="d-flex py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="text-sm font-weight-normal mb-1">
                                                        <span class="font-weight-bold">New message</span> From
                                                        found documents
                                                        <span class="badge rounded-circle bg-danger px-1 py-1">
                                                            {{ session('foundDocuments') }}
                                                        </span>
                                                    </h6>
                                                    <p class="text-xs text-secondary mb-0">
                                                        <i class="fa fa-clock me-1"></i>
                                                        minutes ago
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                @endif
                                @if (session()->has('adverts'))
                                    <li class="mb-2">
                                        <a class="dropdown-item border-radius-md" href="{{ route('admin.cms1') }}">
                                            <div class="d-flex py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="text-sm font-weight-normal mb-1">
                                                        <span class="font-weight-bold">New message</span> From
                                                        disabled adverts
                                                        <span class="badge rounded-circle bg-danger px-1 py-1">
                                                            {{ session('adverts') }}
                                                        </span>
                                                    </h6>
                                                    <p class="text-xs text-secondary mb-0">
                                                        <i class="fa fa-clock me-1"></i>
                                                        minutes ago
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                @endif
                                @if (session()->has('institutions'))
                                    <li class="mb-2">
                                        <a class="dropdown-item border-radius-md"
                                            href="{{ route('admin.institutions') }}">
                                            <div class="d-flex py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="text-sm font-weight-normal mb-1">
                                                        <span class="font-weight-bold">New message</span> From
                                                        blocked institutions
                                                        <span class="badge rounded-circle bg-danger px-1 py-1">
                                                            {{ session('institutions') }}
                                                        </span>
                                                    </h6>
                                                    <p class="text-xs text-secondary mb-0">
                                                        <i class="fa fa-clock me-1"></i>
                                                        times ago
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </li>
                        <li class="nav-item dropdown d-flex align-items-center">
                            <a href="javascript:;"
                                class="nav-link bg-gradient-dark  form-check-label text-white py-0 ps-0 pe-2  rounded-pill text-capitalize"
                                id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="{{ asset('uploads/profiles/' . Auth::user()->image) }}"
                                    class="avatar avatar-xs">
                                @php
                                    echo explode(' ', Auth::user()->name)[0];
                                @endphp
                            </a>
                            <ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4"
                                aria-labelledby="dropdownMenuButton">
                                <li class="mb-2">
                                    <a class="dropdown-item border-radius-md" href="{{ route('admin.profile') }}">
                                        <div class="d-flex ms-0">
                                            <div class="me-1 mt-0">
                                                <img src="{{ asset('uploads/profiles/' . Auth::user()->image) }}"
                                                    class="avatar avatar-md">
                                            </div>
                                            <div class="d-flex flex-column">
                                                <h6 class="text-sm font-weight-normal mt-1 mb-0">
                                                    <span class="font-weight-bold text-capitalize">
                                                        {{ Auth::user()->name }}
                                                    </span>
                                                </h6>
                                                <p class="text-sm text-secondary mt-0">
                                                    {{ Auth::user()->email }}
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="mb-2">
                                    <a class="dropdown-item border-radius-md text-capitalize fw-bold"
                                        href="{{ route('password.request') }}">
                                        <span class="fa fa-arrow-alt-circle-right"></span>
                                        Change password
                                    </a>
                                </li>
                                <li class="mb-2">
                                    <a class="dropdown-item border-radius-md text-capitalize fw-bold"
                                        href="{{ route('profile.change.picture') }}">
                                        <span class="fa fa-arrows"></span>
                                        change profile picture
                                    </a>
                                </li>
                                <li class="mb-2">
                                    <a class="dropdown-item border-radius-md text-capitalize fw-bold"
                                        href="javascript:;" data-bs-toggle="modal"
                                        data-bs-target="#confrim_password_modal">
                                        <span class="fa fa-trash"></span>
                                        delete account
                                    </a>
                                </li>
                                <li class="mb-2">
                                    <form action="{{ route('logout') }}" method="post">
                                        @csrf
                                        <button type="submit"
                                            class="dropdown-item border-radius-md text-capitalize fw-bold"
                                            href="javascript:;">
                                            <span class="fa fa-lock me-1"></span>
                                            logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                            <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                                <div class="sidenav-toggler-inner">
                                    <i class="sidenav-toggler-line"></i>
                                    <i class="sidenav-toggler-line"></i>
                                    <i class="sidenav-toggler-line"></i>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- End Navbar -->
        <div class="container-fluid py-3">
            @include('layouts.alerts')
            @include('layouts.modals')
            @yield('content')
            <footer class="footer py-4">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 text-center">
                            <h4 class="text-sm text-secondary">
                                copyright &copy;@php echo date('Y'); @endphp. All rights reserved.
                                <a href="{{ env('APP_URL') }}" class="fda-color">FoundDocument Agency</a>
                            </h4>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </main>

    <div class="fixed-plugin">
        <a class="fixed-plugin-button text-dark position-fixed px-3 py-2">
            <i class="material-icons py-2">settings</i>
        </a>
        <div class="card shadow-lg">
            <div class="card-header pb-0 pt-3">
                <div class="float-start">
                    <h5 class="mt-3 mb-0">FoundDocument Agency</h5>
                    <p>You loose it, we find it.</p>
                </div>
                <div class="float-end mt-4">
                    <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
                        <i class="material-icons">clear</i>
                    </button>
                </div>
                <!-- End Toggle Button -->
            </div>
            <hr class="horizontal dark my-1">
            <div class="card-body pt-sm-3 pt-0">
                <!-- Sidebar Backgrounds -->
                <div>
                    <h6 class="mb-0">Sidebar Colors</h6>
                </div>
                <a href="javascript:void(0)" class="switch-trigger background-color">
                    <div class="badge-colors my-2 text-start">
                        <span class="badge filter bg-gradient-primary active" data-color="primary"
                            onclick="sidebarColor(this)"></span>
                        <span class="badge filter bg-gradient-dark" data-color="dark"
                            onclick="sidebarColor(this)"></span>
                        <span class="badge filter bg-gradient-info" data-color="info"
                            onclick="sidebarColor(this)"></span>
                        <span class="badge filter bg-gradient-success" data-color="success"
                            onclick="sidebarColor(this)"></span>
                        <span class="badge filter bg-gradient-warning" data-color="warning"
                            onclick="sidebarColor(this)"></span>
                        <span class="badge filter bg-gradient-danger" data-color="danger"
                            onclick="sidebarColor(this)"></span>
                    </div>
                </a>

                <!-- Sidenav Type -->

                <div class="mt-3">
                    <h6 class="mb-0">Sidenav Type</h6>
                    <p class="text-sm">Choose between 2 different sidenav types.</p>
                </div>

                <div class="d-flex">
                    <button class="btn bg-gradient-dark px-3 mb-2 active" data-class="bg-gradient-dark"
                        onclick="sidebarType(this)">Dark</button>
                    <button class="btn bg-gradient-dark px-3 mb-2 ms-2" data-class="bg-transparent"
                        onclick="sidebarType(this)">Transparent</button>
                    <button class="btn bg-gradient-dark px-3 mb-2 ms-2" data-class="bg-white"
                        onclick="sidebarType(this)">White</button>
                </div>

                <p class="text-sm d-xl-none d-block mt-2">You can change the sidenav type just on desktop view.</p>
                <!-- Navbar Fixed -->
                <div class="mt-3 d-flex">
                    <h6 class="mb-0">Navbar Fixed</h6>
                    <div class="form-check form-switch ps-0 ms-auto my-auto">
                        <input class="form-check-input mt-1 ms-auto" type="checkbox" id="navbarFixed"
                            onclick="navbarFixed(this)">
                    </div>
                </div>

                <hr class="horizontal dark my-3">
                <div class="mt-2 d-flex">
                    <h6 class="mb-0">Light / Dark</h6>
                    <div class="form-check form-switch ps-0 ms-auto my-auto">
                        <input class="form-check-input mt-1 ms-auto" type="checkbox" id="dark-version"
                            onclick="darkMode(this)">
                    </div>
                </div>
                <hr class="horizontal dark my-sm-4">
            </div>
        </div>
    </div>
    <!--   Core JS Files   -->
    <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11?"></script>
    {{-- <script src="{{ asset('assets/js/plugins/dataTables.min.js') }}"></script> --}}
    <script src="https://cdn.datatables.net/2.1.5/js/dataTables.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns/dist/chartjs-adapter-date-fns.bundle.min.js">
    </script>
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    <script async defer src="https://buttons.github.io/buttons.js"></script>

    {{-- leaflet js files --}}
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{ asset('assets/js/material-dashboard.min.js?v=3.1.0') }}"></script>
    <script src="{{ asset('js/dataTable.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    @stack('scripts')
</body>

</html>
