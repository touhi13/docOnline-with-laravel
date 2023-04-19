@extends('layouts.doctor')
@section('title')
    {{ Auth::user()->name }} - Dashboard
@endsection
@section('contant')
    <div class="col-md-7 col-lg-8 col-xl-9">

        <div class="row">
            <div class="col-md-12">
                <div class="card dash-card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 col-lg-6">
                                <div class="dash-widget dct-border-rht">
                                    <div class="circle-bar circle-bar1">
                                        <div class="circle-graph1" data-percent="75">
                                            <img src="{{ asset('assets/img/icon-01.png') }}" class="img-fluid"
                                                alt="patient">
                                        </div>
                                    </div>
                                    <div class="dash-widget-info">
                                        <h6>Total Patient</h6>
                                        <h3>
                                            <?php $t = App\Contact::where('user_id', Auth::user()->id)->count(); ?>
                                            {{ $t }}
                                        </h3>
                                        <p class="text-muted">Till Today</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 col-lg-6">
                                <div class="dash-widget dct-border-rht">
                                    <div class="circle-bar circle-bar2">
                                        <div class="circle-graph2" data-percent="65">
                                            <img src="{{ asset('assets/img/icon-02.png') }}" class="img-fluid"
                                                alt="Patient">
                                        </div>
                                    </div>
                                    <div class="dash-widget-info">
                                        <h6>Today Patient</h6>
                                        <h3>
                                            <?php $td = App\Contact::where('user_id', Auth::user()->id)
                                                ->where('cr_date', date('Y-m-d'))
                                                ->count();
                                            ?>
                                            {{ $td }}
                                        </h3>

                                        <p class="text-muted">{{ date('Y-m-d') }}</p>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <h4 class="mb-4">Patient Appoinment</h4>
                <div class="appointment-tab">

                    <!-- Appointment Tab -->
                    <ul class="nav nav-tabs nav-tabs-solid nav-tabs-rounded">
                        <li class="nav-item">
                            <a class="nav-link active" href="#upcoming-appointments" data-toggle="tab">Upcoming</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#today-appointments" data-toggle="tab">Today</a>
                        </li>
                    </ul>
                    <!-- /Appointment Tab -->

                    <div class="tab-content">

                        <!-- Upcoming Appointment Tab -->
                        <div class="tab-pane show active" id="upcoming-appointments">
                            <div class="card card-table mb-0">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-center mb-0">
                                            <thead>
                                                <tr>
                                                    <th>Patient Name</th>
                                                    <th>Email</th>
                                                    <th>Phone</th>
                                                    <th>Appt Date</th>
                                                    <th>Details</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $pa = App\Contact::where('user_id', Auth::user()->id)
                                                    ->orderBy('id', 'DESC')
                                                    ->get();
                                                ?>
                                                @foreach ($pa as $v)
                                                    <tr>
                                                        <td>
                                                            <h2 class="table-avatar">
                                                                <a href="#" class="avatar avatar-sm mr-2"></a>
                                                                <a
                                                                    href="#">{{ $v->pname }}<span>#PT{{ $v->id }}</span></a>
                                                            </h2>
                                                        </td>
                                                        <td>{{ $v->pemail }}</td>
                                                        <td>{{ $v->pphone }}</td>
                                                        <td>{{ date($v->created_at) }}</td>
                                                        <td class="text-wrap">{{ $v->pdetails }}</td>

                                                    </tr>
                                                @endforeach


                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /Upcoming Appointment Tab -->

                        <!-- Today Appointment Tab -->
                        <div class="tab-pane" id="today-appointments">
                            <div class="card card-table mb-0">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-center mb-0">
                                            <thead>
                                                <tr>
                                                    <th>Patient Name</th>
                                                    <th>Email</th>
                                                    <th>Phone</th>
                                                    <th>Appt Date</th>
                                                    <th>Details</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $pa = App\Contact::where('user_id', Auth::user()->id)
                                                    ->where('cr_date', date('Y-m-d'))
                                                    ->orderBy('id', 'DESC')
                                                    ->get();
                                                ?>
                                                @forelse ($pa as $v)
                                                    <tr>
                                                        <td>
                                                            <h2 class="table-avatar">
                                                                <a href="#" class="avatar avatar-sm mr-2"></a>
                                                                <a
                                                                    href="#">{{ $v->pname }}<span>#PT{{ $v->id }}</span></a>
                                                            </h2>
                                                        </td>
                                                        <td>{{ $v->pemail }}</td>
                                                        <td>{{ $v->pphone }}</td>
                                                        <td>{{ date($v->created_at) }}</td>
                                                        <td class="word-justify">{{ $v->pdetails }}</td>

                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="5">No Data</td>
                                                    </tr>
                                                @endforelse

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /Today Appointment Tab -->

                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
