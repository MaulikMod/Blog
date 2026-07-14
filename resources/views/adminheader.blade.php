<!DOCTYPE html>
<html lang="en">
<!-- [Head] start -->

<head>
    <title>The Daily Muse</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- [Meta] -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description"
        content="Berry is made using Bootstrap 5 design framework. Download the free admin template & use it for your project." />
    <meta name="keywords"
        content="Berry, Dashboard UI Kit, Bootstrap 5, Admin Template, Admin Dashboard, CRM, CMS, Bootstrap Admin Template" />
    <meta name="author" content="CodedThemes" />

    <!-- [Favicon] icon -->
    <link rel="icon" href="/assets/images/favicon.svg" type="image/x-icon" />
    <!-- [Google Font] Family -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap"
        id="main-font-link" />
    <!-- [Tabler Icons] https://tablericons.com -->
    <link rel="stylesheet" href="/assets/fonts/tabler-icons.min.css" />
    <!-- [Material Icons] https://fonts.google.com/icons -->
    <style>
        .navbar-brand {
            font-weight: 900 !important;
            font-size: 1.45rem !important;
            letter-spacing: 0.02em !important;
            text-decoration: none !important;
            color: #1a1a1a !important;
            /* Dark text for the light background */
            display: inline-block !important;
            /* Ensure it takes up proper space */
        }

        .navbar-brand span {
            color: #ffc107 !important;
            /* The yellow highlight */
        }
    </style>
    <link rel="stylesheet" href="/assets/fonts/material.css" />
    <!-- [Template CSS Files] -->
    <link rel="stylesheet" href="/assets/css/style.css" id="main-style-link" />
    <link rel="stylesheet" href="/assets/css/style-preset.css" id="preset-style-link" />


</head>
<!-- [Head] end -->
<!-- [Body] Start -->

<body>
    <!-- [ Pre-loader ] start -->
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>
    <!-- [ Pre-loader ] End -->
    <!-- [ Header Topbar ] start -->
    <header class="pc-header">
        <div class="m-header">
            <a class="b-brand navbar-brand m-0" href="{{ url('/') }}">
                Daliy <span>Thoughts</span>
            </a>
            <!-- ======= Menu collapse Icon ===== -->
            <div class="pc-h-item">
                <a href="#" class="pc-head-link head-link-secondary m-0" id="sidebar-hide">
                    <i class="ti ti-menu-2"></i>
                </a>
            </div>
        </div>
        <div class="header-wrapper"> <!-- [Mobile Media Block] start -->
            <div class="me-auto pc-mob-drp">
                <ul class="list-unstyled">
                    <li class="pc-h-item header-mobile-collapse">
                        <a href="#" class="pc-head-link head-link-secondary ms-0" id="mobile-collapse">
                            <i class="ti ti-menu-2"></i>
                        </a>
                    </li>
                    <li class="dropdown pc-h-item d-inline-flex d-md-none">
                        <a class="pc-head-link head-link-secondary dropdown-toggle arrow-none m-0"
                            data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false"
                            aria-expanded="false">
                            <i class="ti ti-search"></i>
                        </a>
                        <div class="dropdown-menu pc-h-dropdown drp-search">
                            <form class="px-3">
                                <div class="form-group mb-0 d-flex align-items-center">
                                    <i class="ti ti-search"></i>
                                    <input type="search" class="form-control border-0 shadow-none"
                                        placeholder="Search here..." />
                                </div>
                            </form>
                        </div>
                    </li>
                    <li class="pc-h-item d-none d-md-inline-flex">
                        <form class="header-search">
                            <i class="ti ti-search icon-search"></i>
                            <input type="search" class="form-control" placeholder="Search here..." />
                            <button class="btn btn-light-secondary btn-search"><i
                                    class="ti ti-adjustments-horizontal"></i></button>
                        </form>
                    </li>
                </ul>
            </div>
            <!-- [Mobile Media Block end] -->
            {{-- <div class="ms-auto">
                <ul class="list-unstyled">
                    <li class="dropdown pc-h-item header-user-profile">
                        <a class="pc-head-link head-link-primary dropdown-toggle arrow-none me-0"
                            data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false"
                            aria-expanded="false">
                            <img src="../assets/images/user/avatar-3.jpg" alt="user-image" class="user-avtar" />
                            <span>
                                <i class="ti ti-settings"></i>
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-user-profile dropdown-menu-end pc-h-dropdown">
                            <div class="dropdown-header">
                                <h4>Good Morning, <span class="small text-muted">Maulik Modi</span></h4>
                                <p class="text-muted">Project Admin</p>
                                <form class="header-search">
                                    <i class="ti ti-search icon-search"></i>
                                    <input type="search" class="form-control" placeholder="Search profile options" />
                                </form>
                                <hr />
                                <div class="profile-notification-scroll position-relative"
                                    style="max-height: calc(100vh - 280px)">
                                    <div class="settings-block bg-light-primary rounded">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" role="switch"
                                                id="flexSwitchCheckDefault" />
                                            <label class="form-check-label" for="flexSwitchCheckDefault">Start DND
                                                Mode</label>
                                        </div>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" role="switch"
                                                id="flexSwitchCheckChecked" checked />
                                            <label class="form-check-label" for="flexSwitchCheckChecked">Allow
                                                Notifications</label>
                                        </div>
                                    </div>
                                    <hr />
                                    <a href="#" class="dropdown-item">
                                        <i class="ti ti-settings"></i>
                                        <span>Account Settings</span>
                                    </a>
                                    <a href="#" class="dropdown-item">
                                        <i class="ti ti-user"></i>
                                        <span>Social Profile</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div> --}}
        </div>
    </header>
    <!-- [ Header ] end -->
    <!-- [ Sidebar Menu ] start -->
    <nav class="pc-sidebar">
        <div class="navbar-wrapper">
            {{-- <div class="m-header">
      <a href="/" class="b-brand">
        <!-- ========   Change your logo from here   ============ -->
        Time Zone
        {{-- <img src="../assets/images/logo-dark.svg" alt="" class="logo logo-lg" /> 
      </a>
    </div> --}}
            <div class="navbar-content">
                <ul class="pc-navbar">
                    <li class="pc-item pc-caption">
                        <label>Dashboard</label>
                        <i class="ti ti-dashboard"></i>
                    </li>
                    <li class="pc-item">
                        <a href="/admin" class="pc-link"><span class="pc-micon"><i
                                    class="fa-solid fa-chart-line"></i></span><span
                                class="pc-mtext">Dashboard</span></a>
                    </li>
                    <li class="pc-item pc-caption">
                        <label>Pages</label>
                        <i class="ti ti-news"></i>
                    </li>
                    <li class="pc-item pc-hasmenu">
                        <a href="/category" class="pc-link"><span class="pc-micon"><i
                                    class="fa-solid fa-list"></i></span><span class="pc-mtext">Category</span>
                        </a>

                    </li>

                    <li class="pc-item pc-hasmenu">
                        <a href="/post" class="pc-link"><span class="pc-micon"><i
                                    class="fa-solid fa-cube"></i></span><span class="pc-mtext">Post</span>
                        </a>

                    </li>

                    <li class="pc-item pc-hasmenu">
                        <a href="/users" class="pc-link"><span class="pc-micon"><i
                                    class="fa-regular fa-user"></i></span><span class="pc-mtext">Users</span>
                        </a>

                    </li>

                    <li class="pc-item pc-hasmenu">
                        <a href="/comment" class="pc-link"><span class="pc-micon"><i
                                    class="fa-brands fa-first-order"></i></span><span class="pc-mtext">Comments</span>
                        </a>

                    </li>

                    <li class="pc-item pc-hasmenu">
                        <a href="/login" class="pc-link"><span class="pc-micon"><i
                                    class="fa-solid fa-right-from-bracket"></i></span><span
                                class="pc-mtext">Logout</span>
                        </a>

                    </li>


                </ul>

            </div>
        </div>
    </nav>
    <!-- [ Sidebar Menu ] end -->
