@extends('layouts.front')
@section('title')
    Doctorkhuji || All Review
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
                            <li class="breadcrumb-item active" aria-current="page">Doctor Reviews</li>
                        </ol>
                    </nav>
                    <h2 class="breadcrumb-title">Doctor Reviews</h2>
                </div>
            </div>
        </div>
    </div>
    <!-- /Breadcrumb -->

    <!-- Page Content -->
    <div class="content">
        <div class="container">

            <!-- Review Listing -->
            <div class="widget review-listing">
                <ul class="comments-list">

                    <!-- Comment List -->

                    @foreach ($reviews as $review)
                    <li>
                        <div class="comment">
                            @if ($review->patient->photo)
                                <img class="avatar avatar-sm rounded-circle"
                                    alt="{{ $review->patient->name }}"
                                    src='{{ asset('images/patients/' . $review->patient->photo) }}'>
                            @else
                                <img class="avatar avatar-sm rounded-circle"
                                    alt="{{ $review->patient->name }}"
                                    src='{{ asset('assets/img/profile.png') }}'>
                            @endif

                            <div class="comment-body">
                                <div class="meta-data">
                                    <span class="comment-author">{{ $review->patient->name }}</span>
                                    <span class="comment-date">Reviewed
                                        {{ $review->created_at->diffForHumans() }}</span>
                                    <div class="review-count rating">
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <= $review->rating)
                                                <i class="fas fa-star filled"></i>
                                            @else
                                                <i class="fas fa-star"></i>
                                            @endif
                                        @endfor
                                    </div>
                                </div>
                                <p class="recommended">{{ $review->title }}</p>
                                <p class="comment-content">
                                    {{ $review->comment }}
                                </p>
                            </div>
                        </div>
                    </li>
                @endforeach

                    <!-- /Comment List -->



                </ul>

                <!-- Show All -->
                <div class="all-feedback text-center">
                    <a href="{{ url('/') }}" class="btn btn-primary btn-sm">
                        Home
                    </a>
                </div>
                <!-- /Show All -->

            </div>
            <!-- /Review Listing -->



        </div>
    </div>
    <!-- /Page Content -->
@endsection
