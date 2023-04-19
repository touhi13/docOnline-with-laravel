@extends('layouts.front')
@section('title')
    Doctorkhuji || Specialist Doctor
@endsection
@section('content')
    <!-- Breadcrumb -->
    <div class="breadcrumb-bar">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-8 col-12">
                    <nav aria-label="breadcrumb" class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Search</li>
                        </ol>
                    </nav>
                </div>
                {{--  <div class="col-md-4 col-12 d-md-block d-none">
                <div class="sort-by">
                    <span class="sort-title">Sort by</span>
                    <span class="sortby-fliter">
                        <select class="select">
                            <option>Select</option>
                            <option class="sorting">Rating</option>
                            <option class="sorting">Popular</option>
                            <option class="sorting">Latest</option>
                            <option class="sorting">Free</option>
                        </select>
                    </span>
                </div>
            </div>  --}}
            </div>
        </div>
    </div>
    <!-- /Breadcrumb -->

    <!-- Page Content -->
    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-12 col-lg-4 col-xl-3 theiaStickySidebar">
                    <!-- Search Filter -->
                    <form action="{{ url('search') }}" method="POST">
                        @csrf
                        @if (@isset($searchText))
                            <input type="hidden" name="searchText" value={{ $searchText }}>
                        @endif
                        @if (@isset($district))
                            <input type="hidden" name="district" value={{ $district }}>
                        @endif
                        <div class="card search-filter">
                            <div class="card-header">
                                <h4 class="card-title mb-0">Search Filter</h4>
                            </div>
                            <div class="card-body">
                                <div class="filter-widget">
                                </div>
                                <div class="filter-widget">
                                    <h4>Gender</h4>
                                    <div>
                                        <label class="custom_check">
                                            <input type="radio" name="gender" value="Male"
                                                @if (@isset($gender) && $gender === 'Male') checked @endif>
                                            <span class="checkmark"></span> Male Doctor
                                        </label>
                                    </div>
                                    <div>
                                        <label class="custom_check">
                                            <input type="radio" name="gender" value="Female"
                                                @if (@isset($gender) && $gender === 'Female') checked @endif>
                                            <span class="checkmark"></span> Female Doctor
                                        </label>
                                    </div>
                                </div>
                                <div class="filter-widget">
                                    <h4>Select Specialist</h4>
                                    <div class="scroll-sub">

                                        @foreach ($specialities as $speciality)
                                            <div>
                                                <label class="custom_check ">
                                                    <input type="radio" name="specialist" value="{{ $speciality->id }}"
                                                        @if (isset($specId) && $specId == $speciality->id) checked @endif>
                                                    <span class="checkmark"></span> {{ $speciality->profession_name }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="btn-search">
                                    <button type="submit" class="btn btn-block">Search</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- /Search Filter -->
                </div>
                <div class="col-md-12 col-lg-8 col-xl-9">
                    <!-- Doctor Widget -->
                    @forelse ($doctors as $doctor)
                        <div class="card">
                            <div class="card-body">
                                <div class="doctor-widget">
                                    <div class="doc-info-left">
                                        <div class="doctor-img">
                                            @if ($doctor->profile_photo)
                                                <a href="{{ url('doctor-profile/' . $doctor->generateSlug()) }}">
                                                    <img src={{ asset('images/doctors/' . $doctor->profile_photo) }}
                                                        class="img-fluid" alt="{{ $doctor->name }}">
                                                </a>
                                            @else
                                                <a href="{{ url('doctor-profile/' . $doctor->generateSlug()) }}">
                                                    <img src={{ asset('assets/img/profile.png') }} class="img-fluid"
                                                        alt="{{ $doctor->name }}">
                                                </a>
                                            @endif
                                        </div>
                                        <div class="doc-info-cont">
                                            <h4 class="doc-name"><a
                                                    href={{ url('doctor-profile/' . $doctor->generateSlug()) }}>{{ $doctor->name }}</a>
                                            </h4>
                                            <p class="doc-speciality">
                                                {{ implode(', ', $doctor->qualifications->pluck('title')->toArray()) }}
                                            </p>

                                            <h5 class="doc-department"><span class="mr-2"><i
                                                        class="fas fa-user-md"></i></span>
                                                {{ implode(', ', $doctor->specialities->pluck('profession_name')->toArray()) }}
                                            </h5>

                                            <div class="rating">
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star"></i>
                                                <span class="d-inline-block average-rating">(17)</span>
                                            </div>
                                            <div class="clinic-details">
                                                <p class="doc-location"><i class="fas fa-hospital"></i>
                                                    {{ implode(
                                                        ', ',
                                                        $doctor->newExperiences->filter(function ($exp) {
                                                                return $exp->is_current === 1;
                                                            })->pluck('organization_name')->toArray(),
                                                    ) }}
                                                </p>


                                            </div>
                                            <div class="clinic-services">
                                                @foreach ($doctor->specialities as $speciality)
                                                    @php
                                                        $segments = explode(',', $speciality->typical_name);
                                                    @endphp
                                                    @foreach ($segments as $segment)
                                                        <span>{{ trim($segment) }}</span>
                                                    @endforeach
                                                @endforeach
                                            </div>

                                        </div>
                                    </div>
                                    <div class="doc-info-right">
                                        <div class="clini-infos">
                                            <ul>
                                                {{--  <li><i class="far fa-thumbs-up"></i> 98%</li>  --}}
                                                {{--  <li><i class="far fa-comment"></i> 17 Feedback</li>  --}}
                                                <li><i class="fas fa-map-marker-alt"></i>{{ $doctor->district->district }}
                                                </li>
                                                {{--  <li><i class="far fa-money-bill-alt"></i> $300 - $1000 <i
                                                        class="fas fa-info-circle" data-bs-toggle="tooltip" title=""
                                                        data-bs-original-title="Lorem Ipsum" aria-label="Lorem Ipsum"></i>
                                                </li>  --}}
                                            </ul>
                                        </div>
                                        <div class="clinic-booking">
                                            <a class="view-pro-btn"
                                                href="{{ url('doctor-profile/' . $doctor->generateSlug()) }}">View
                                                Profile
                                            </a>
                                            @if ($doctor->is_doctor !== 0)
                                                <a class="apt-btn"
                                                    href={{ url('/booking/?doctor_id=' . encrypt($doctor->id)) }}>Book
                                                    Appointment
                                                </a>
                                            @else
                                                <a class="apt-btn"
                                                    href={{ url('/booking/?doctor_id=' . encrypt($doctor->id)) }}>Claim
                                                    Profile
                                                </a>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <h1>Data No found</h1>
                    @endforelse

                    <!-- /Doctor Widget -->

                    <div class="load-more text-center">
                        @if (@isset($district) && @isset($searchText) && @isset($gender) && @isset($specId))
                            {{ $doctors->appends(['district' => $district, 'searchText' => $searchText, 'gender' => $gender, 'specialist' => $specId])->links('pagination::bootstrap-4') }}
                        @else
                            {{ $doctors->links('pagination::bootstrap-4') }}
                        @endif

                    </div>
                </div>
            </div>

        </div>

    </div>
    <!-- /Page Content -->
@endsection
