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
                    <h3 class="page-title">Reviews</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active">Reviews</li>
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
                            <table class="datatable table table-hover table-center mb-0">
                                <thead>
                                    <tr>
                                        <th>Patient Name</th>
                                        <th>Doctor Name</th>
                                        <th>Ratings</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Date</th>
                                        <th class="text-right">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($reviews as $review)
                                        <tr>
                                            <td>
                                                <h2 class="table-avatar">
                                                    <a href="profile.html" class="avatar avatar-sm mr-2">
                                                        @if ($review->patient->photo)
                                                            <img class="avatar-img rounded-circle"
                                                                src="{{ asset('images/patients/' . $review->patient->photo) }}"
                                                                alt="{{ $review->patient->name }}">
                                                        @else
                                                            <img class="avatar-img rounded-circle"
                                                                src="{{ asset('assets/img/profile.png') }}"
                                                                alt="{{ $review->patient->name }}">
                                                        @endif
                                                    </a>
                                                    <a href="profile.html">{{ $review->patient->name }}
                                                    </a>
                                                </h2>
                                            </td>
                                            <td>
                                                <h2 class="table-avatar">
                                                    <a href="profile.html" class="avatar avatar-sm mr-2">
                                                        @if ($review->doctor->profile_photo)
                                                            <img class="avatar-img rounded-circle"
                                                                src="{{ asset('images/doctors/' . $review->doctor->profile_photo) }}"
                                                                alt="{{ $review->doctor->name }}">
                                                        @else
                                                            <img class="avatar-img rounded-circle"
                                                                src="{{ asset('assets/img/profile.png') }}"
                                                                alt="{{ $review->doctor->name }}">
                                                        @endif
                                                    </a>
                                                    <a href="profile.html">
                                                        {{ $review->doctor->name }}
                                                    </a>
                                                </h2>
                                            </td>

                                            <td>
                                                @for ($i = 1; $i <= $review->rating; $i++)
                                                    <i class="fe fe-star text-warning"></i>
                                                @endfor
                                                @for ($i = $review->rating + 1; $i <= 5; $i++)
                                                    <i class="fe fe-star-o text-secondary"></i>
                                                @endfor
                                            </td>


                                            <td>
                                                {{ $review->title }}
                                            </td>
                                            <td>
                                                {{ $review->comment }}
                                            </td>
                                            <td>
                                                {{ date('j M Y', strtotime($review->created_at)) }}
                                                <br>
                                                <small>
                                                    {{ date('h.i A', strtotime($review->created_at)) }}
                                                </small>
                                            </td>

                                            <td class="text-right">
                                                <div class="actions">
                                                    <form action="{{ route('review.destroy', $review->id) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm">
                                                            Delete
                                                        </button>
                                                    </form>

                                                </div>
                                            </td>
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
@endsection
