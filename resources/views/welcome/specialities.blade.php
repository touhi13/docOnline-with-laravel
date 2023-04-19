@extends('layouts.front')
@section('title')
    Doctorkhuji || Specialist Doctor
@endsection
@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
    @endif
    <!-- Breadcrumb -->
    <div class="breadcrumb-bar">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-12 col-12">
                    <nav aria-label="breadcrumb" class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index-2.html">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Ask a doctor</li>
                        </ol>
                    </nav>
                    <h2 class="breadcrumb-title">Ask a doctor</h2>
                </div>
            </div>
        </div>
    </div>
    <!-- /Breadcrumb -->

    <!-- Page Content -->
    <div class="content">
        <div class="container">
            <!-- Cards -->
            <section class="comp-section comp-cards">
                <div class="section-header">
                    <h3 class="section-title">Please select a speciality</h3>
                    <div class="line"></div>
                </div>
                <div class="row">
                    @foreach ($specialities as $speciality)
                        <a href={{ url('speciality/' . encrypt($speciality->id)) }} class="col-12 col-md-6 col-lg-6 d-flex">
                            <div class="card flex-fill">
                                <div class="card-body">
                                    <div class="row no-gutters">
                                        <div class="col-12 col-sm-6 col-md-3">
                                            <img class="avatar-img"
                                                src={{ asset('assets/admin/img/specialities/specialities-01.png') }}
                                                alt={{ $speciality->typical_name }}>
                                        </div>
                                        <div class="col-6 col-md-9">
                                            <h5 class="card-title h4 mb-2">
                                                {{ $speciality->typical_name . '/' . $speciality->name }}
                                            </h5>
                                            <p class="card-text">Some quick example text to build on the card title and make
                                                up
                                                the
                                                bulk
                                                of the
                                                cards content.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </section>
            <!-- /Cards -->
        </div>
    </div>
@endsection
