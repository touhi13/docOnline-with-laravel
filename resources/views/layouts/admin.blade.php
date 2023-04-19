<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/admin/img/favicon.png') }}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('assets/admin/css/bootstrap.min.css') }}">
    <!-- select2.min.css -->
    <link rel="stylesheet" href="{{ asset('assets/admin/css/select2.min.css') }}">
    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="{{ asset('assets/admin/css/font-awesome.min.css') }}">
    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/all.min.css') }}">

    <!-- Feathericon CSS -->
    <link rel="stylesheet" href="{{ asset('assets/admin/css/feathericon.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/morris/morris.css') }}">

    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ asset('assets/admin/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/dropzone/dropzone.min.css') }}">
    {{--  data table   --}}
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.23/datatables.min.css" />
    {{--  sweetalert2  --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">
    {{--  extra css  --}}
    @stack('styles')

</head>

<body>
    <?php $s = App\Setting::where('status', 1)->first(); ?>
    <!-- Main Wrapper -->
    <div class="main-wrapper">

        <!-- Header -->
        <div class="header">

            <!-- Logo -->
            <div class="header-left">
                <a href="{{ url('admin/home') }}" class="logo">
                    <img src="{{ asset('files/uploads/' . $s->logo) }}" alt="Logo">
                </a>
                <a href="{{ url('admin/home') }}" class="logo logo-small">
                    <img src="{{ asset('assets/admin/img/logo-small.png') }}" alt="Logo" width="30"
                        height="30">
                </a>
            </div>
            <!-- /Logo -->

            <a href="javascript:void(0);" id="toggle_btn">
                <i class="fe fe-text-align-left"></i>
            </a>
            <!-- Mobile Menu Toggle -->
            <a class="mobile_btn" id="mobile_btn">
                <i class="fa fa-bars"></i>
            </a>
            <!-- /Mobile Menu Toggle -->

            <!-- Header Right Menu -->
            <ul class="nav user-menu">
                <!-- Notifications -->
                {{--  <li class="nav-item dropdown noti-dropdown">
						<a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
							<i class="fe fe-bell"></i> <span class="badge badge-pill">3</span>
						</a>
						<div class="dropdown-menu notifications">
							<div class="topnav-dropdown-header">
								<span class="notification-title">Notifications</span>
								<a href="javascript:void(0)" class="clear-noti"> Clear All </a>
							</div>
							<div class="noti-content">
								<ul class="notification-list">
									<li class="notification-message">
										<a href="#">
											<div class="media">
												<span class="avatar avatar-sm">
													<img class="avatar-img rounded-circle" alt="User Image" src="{{asset('assets/admin/img/doctors/doctor-thumb-01.jpg')}}">
												</span>
												<div class="media-body">
													<p class="noti-details"><span class="noti-title">Dr. Ruby Perrin</span> Schedule <span class="noti-title">her appointment</span></p>
													<p class="noti-time"><span class="notification-time">4 mins ago</span></p>
												</div>
											</div>
										</a>
									</li>
									<li class="notification-message">
										<a href="#">
											<div class="media">
												<span class="avatar avatar-sm">
													<img class="avatar-img rounded-circle" alt="User Image" src="{{asset('assets/admin/img/patients/patient1.jpg')}}">
												</span>
												<div class="media-body">
													<p class="noti-details"><span class="noti-title">Charlene Reed</span> has booked her appointment to <span class="noti-title">Dr. Ruby Perrin</span></p>
													<p class="noti-time"><span class="notification-time">6 mins ago</span></p>
												</div>
											</div>
										</a>
									</li>
									<li class="notification-message">
										<a href="#">
											<div class="media">
												<span class="avatar avatar-sm">
													<img class="avatar-img rounded-circle" alt="User Image" src="assets/img/patients/patient2.jpg">
												</span>
												<div class="media-body">
												<p class="noti-details"><span class="noti-title">Travis Trimble</span> sent a amount of $210 for his <span class="noti-title">appointment</span></p>
												<p class="noti-time"><span class="notification-time">8 mins ago</span></p>
												</div>
											</div>
										</a>
									</li>
									<li class="notification-message">
										<a href="#">
											<div class="media">
												<span class="avatar avatar-sm">
													<img class="avatar-img rounded-circle" alt="User Image" src="assets/img/patients/patient3.jpg">
												</span>
												<div class="media-body">
													<p class="noti-details"><span class="noti-title">Carl Kelly</span> send a message <span class="noti-title"> to his doctor</span></p>
													<p class="noti-time"><span class="notification-time">12 mins ago</span></p>
												</div>
											</div>
										</a>
									</li>
								</ul>
							</div>
							<div class="topnav-dropdown-footer">
								<a href="#">View all Notifications</a>
							</div>
						</div>
					</li>  --}}
                <!-- /Notifications -->

                <!-- User Menu -->
                <li class="nav-item dropdown has-arrow">
                    <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                        <span class="user-img"><img class="rounded-circle"
                                src="{{ asset('files/uploads/' . $s->logo) }}" width="31" alt=""></span>
                    </a>
                    <div class="dropdown-menu">
                        <div class="user-header">
                            <div class="avatar avatar-sm">
                                <img src="{{ asset('files/uploads/' . $s->logo) }}" alt="User Image"
                                    class="avatar-img rounded-circle">
                            </div>
                            <div class="user-text">
                                <h6>{{ Auth::user()->name }}</h6>
                                <p class="text-muted mb-0">{{ Auth::user()->email }}</p>
                            </div>
                        </div>
                        <a class="dropdown-item" href="#">My Profile</a>
                        <a class="dropdown-item" href="{{ url('settings') }}">Settings</a>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>

                    </div>
                </li>
                <!-- /User Menu -->

            </ul>
            <!-- /Header Right Menu -->

        </div>
        <!-- /Header -->

        <!-- Sidebar -->
        <div class="sidebar" id="sidebar">
            <div class="sidebar-inner slimscroll">
                <div id="sidebar-menu" class="sidebar-menu">
                    <ul>
                        <li class="menu-title">
                            <span>Main</span>
                        </li>
                        <li class="@active('admin')">
                            <a href="{{ url('admin') }}">
                                <i class="fas fa-home"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="@active('admin/speciality')">
                            <a href="{{ url('/admin/speciality') }}">
                                <i class="fas fa-user-tag"></i>
                                <span>Speciality</span>
                            </a>
                        </li>
                        <li class="@active('admin/doctor')">
                            <a href="{{ url('admin/doctor') }}"><i class="fas fa-user-md"></i><span>Doctors</span></a>
                        </li>
                        <li class="@active('admin/patient')">
                            <a href="{{ url('admin/patient') }}"><i
                                    class="fas fa-user-injured"></i><span>Patients</span></a>
                        </li>
                        <li class="@active('admin/review')">
                            <a href="{{ url('admin/review') }}"><i class="fe fe-star-o"></i> <span>Reviews</span></a>
                        </li>
                        <li class="@active('admin/transaction')">
                            <a href="{{ url('admin/transaction') }}">
                                <i class="fe fe-activity"></i>
                                <span>Transactions</span>
                            </a>
                        </li>
                        <li class="@active('admin/hospitals')">
                            <a href="{{ url('admin/hospitals') }}">
                                <i class="fa fa-building"></i>
                                <span>Hospital</span>
                            </a>
                        </li>
                        <li class="@active('admin/claim')">
                            <a href="{{ url('admin/claim') }}"><i
                                    class="fas fa-mail-bulk"></i><span>Claims</span></a>
                        </li>
                        <li class="@active('admin/settings')">
                            <a href="{{ url('admin/settings') }}"><i class="fa fa-cog"></i><span>Setting</span></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Sidebar -->

        <!-- Page Wrapper -->
        <div class="page-wrapper">
            @yield('content')

        </div>
        <!-- /Page Wrapper -->

    </div>
    <!-- /Main Wrapper -->

    <!-- jQuery -->
    <script src="{{ asset('assets/admin/js/jquery-3.2.1.min.js') }}"></script>
    <!-- select2.min.js JS -->
    <script src="{{ asset('assets/admin/js/select2.min.js') }}"></script>
    @yield('extrajs')
    <!-- Bootstrap Core JS -->
    <script src="{{ asset('assets/admin/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/profile-settings.js') }}"></script>
    <!-- Slimscroll JS -->
    <script src="{{ asset('assets/admin/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
    <!-- Sticky Sidebar JS -->
    <script src="{{ asset('assets/plugins/theia-sticky-sidebar/ResizeSensor.js') }}"></script>
    <script src="{{ asset('assets/plugins/theia-sticky-sidebar/theia-sticky-sidebar.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/raphael/raphael.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/morris/morris.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/chart.morris.js') }}"></script>
    <!-- Dropzone JS -->
    <script src="{{ asset('assets/plugins/dropzone/dropzone.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap-tagsinput/js/bootstrap-tagsinput.js') }}"></script>
    <!-- Custom JS -->
    <script src="{{ asset('assets/admin/js/script.js') }}"></script>

    <!-- Custom JS -->
    <script src="{{ asset('assets/js/script.js') }}"></script>
    {{--  data table   --}}
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.23/datatables.min.js"></script>
    {{--  sweetalert2  --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                "order": [
                    [3, "desc"]
                ]
            });
        });
    </script>



</body>


</html>
