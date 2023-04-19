<!DOCTYPE html>
<html lang="en">

<!-- doccure/  30 Nov 2019 04:11:34 GMT -->

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>
        Doctorkhuji || Make an Contact</title>
    <?php $s = App\Setting::where('status', 1)->first(); ?>
    <!-- Favicons -->
    <link type="image/x-icon" href="{{ asset('files/uploads/' . $s->logo) }}" rel="icon">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <!-- select2.min.css -->
    <link rel="stylesheet" href="{{ asset('assets/admin/css/select2.min.css') }}">
    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/all.min.css') }}">

    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    <style>
        .bb {
            width: 300px;
            max-width: 1120px;
            height: 400px;
            overflow: auto;
            overflow-x: hidden;
        }
    </style>

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
                        <li class="">
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
                            <p class="contact-info-header">{{ $s->phone }}</p>
                        </div>
                    </li>
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="btn btn-sm btn-success" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="btn btn-sm btn-dark"
                                    href="{{ route('register') }}">{{ __('Doctor Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
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

        <!-- Home Banner -->
        <section class="section section-search">
            <div class="container-fluid">
                <div class="banner-wrapper">
                    <div class="banner-header text-center">
                        <h1>Doctor khuji</h1>
                        <h3>
                            Search Doctor , Make an Contact</h3>
                        <p>Discover the best doctors, hospital the city nearest to you.</p>
                    </div>

                    <!-- Search -->
                    <div class="search-box">
                        <form action="{{ url('search') }}" method="POST">
                            @csrf
                            <div class="form-group search-location">
                                <select class="form-control typeahead js-example-basic-single" name="district">
                                    <option value="">Choose Location</option>
                                    @foreach ($districts as $key => $value)
                                        <option value={{ $key }}>{{ $value }}</option>
                                    @endforeach

                                </select>

                                <span class="form-text">Based on your Location</span>
                            </div>
                            <div class="form-group search-info">
                                <input type="text" name="searchText" class="form-control"
                                    placeholder="Search Doctors, Hospitals, Diseases Etc">
                                <span class="form-text">Ex : Dental or Sugar Check up etc</span>
                            </div>
                            <button type="submit" class="btn btn-primary search-btn"><i class="fas fa-search"></i>
                                <span>Search</span></button>
                        </form>
                    </div>
                    <!-- /Search -->

                </div>
            </div>
        </section>
        <!-- /Home Banner -->

        <!-- Popular Section -->
        <section class="section section-doctor">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="section-header ">
                            <h2>Book Our Doctor</h2>
                            <p>Lorem Ipsum is simply dummy text </p>
                        </div>
                        <div class="about-content">
                            <p>It is a long established fact that a reader will be distracted by the readable content of
                                a page when looking at its layout. The point of using Lorem Ipsum.</p>
                            <p>web page editors now Lorem Ipsum as their default model text, and a search for 'lorem
                                ipsum' will uncover many web sites still in their infancy. Various versions have evolved
                                over the years, sometimes</p>
                            <a href="javascript:;">Read More..</a>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="doctor-slider slider">
                            @foreach ($doctors as $doctor)
                                <!-- Doctor Widget -->
                                <div class="profile-widget">
                                    <div class="doc-img">
                                        <a href="doctor-profile.html">
                                            @if ($doctor->profile_photo)
                                                <img class="img-fluid" alt={{ $doctor->name }}
                                                    src={{ asset('images/doctors/' . $doctor->profile_photo) }}>
                                            @else
                                                <img class="img-fluid" src={{ asset('assets/img/profile.png') }}
                                                    alt={{ $doctor->profile_photo }}>
                                            @endif

                                        </a>
                                        <a href="javascript:void(0)" class="fav-btn">
                                            <i class="far fa-bookmark"></i>
                                        </a>
                                    </div>
                                    <div class="pro-content">
                                        <h3 class="title">
                                            <a href={{ url('doctor-profile/' . $doctor->id) }}>
                                                {{ call_user_func($limitString, $doctor->name, 18) }}
                                            </a>
                                            <i class="fas fa-check-circle verified"></i>
                                        </h3>
                                        <p class="speciality">
                                            @foreach ($doctor->specialities as $index => $speciality)
                                                {{ $speciality->profession_name }}
                                                @if ($index != count($doctor->specialities) - 1)
                                                    ,
                                                @endif
                                            @endforeach
                                        </p>
                                        <div class="rating">
                                            <i class="fas fa-star filled"></i>
                                            <i class="fas fa-star filled"></i>
                                            <i class="fas fa-star filled"></i>
                                            <i class="fas fa-star filled"></i>
                                            <i class="fas fa-star filled"></i>
                                            <span class="d-inline-block average-rating">(17)</span>
                                        </div>
                                        <ul class="available-info">
                                            <li>
                                                <i class="fas fa-map-marker-alt"></i>{{ $doctor->district->district }}
                                            </li>
                                        </ul>
                                        <div class="row row-sm">
                                            <div class="col-6">
                                                <a href="{{ url('doctor-profile/' . $doctor->generateSlug()) }}"
                                                    class="btn view-btn">
                                                     View Profile
                                                </a>
                                            </div>
                                            <div class="col-6">
                                                @if ($doctor->is_doctor !== 0)
                                                    <a href={{ url('booking/?doctor_id=' . encrypt($doctor->id)) }}
                                                        class="btn book-btn">Book Now
                                                    </a>
                                                @else
                                                    <a href={{ url('claim-profile/' . $doctor->id) }}
                                                        class="btn book-btn">Claim Profile</a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /Doctor Widget -->
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /Popular Section -->

        <!-- Availabe Features -->
        <section class="section section-features">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-5 features-img">
                        <img src="assets/img/features/feature.png" class="img-fluid" alt="Feature">
                    </div>
                    <div class="col-md-7">
                        <div class="section-header">
                            <h2 class="mt-2">Availabe Features in Our Hospital</h2>
                            <p>It is a long established fact that a reader will be distracted by the readable content of
                                a page when looking at its layout. </p>
                        </div>
                        <div class="features-slider slider">
                            <!-- Slider Item -->
                            <?php $hospital = App\Hospital::orderBy('id', 'DESC')->get(); ?>
                            @foreach ($hospital as $hos)
                                <div class="feature-item text-center">
                                    <img src="{{ asset('files/uploads/' . $hos->logo) }}" class="img-fluid"
                                        alt="Feature">

                                </div>
                            @endforeach

                            <!-- /Slider Item -->

                            <!-- Slider Item -->
                            <div class="feature-item text-center">
                                <img src="assets/img/features/feature-02.jpg" class="img-fluid" alt="Feature">

                            </div>
                            <!-- /Slider Item -->

                            <!-- Slider Item -->
                            <div class="feature-item text-center">
                                <img src="assets/img/features/feature-03.jpg" class="img-fluid" alt="Feature">

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Availabe Features -->

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
    <script src="{{ asset('assets/admin/js/select2.min.js') }}"></script>
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
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    </script>

    <!-- Bootstrap Core JS -->
    <script src="{{ asset('assets/js/popper.min.js') }}"></script>

    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>

    <!-- Slick JS -->
    <script src="{{ asset('assets/js/slick.js') }}"></script>

    <!-- Custom JS -->
    <script src="{{ asset('assets/js/script.js') }}"></script>

</body>


</html>
