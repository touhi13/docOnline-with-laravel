@extends('layouts.doctor')
@section('title')
    Doctorkhuji || Doctor Profile
@endsection
@section('content')
    <div class="col-md-7 col-lg-8 col-xl-9">
        <div class="appointments">
            @foreach ($appointments as $appointment)
                <div class="appointment-list">
                    <div class="profile-info-widget">
                        <a href="patient-profile.html" class="booking-doc-img">
                            @if ($appointment->patient->photo)
                                <img src={{ asset('images/patients/' . $appointment->patient->photo) }}
                                    alt={{ $appointment->patient->name }}>
                            @else
                                <img src={{ asset('assets/img/profile.png') }} alt={{ $appointment->patient->name }}>
                            @endif
                        </a>
                        <div class="profile-det-info">
                            <h3><a href="patient-profile.html">{{ $appointment->patient->name }}</a></h3>
                            <div class="patient-details">
                                <h5>
                                    <i class="far fa-clock"></i>
                                    {{ $appointmentService->getNextWeekdayDate($appointment->created_at, $appointment->day)}}
                                </h5>
                                <h5><i class="fas fa-map-marker-alt"></i>{{ $appointment->patient->present_address }}</h5>
                                <h5><i class="fas fa-envelope"></i> {{ $appointment->patient->email }}</h5>
                                <h5 class="mb-0"><i class="fas fa-phone"></i>{{ $appointment->patient->phone }}</h5>
                            </div>
                        </div>
                    </div>
                    <div class="appointment-action">
                        <a href="#" class="btn btn-sm bg-info-light" data-toggle="modal" data-target="#appt_details">
                            <i class="far fa-eye"></i> View
                        </a>
                        <a href="javascript:void(0);" class="btn btn-sm bg-success-light">
                            <i class="fas fa-check"></i> Accept
                        </a>
                        <a href="javascript:void(0);" class="btn btn-sm bg-danger-light">
                            <i class="fas fa-times"></i> Cancel
                        </a>
                    </div>
                </div>
            @endforeach
            <!-- Appointment List -->

        </div>
        {{ $appointments->links() }}
    </div>
@endsection
