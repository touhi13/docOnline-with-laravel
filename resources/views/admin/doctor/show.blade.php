@extends('layouts.admin')
@section('title')
    Doctorkhuji || Doctor List
@endsection
@push('styles')
    <link href="{{ asset('assets/admin/css/profile.css') }}" rel="stylesheet">
@endpush
@section('content')
    <div class="content container-fluid">
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }} </strong>
            </div>
        @endif
        <div class="container emp-profile">
            <form method="post">
                <div class="row">
                    <div class="col-md-4">
                        <div class="profile-img">
                            @if ($doctor->profile_photo)
                                <img src="{{ asset('images/doctors/' . $doctor->profile_photo) }}" alt="" />
                            @else
                                <img src="{{ asset('assets/img/profile.png') }}" alt="" />
                            @endif
                            <div class="file btn btn-lg btn-primary">
                                Change Photo
                                <input type="file" name="file" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="profile-head">
                            <h5>
                                {{ $doctor->name }}
                            </h5>
                            <h6 class="mb-0">
                                @php
                                    $i = 1;
                                    $total = count($doctor->degrees);
                                    foreach ($doctor->degrees as $degree) {
                                        echo $degree->title;
                                        if ($i < $total) {
                                            echo ', ';
                                        }
                                        $i++;
                                    }
                                @endphp
                            </h6>
                            {{--  <p class="mb-0">
                                @php
                                    $i = 1;
                                    $total = count($doctor->additionalQualifications);
                                    foreach ($doctor->additionalQualifications as $qualification) {
                                        echo $qualification->title;
                                        if ($i < $total) {
                                            echo ', ';
                                        }
                                        $i++;
                                    }
                                @endphp
                            </p>
                            <p class="proile-rating mt-0">
                                @php
                                    $i = 1;
                                    $total = count($doctor->specialities);
                                    foreach ($doctor->specialities as $spec) {
                                        echo $spec->profession_name;
                                        if ($i < $total) {
                                            echo ', ';
                                        }
                                        $i++;
                                    }
                                @endphp  --}}
                            </p>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <input type="submit" class="profile-edit-btn" name="btnAddMore" value="Edit Profile" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-2">
                            <h6 class="">Additional Qualifications</h6>
                            <ul class="mb-0 bullets">
                                @foreach ($doctor->additionalQualifications as $qualification)
                                    <li>{{ $qualification->title }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <div>
                            <h6 class="">Specilities</h6>
                            <ul class="mb-0 bullets">
                                @foreach ($doctor->specialities as $spec)
                                    <li>{{ $spec->profession_name }}</li>
                                @endforeach
                            </ul>
                        </div>

                    </div>
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-12">
                                <h5>Working Experience</h4>
                            </div>
                            @foreach ($doctor->newExperiences as $exp)
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p class="font-weight-bold">{{ $exp->organization_name }}</h6>
                                        </div>
                                        <div class="col-md-3">
                                            <p class="font-weight-light mb-0">Designation</p>
                                        </div>
                                        <div class="col-md-3 mb-0">
                                            <p class="font-weight-light">Department</p>

                                        </div>
                                        <div class="col-md-3 mb-0">
                                            <p class="font-weight-light">Employment Period</p>

                                        </div>
                                        <div class="col-md-3 mb-0">
                                            <p class="font-weight-light">Period</p>

                                        </div>
                                        <div class="col-md-3">
                                            <p class="font-weight-normal"> {{ $exp->designation }}</p>

                                        </div>
                                        <div class="col-md-3">
                                            <p class="font-weight-normal"> {{ $exp->department }}</p>

                                        </div>
                                        <div class="col-md-3">
                                            <p class="font-weight-normal"> {{ $exp->from }} - {{ $exp->to }}</p>

                                        </div>
                                        <div class="col-md-3">
                                            <p class="font-weight-normal"> {{ $exp->duration_month }}</p>

                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('extrajs')
@endsection
