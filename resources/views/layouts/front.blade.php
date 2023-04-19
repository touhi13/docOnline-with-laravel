<!DOCTYPE html>
<html lang="en">

<!-- doccure/  30 Nov 2019 04:11:34 GMT -->

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title> @yield('title')</title>
    <?php $s = App\Setting::where('status', 1)->first(); ?>
    <!-- Favicons -->
    <link type="image/x-icon" href="{{ asset('files/uploads/' . $s->logo) }}" rel="icon">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">

    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/all.min.css') }}">

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
                    <a href="{{ url('/') }}" class="navbar-brand logo">
                        <img src="{{ asset('files/uploads/' . $s->logo) }}" class="" height="60"
                            alt="Logo">
                    </a>
                </div>
                <div class="main-menu-wrapper">
                    <div class="menu-header">
                        <a href="{{ url('/') }}" class="menu-logo">
                            <img src="{{ asset('files/uploads/' . $s->logo) }}" class="" height="60"
                                alt="Logo">
                        </a>
                        <a id="menu_close" class="menu-close" href="javascript:void(0);">
                            <i class="fas fa-times"></i>
                        </a>
                    </div>
                    <ul class="main-nav">
                        <li class="active">
                            <a href="{{ url('/') }}">Home</a>
                        </li>
                        <li class="active">
                            <a href="{{ url('/ask-a-doctor') }}">Ask a doctor</a>
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
                            <p class="contact-info-header"> +1 315 369 5943</p>
                        </div>
                    </li>
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item active">
                            <a class="btn btn-sm btn-success " href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class=" btn btn-sm btn-dark " href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="{{ url('/') }}"
                                role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
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
                    @endguest
                </ul>
            </nav>
        </header>
        <!-- /Header -->
        @yield('content')
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
                                    <img src="{{ asset('files/uploads/' . $s->logo) }}" height="100" width="150"
                                        alt="logo">
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
                                    <li><a href="{{ url('login') }}"><i class="fas fa-angle-double-right"></i>
                                            Login</a></li>
                                    <li><a href="{{ url('register') }}"><i
                                                class="fas fa-angle-double-right"></i>Doctor Register</a></li>
                                    <li><a href="#"><i class="fas fa-angle-double-right"></i> Page</a></li>

                                </ul>
                            </div>
                            <!-- /Footer Widget -->

                        </div>

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

    <!-- jQuery -->

    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/typeahead.bundle.js') }}"></script>

    <script>
        var path = "{{ url('autocomplete') }}";
        $('input.typeahead').typeahead({
            source: function(query, process) {
                return $.get(path, {
                    query: query
                }, function(data) {
                    return process(data);
                });
            },
            highlighter: function(item, data) {
                var parts = item.split('#'),
                    html = '<div class="row">';
                html += '<div class="col-md-10 pl-0">';
                html += '<span>' + data.fn + '</span>';
                html += '<p class="m-0">' + data.ln + '</p>';
                html += '</div>';
                html += '</div>';
                return html;
            }
        });
    </script>

    <!-- Bootstrap Core JS -->
    <script src="{{ asset('assets/js/popper.min.js') }}"></script>

    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>

    <!-- Slick JS -->
    <script src="{{ asset('assets/js/slick.js') }}"></script>

    <!-- Custom JS -->
    <script src="{{ asset('assets/js/script.js') }}"></script>

    @stack('script')
</body>

</html>
