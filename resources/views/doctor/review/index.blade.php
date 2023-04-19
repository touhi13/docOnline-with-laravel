@extends('layouts.doctor')
@section('title')
    Doctorkhuji || Doctor Profile
@endsection
@section('content')
    <div class="col-md-7 col-lg-8 col-xl-9">
        <div class="doc-review review-listing">

            <!-- Review Listing -->
            <ul class="comments-list">
                @foreach ($reviews as $review)
                    <li>
                        <div class="comment">
                            @if ($review->patient->photo && !preg_match('/\bhttps?:\/\/\S+/', $review->patient->photo))
                                <img class="avatar avatar-sm rounded-circle" alt="{{ $review->patient->name }}"
                                    src='{{ asset('images/patients/' . $review->patient->photo) }}'>
                            @elseif (preg_match('/\bhttps?:\/\/\S+/', $review->patient->photo))
                                <img class="avatar avatar-sm rounded-circle" alt="{{ $review->patient->name }}"
                                    src='{{ $review->patient->photo }}'>
                            @else
                                <img class="avatar avatar-sm rounded-circle" alt="{{ $review->patient->name }}"
                                    src='{{ asset('assets/img/profile.png') }}'>
                            @endif
                            <div class="comment-body">
                                <div class="meta-data">
                                    <div>
                                        <span class="comment-author">
                                            {{ $review->patient->name }}
                                        </span>
                                        <span class="comment-date">
                                            Reviewed on
                                            {{ $review->created_at->diffForHumans() }}
                                        </span>
                                    </div>
                                    <div class="review-count rating float-right">
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
                                {{-- 
                                    <div class="comment-reply">
                                    <a class="comment-btn" href="#">
                                        <i class="fas fa-reply"></i> Reply
                                    </a>
                                    <p class="recommend-btn">
                                        <span>Recommend?</span>
                                        <a href="#" class="like-btn">
                                            <i class="far fa-thumbs-up"></i> Yes
                                        </a>
                                        <a href="#" class="dislike-btn">
                                            <i class="far fa-thumbs-down"></i> No
                                        </a>
                                    </p>
                                </div>
                                 --}}
                            </div>
                        </div>
                    </li>
                @endforeach


            </ul>
            <!-- /Comment List -->

        </div>
    </div>
@endsection
