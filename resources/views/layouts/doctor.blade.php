<!DOCTYPE html>
<html lang="en">

<!-- doccure/doctor-dashboard.html  30 Nov 2019 04:12:03 GMT -->

<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <?php $s = App\Setting::where('status', 1)->first(); ?>
    <!-- Favicons -->
    <link href="{{ asset('files/uploads/' . $s->logo) }}" rel="icon">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">

    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/all.min.css') }}">
    <!-- Select2 CSS -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap-tagsinput/css/bootstrap-tagsinput.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/plugins/dropzone/dropzone.min.css') }}">

    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    <style>
        .bb {
            width: 100%;
            max-width: 1120px;
            height: 400px;
            overflow: auto;
            overflow-x: hidden;
        }

        .scroll-sub {
            width: 100%;
            max-width: 1120px;
            height: 400px;
            overflow: auto;
            overflow-x: hidden;
        }
    </style>

    @stack('styles')

</head>

<body>

    <!-- Main Wrapper -->
    <div class="main-wrapper">
        <!-- Header -->
        <header class="header sticky-top">
            <nav class="navbar navbar-expand-lg header-nav">
                <div class="navbar-header">
                    <a id="mobile_btn" href="javascript:void(0);">
                        <span class="bar-icon">
                            <span></span>
                            <span></span>
                            <span></span>
                        </span>
                    </a>
                    <a href="index-2.html" class="navbar-brand logo">
                        <img src="{{ asset('files/uploads/' . $s->logo) }}" class="" height="60"
                            alt="Logo">
                    </a>
                </div>
                <div class="main-menu-wrapper">
                    <div class="menu-header">
                        <a href="index-2.html" class="menu-logo">
                            <img src="{{ asset('files/uploads/' . $s->logo) }}" class="" height="60"
                                alt="Logo">
                        </a>
                        <a id="menu_close" class="menu-close" href="javascript:void(0);">
                            <i class="fas fa-times"></i>
                        </a>
                    </div>
                    <ul class="main-nav">
                        <li>
                            <a href="{{ url('/') }}">Home</a>
                        </li>
                        <li class="has-submenu">
                            <a href="#">Doctors Find <i class="fas fa-chevron-down"></i></a>
                            <ul class="submenu scroll-sub">
                                <?php $category = App\Category::orderBy('id', 'DESC')->get();
                                ?>
                                @foreach ($category as $menu)
                                    <li><a href="{{ url('type/' . encrypt($menu->id)) }}">{{ $menu->name }}</a></li>
                                @endforeach
                            </ul>
                        </li>
                    </ul>
                </div>
                <ul class="nav header-navbar-rht">
                    <li class="nav-item contact-item">
                        <div class="header-contact-img">
                            <i class="far fa-hospital"></i>
                        </div>
                        <div class="header-contact-detail">
                            <p class="contact-header">Contact</p>
                            <p class="contact-info-header">{{ Auth::user()->phone }}</p>
                        </div>
                    </li>

                    <!-- User Menu -->
                    <li class="nav-item dropdown has-arrow">
                        <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                            <span class="user-img">
                                @if (Auth::user()->photo)
                                    <img src="{{ asset('files/uploads/' . Auth::user()->photo) }}" alt="User Image"
                                        class="rounded-circle">
                                @else
                                    <img class="rounded-circle" src="{{ asset('assets/img/profile.png') }}"
                                        alt="User Image">
                                @endif
                            </span>
                        </a>
                        <div class="dropdown-menu">

                            <a class="dropdown-item" href="{{ url('doctor/') }}">Dashboard</a>
                            <a class="dropdown-item" href="#">Settings</a>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
														 document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                style="display: none;">
                                @csrf
                            </form>

                        </div>
                    </li>
                    <li></li>
                    <!-- Authentication Links -->
                    <!-- /User Menu -->
                </ul>
            </nav>
        </header>
        <!-- /Header -->

        <!-- Breadcrumb -->
        <div class="breadcrumb-bar">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-12 col-12">
                        <nav aria-label="breadcrumb" class="page-breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                            </ol>
                        </nav>
                        <h2 class="breadcrumb-title">Dashboard</h2>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Breadcrumb -->

        <!-- Page Content -->
        <div class="content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar">

                        <!-- Profile Sidebar -->
                        <div class="profile-sidebar">
                            <div class="widget-profile pro-widget-content">
                                <div class="profile-info-widget">
                                    <a href="#" class="booking-doc-img">
                                        @if (Auth::user()->photo)
                                            <img src="{{ asset('files/uploads/' . Auth::user()->photo) }}"
                                                alt="User Image" class="">
                                        @else
                                            <img class="" src="{{ asset('assets/img/profile.png') }}"
                                                alt="User Image">
                                        @endif

                                    </a>
                                    <div class="profile-det-info">
                                        <h3>{{ Auth::user()->fname }} {{ Auth::user()->lname }}</h3>

                                        <div class="patient-details">
                                            <h5 class="mb-0">{{ Auth::user()->designa }}</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="dashboard-widget">
                                <nav class="dashboard-menu">
                                    <ul>
                                        <li class="@active('doctor')">
                                            <a href="{{ url('doctor') }}">
                                                <i class="fas fa-columns"></i>
                                                <span>Dashboard</span>
                                            </a>
                                        </li>
                                        <li class="@active('doctor/appointment')">
                                            <a href="{{ url('doctor/appointment') }}">
                                                <i class="far fa-calendar-check"></i>
                                                <span>Appointment</span>
                                            </a>
                                        </li>
                                        <li class="@active('doctor/schedule')">
                                            <a href={{ url('doctor/schedule') }}>
                                                <i class="fas fa-hourglass-start"></i>
                                                <span>Schedule Timings</span>
                                            </a>
                                        </li>
                                        <li class="@active('doctor-profile-settings')">
                                            <a href="{{ url('doctor-profile-settings') }}">
                                                <i class="fas fa-user-cog"></i>
                                                <span>Profile Settings</span>
                                            </a>
                                        </li>


                                        <li class="@active('doctor/review')">
                                            <a href="{{ url('doctor/review') }}">
                                                <i class="fas fa-star"></i>
                                                <span>Reviews</span>
                                            </a>
                                        </li>
                                        <li class="@active('doctor-backround')">
                                            <a href="{{ url('doctor-backround') }}">
                                                <i class="fas fa-hourglass-start"></i>
                                                <span>Doctor Backround</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="" href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
														 document.getElementById('logout-form').submit();">
                                                <i class="fas fa-sign-out-alt"></i>
                                                <span>Logout</span>
                                            </a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <!-- /Profile Sidebar -->

                    </div>
                    @yield('content')
                </div>

            </div>

        </div>
        <!-- /Page Content -->

        <!-- Footer -->
        <footer class="footer">

            <!-- Footer Top -->
            <div class="footer-top">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-4 col-md-6">

                            <!-- Footer Widget -->
                            <div class="footer-widget footer-about">
                                <div class="footer-logo">
                                    <img src="{{ asset('files/uploads/' . $s->logo) }}" height="100"
                                        width="150" alt="logo">
                                </div>
                                <div class="footer-about-content">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                        incididunt ut labore et dolore magna aliqua. </p>
                                    <div class="social-icon">
                                        <ul>
                                            <li>
                                                <a href="{{ $s->facbook }}" target="_blank"><i
                                                        class="fab fa-facebook-f"></i> </a>
                                            </li>
                                            <li>
                                                <a href="{{ $s->twitter }}" target="_blank"><i
                                                        class="fab fa-twitter"></i> </a>
                                            </li>
                                            <li>
                                                <a href="{{ $s->linkdin }}" target="_blank"><i
                                                        class="fab fa-linkedin-in"></i></a>
                                            </li>
                                            <li>
                                                <a href="{{ $s->instagram }}" target="_blank"><i
                                                        class="fab fa-instagram"></i></a>
                                            </li>
                                            <li>
                                                <a href="{{ $s->youtube }}" target="_blank"><i
                                                        class="fab fa-youtube"></i> </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- /Footer Widget -->

                        </div>

                        <div class="col-lg-4 col-md-6">

                            <!-- Footer Widget -->
                            <div class="footer-widget footer-menu">
                                <h2 class="footer-title">Information </h2>
                                <ul>
                                    {{--  <li><a href="search.html"><i class="fas fa-angle-double-right"></i> Search for Doctors</a></li>  --}}
                                    <li><a href="{{ url('login') }}"><i class="fas fa-angle-double-right"></i>
                                            Login</a></li>
                                    <li><a href="{{ url('register') }}"><i
                                                class="fas fa-angle-double-right"></i>Doctor Register</a></li>
                                    <li><a href="#"><i class="fas fa-angle-double-right"></i> Page</a></li>

                                </ul>
                            </div>
                            <!-- /Footer Widget -->

                        </div>

                        {{--  <div class="col-lg-3 col-md-6">

								<!-- Footer Widget -->
								<div class="footer-widget footer-menu">
									<h2 class="footer-title">For Doctors</h2>
									<ul>
										<li><a href="appointments.html"><i class="fas fa-angle-double-right"></i> Appointments</a></li>
										<li><a href="chat.html"><i class="fas fa-angle-double-right"></i> Chat</a></li>
										<li><a href="login.html"><i class="fas fa-angle-double-right"></i> Login</a></li>
										<li><a href="doctor-register.html"><i class="fas fa-angle-double-right"></i> Register</a></li>
										<li><a href="doctor-dashboard.html"><i class="fas fa-angle-double-right"></i> Doctor Dashboard</a></li>
									</ul>
								</div>
								<!-- /Footer Widget -->

							</div>  --}}

                        <div class="col-lg-4 col-md-6">

                            <!-- Footer Widget -->
                            <div class="footer-widget footer-contact">
                                <h2 class="footer-title">Contact Us</h2>
                                <div class="footer-contact-info">
                                    <div class="footer-address">
                                        <span><i class="fas fa-map-marker-alt"></i></span>
                                        <p> {{ $s->address }}</p>
                                    </div>
                                    <p>
                                        <i class="fas fa-phone-alt"></i>
                                        {{ $s->phone }}
                                    </p>
                                    <p class="mb-0">
                                        <i class="fas fa-envelope"></i>
                                        {{ $s->email }}
                                    </p>
                                </div>
                            </div>
                            <!-- /Footer Widget -->

                        </div>

                    </div>
                </div>
            </div>
            <!-- /Footer Top -->

            <!-- Footer Bottom -->
            <div class="footer-bottom">
                <div class="container-fluid">

                    <!-- Copyright -->
                    <div class="copyright">
                        <div class="row">
                            <div class="col-md-6 col-lg-6">
                                <div class="copyright-text">
                                    <p class="mb-0">All Reserved By Doctor khuji 2021 Developed BY <a
                                            href="http://linkingroupbd.com/" target="_blank">Linkin Group</a></p>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6">

                                <!-- Copyright Menu -->
                                <div class="copyright-menu">
                                    <ul class="policy-menu">
                                        <li><a href="{{ url('term-condition') }}">Terms and Conditions</a></li>
                                        <li><a href="#">Policy</a></li>
                                    </ul>
                                </div>
                                <!-- /Copyright Menu -->

                            </div>
                        </div>
                    </div>
                    <!-- /Copyright -->

                </div>
            </div>
            <!-- /Footer Bottom -->

        </footer>
        <!-- /Footer -->

    </div>
    <!-- /Main Wrapper -->
    @yield('modal')
    <!-- jQuery -->
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>

    <!-- Bootstrap Core JS -->
    <script src="{{ asset('assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/profile-settings.js') }}"></script>
    <!-- Sticky Sidebar JS -->
    <script src="{{ asset('assets/plugins/theia-sticky-sidebar/ResizeSensor.js') }}"></script>
    <script src="{{ asset('assets/plugins/theia-sticky-sidebar/theia-sticky-sidebar.js') }}"></script>

    <!-- Select2 JS -->
    <script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>

    <!-- Dropzone JS -->
    <script src="{{ asset('assets/plugins/dropzone/dropzone.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap-tagsinput/js/bootstrap-tagsinput.js') }}"></script>


    <!-- Circle Progress JS -->
    <script src="{{ asset('assets/js/circle-progress.min.js') }}"></script>

    <!-- Custom JS -->
    <script src="{{ asset('assets/js/script.js') }}"></script>
    @yield('js')
    @stack('scripts')
</body>

</html>
