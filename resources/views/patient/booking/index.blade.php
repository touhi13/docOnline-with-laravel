@extends('layouts.front')
@section('title')
    Doctorkhuji || Specialist Doctor
@endsection
@section('content')
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="booking-doc-info">
                                @if ($schedules->doctor->profile_photo)
                                    <a href="{{ url('doctor-profile/' . $schedules->doctor->id) }}" class="booking-doc-img">
                                        <img src={{ asset('images/doctors/' . $schedules->doctor->profile_photo) }}
                                            alt={{ $schedules->doctor->name }}>
                                    </a>
                                @else
                                    <a href="{{ url('doctor-profile/' . $schedules->doctor->id) }}" class="booking-doc-img">
                                        <img src={{ asset('assets/img/profile.png') }} alt={{ $schedules->doctor->name }}>
                                    </a>
                                @endif
                                <div class="booking-info">
                                    <h4><a href="doctor-profile.html">{{ $schedules->doctor->name }}</a></h4>
                                    <div class="rating">
                                        <i class="fas fa-star filled"></i>
                                        <i class="fas fa-star filled"></i>
                                        <i class="fas fa-star filled"></i>
                                        <i class="fas fa-star filled"></i>
                                        <i class="fas fa-star"></i>
                                        <span class="d-inline-block average-rating">35</span>
                                    </div>
                                    <p class="text-muted mb-0"><i class="fas fa-map-marker-alt"></i> Newyork, USA</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Schedule Widget -->
                    <div class="card booking-schedule schedule-widget">
                        <!-- Schedule Header -->
                        <div class="schedule-header">
                            <div class="row">
                                <div class="col-md-12">
                                    <!-- Day Slot -->
                                    <div class="day-slot">
                                        <ul>
                                            </li>
                                            @foreach ($dates as $date)
                                                <li>
                                                    <span>{{ $date['weekday'] }}</span>
                                                    <span class="slot-date">{{ $date['day_month'] }}
                                                        <small class="slot-year">{{ $date['year'] }}</small>
                                                    </span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <!-- /Day Slot -->
                                </div>
                            </div>
                        </div>
                        <!-- /Schedule Header -->
                        <!-- Schedule Content -->
                        <div class="schedule-cont">
                            <div class="row">
                                <div class="col-md-12">
                                    <!-- Time Slot -->
                                    <div class="time-slot">
                                        <ul class="clearfix">

                                            @foreach ($timeSlots as $key => $timeSlot)
                                                <li>
                                                    @if (!empty($timeSlot))
                                                        @foreach ($timeSlot as $slot)
                                                            @if (is_array($slot))
                                                                <a class="timing" href="#"
                                                                    data-doctor={{ encrypt($schedules->doctor->id) }}
                                                                    data-day={{ $key }}
                                                                    data-start={{ $slot['start_time'] }}
                                                                    data-end={{ $slot['end_time'] }}>
                                                                    <span>
                                                                        {{ date('h:i a', strtotime($slot['start_time'])) }}
                                                                    </span>
                                                                    <span>
                                                                        -
                                                                    </span>
                                                                    <span>
                                                                        {{ date('h:i a', strtotime($slot['end_time'])) }}
                                                                    </span>
                                                                </a>
                                                            @endif
                                                        @endforeach
                                                    @else
                                                        &nbsp;
                                                    @endif
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <!-- /Time Slot -->
                                </div>
                            </div>
                        </div>
                        <!-- /Schedule Content -->
                    </div>
                    <!-- /Schedule Widget -->
                    <!-- Submit Section -->
                    <div class="submit-section proceed-btn text-right">
                        <a href="#" class="btn btn-primary submit-btn checkout">Proceed to Pay</a>
                    </div>
                    <!-- /Submit Section -->
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        $(document).ready(function() {
            $('.timing').on('click', function() {
                $('.timing').removeClass('selected'); // Remove "selected" class from all list items
                $(this).addClass('selected'); // Add "selected" class to the clicked list item
            });
            $('.checkout').on('click', function(e) {
                e.preventDefault();
                const selected = $('.selected')
                if (selected.length) {
                    const params = {
                        "doctorId": selected.attr('data-doctor'),
                        "day": selected.attr('data-day'),
                        "startTime": selected.attr('data-start'),
                        "endTime": selected.attr('data-end')
                    }
                    const urlParams = new URLSearchParams(params);
                    const checkOutUrl = `{{ url('checkout') }}?${urlParams.toString()}`;
                    console.log(checkOutUrl);
                    window.location.href = checkOutUrl;
                }
            });
        })
    </script>
@endpush
