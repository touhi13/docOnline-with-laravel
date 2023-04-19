@extends('layouts.doctor')
@section('title')
    Doctorkhuji || Doctor Profile
@endsection
@section('content')
    <div class="col-md-7 col-lg-8 col-xl-9">

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Schedule Timings</h4>
                        <div class="profile-box" data-select2-id="8">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card schedule-widget mb-0">

                                        <!-- Schedule Header -->
                                        <div class="schedule-header">
                                            <!-- Schedule Nav -->
                                            <div class="schedule-nav">
                                                <ul class="nav nav-tabs nav-justified">
                                                    @foreach (config('app.weekdays') as $key => $value)
                                                        <li class="nav-item">
                                                            <a class="nav-link {{ $value === date('l') ? 'active' : '' }}"
                                                                data-toggle="tab"
                                                                href="#slot_{{ $key }}">{{ $value }}</a>
                                                        </li>
                                                    @endforeach

                                                </ul>
                                            </div>
                                            <!-- /Schedule Nav -->

                                        </div>
                                        <!-- /Schedule Header -->

                                        <!-- Schedule Content -->
                                        <div class="tab-content schedule-cont">
                                            {{--  @php
                                                property_exists($timeSlots, 'Monday');
                                            @endphp  --}}
                                            @foreach (config('app.weekdays') as $key => $value)
                                                <div id="slot_{{ $key }}"
                                                    class="tab-pane fade {{ $value === date('l') ? 'active show' : '' }}">
                                                    <h4 class="card-title d-flex justify-content-between">
                                                        <span>Time Slots</span>
                                                        <a class="edit-link" data-toggle="modal" href="#add_time_slot"><i
                                                                class="fa fa-plus-circle"></i> Update Slot</a>

                                                    </h4>

                                                    @if ($timeSlots !== null && property_exists($timeSlots, $value))
                                                        <div class="doc-times"
                                                            data-slots={{ json_encode($timeSlots->$value) }}
                                                            data-day={{ $value }}>
                                                            @foreach ($timeSlots->$value as $key => $value)
                                                                <div class="doc-slot-list">
                                                                    {{ date('h:i a', strtotime($value->start_time)) }} -
                                                                    {{ date('h:i a', strtotime($value->end_time)) }}
                                                                    <a href="javascript:void(0)" class="delete_schedule">
                                                                        <i class="fa fa-times"></i>
                                                                    </a>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    @else
                                                        <p class="text-muted mb-0 doc-times" data-day={{ $value }}>
                                                            Not Available</p>
                                                    @endif

                                                </div>
                                            @endforeach
                                        </div>
                                        <!-- /Schedule Content -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('modal')
    <!-- Add Time Slot Modal -->
    <div class="modal fade custom-modal" id="add_time_slot">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Time Slots</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action={{ route('schedule.store') }}>
                        @csrf
                        <div class="hours-info">
                            <div class="row form-row hours-cont">
                                <div class="col-12 col-md-10">
                                    <div class="row form-row">
                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label>Start Time</label>
                                                <input type="time" name="" id="" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label>End Time</label>
                                                <input type="time" name="" id="" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="add-more mb-3">
                            <a href="javascript:void(0);" class="add-hours"><i class="fa fa-plus-circle"></i> Add More</a>
                        </div>
                        <div class="submit-section text-center">
                            <button type="submit" class="btn btn-primary submit-btn">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /Add Time Slot Modal -->
@endsection
@section('js')
    <script>
        $(document).ready(function() {

            // Add More Hours
            $(".hours-info").on('click', '.trash', function() {
                $(this).closest('.hours-cont').remove();
                return false;
            });
            const hourscontent = (start_time = "", end_time = "") => {
                return '<div class="row form-row hours-cont">' +
                    '<div class="col-12 col-md-10">' +
                    '<div class="row form-row">' +
                    '<div class="col-12 col-md-6">' +
                    '<div class="form-group">' +
                    '<label>Start Time</label>' +
                    '<input type="time" name="start_time[]" id="" value="' + start_time +
                    '" class="form-control">' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-12 col-md-6">' +
                    '<div class="form-group">' +
                    '<label>End Time</label>' +
                    '<input type="time" name="end_time[]" id="" value="' + end_time +
                    '" class="form-control">' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-12 col-md-2">' +
                    '<label class="d-md-block d-sm-none d-none">&nbsp;</label>' +
                    '<a href="#" class="btn btn-danger trash">' +
                    '<i class="far fa-trash-alt"></i>' +
                    '</a>' +
                    '</div>' +
                    '</div>';
            }



            $(".add-hours").on('click', function() {
                $(".hours-info").append(hourscontent());
                return false;
            });

            $(".edit-link").on("click", function() {
                $(".hours-info").empty();
                $('input[name="schedule_day"]').remove();
                const targetEl = $(this).parent('').siblings('.doc-times');
                const timeSlots = targetEl.attr('data-slots');
                if (typeof timeSlots !== 'undefined') {
                    const parsedTimeSlots = JSON.parse(timeSlots);
                    console.log(parsedTimeSlots);
                    parsedTimeSlots.forEach(function(obj) {
                        console.log(`start_time: ${obj.start_time}, end_time: ${obj.end_time}`);
                        $(".hours-info").append(hourscontent(obj.start_time, obj.end_time));
                    });
                } else {
                    $(".hours-info").append(hourscontent());
                }
                $('<input type="hidden" name="schedule_day" value="' + targetEl.attr('data-day') + '">')
                    .insertBefore(".hours-info");

            });

        });
    </script>
@endsection
