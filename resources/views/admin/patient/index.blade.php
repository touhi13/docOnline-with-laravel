@extends('layouts.admin')
@section('title')
    Doctorkhuji || Patient List
@endsection
@section('content')
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="page-title">List of Patient</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="javascript:(0);">Users</a></li>
                        <li class="breadcrumb-item active">Patient</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <div class="table-responsive">
                                <table class="datatable table table-hover table-center mb-0">
                                    <thead>
                                        <tr>
                                            <th>Patient ID</th>
                                            <th>Patient Name</th>
                                            <th>Age</th>
                                            <th>Address</th>
                                            <th>Phone</th>
                                            <th>Last Visit</th>
                                            <th class="text-right">Paid</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($patients as $patient)
                                            <tr>
                                                <td>#PT{{ $patient->id }}</td>
                                                <td>
                                                    <h2 class="table-avatar">
                                                        <a href="profile.html" class="avatar avatar-sm mr-2">
                                                            @if ($patient->photo)
                                                                <img class="avatar-img rounded-circle"
                                                                    src="{{ asset('images/patients/' . $patient->photo) }}"
                                                                    alt="{{ $patient->name }}">
                                                            @else
                                                                <img class="avatar-img rounded-circle"
                                                                    src="{{ asset('assets/img/profile.png') }}"
                                                                    alt="{{ $patient->name }}">
                                                            @endif

                                                        </a>
                                                        <a href="profile.html">{{ $patient->name }}</a>
                                                    </h2>
                                                </td>
                                                <td>
                                                    @php
                                                        $dateOfBirth = $patient->date_of_birth;
                                                        $age = '';
                                                        if ($dateOfBirth) {
                                                            $parsedDate = \Carbon\Carbon::createFromFormat('d/m/Y', $dateOfBirth);
                                                            if ($parsedDate && $parsedDate->format('d/m/Y') === $dateOfBirth) {
                                                                $birthday = \Carbon\Carbon::parse($dateOfBirth);
                                                                $now = \Carbon\Carbon::now();
                                                                $age = $birthday->diffInYears($now);
                                                            } else {
                                                                $age = "Invalid date format: $dateOfBirth";
                                                            }
                                                        }
                                                    @endphp
                                                    {{ $age }}
                                                </td>
                                                <td>{{ $patient->present_address }}</td>
                                                <td>{{ $patient->phone }}</td>
                                                <td>20 Oct 2019</td>
                                                <td class="text-right">$100.00</td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
