@extends('layouts.doctor')
@section('title')
{{Auth::user()->name}} - Review List
@endsection
@section('contant')
<div class="col-md-7 col-lg-8 col-xl-9">
    <div class="doc-review review-listing">
    
        <!-- Review Listing -->
        <ul class="comments-list">
        
            <!-- Comment List -->
            {{-- <li>
                <div class="comment">
                    <img class="avatar rounded-circle" alt="User Image" src="assets/img/patients/patient.jpg">
                    <div class="comment-body">
                        <div class="meta-data">
                            <span class="comment-author">Richard Wilson</span>
                            <span class="comment-date">Reviewed 2 Days ago</span>
                            <div class="review-count rating">
                                <i class="fas fa-star filled"></i>
                                <i class="fas fa-star filled"></i>
                                <i class="fas fa-star filled"></i>
                                <i class="fas fa-star filled"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                        <p class="recommended"><i class="far fa-thumbs-up"></i> I recommend the doctor</p>
                        <p class="comment-content">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                            sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                            Ut enim ad minim veniam, quis nostrud exercitation.
                            Curabitur non nulla sit amet nisl tempus
                        </p>
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
                    </div>
                </div>
                
                <!-- Comment Reply -->
                <ul class="comments-reply">
                
                    <!-- Comment Reply List -->
                    <li>
                        <div class="comment">
                            <img class="avatar rounded-circle" alt="User Image" src="assets/img/doctors/doctor-thumb-02.jpg">
                            <div class="comment-body">
                                <div class="meta-data">
                                    <span class="comment-author">Dr. Darren Elder</span>
                                    <span class="comment-date">Reviewed 3 Days ago</span>
                                </div>
                                <p class="comment-content">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                                    sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                                    Ut enim ad minim veniam.
                                    Curabitur non nulla sit amet nisl tempus
                                </p>
                                <div class="comment-reply">
                                    <a class="comment-btn" href="#">
                                        <i class="fas fa-reply"></i> Reply
                                    </a>
                                </div>
                            </div>
                        </div>
                    </li>
                    <!-- /Comment Reply List -->
                    
                </ul>
                <!-- /Comment Reply -->
                
            </li> --}}
            <!-- /Comment List -->
            
            <!-- Comment List -->
            @forelse ($review as $re)
            <li class="">
                <div class="row " style="width:100%">
                    <div class="col-md-10">
                        <img class="avatar avatar-sm rounded-circle" alt="User Image" src="{{asset('assets/img/profile.png')}}">
                        <div class="comment-body">
                            <div class="meta-data">
                                <span class="comment-author text-monospace">{{$re->rname}}</span>
                                <br>
                                <span class="comment-date">Reviewed {{$re->created_at->diffForHumans()}} </span>

                            </div>
                            {{-- <p class="recommended"><i class="far fa-thumbs-up"></i> I recommend the doctor</p> --}}
                            <p class="text-break text-capitalize font-weight-bolder" style="width: 100%;">
                               {{$re->rdescription}}
                            </p>
                            <div class="comment-reply">

                                <a class="comment-btn" href="#">
                                    <i class="fas fa-reply"></i> Reply
                                </a>


                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 text-right">

                        <p class="recommend-btn">
                            <div class="review-count rating">
                                @for ($i = 0; $i < $re->ratting; $i++)
                                <i class="fas fa-star filled"></i>
                            @endfor
                            </div>
                            <span>Recommend?</span><br>
                            <a href="#" class="like-btn">
                                <i class="far fa-thumbs-up"></i> Yes
                            </a>
                            <a href="#" class="dislike-btn">
                                <i class="far fa-thumbs-down"></i> No
                            </a>
                        </p>
                    </div>

                </div>
                {{-- <div class="comment">
                    <img class="avatar avatar-sm rounded-circle" alt="User Image" src="{{asset('assets/img/profile.png')}}">
                    <div class="comment-body">
                        <div class="meta-data">
                            <span class="comment-author">{{$item->rname}}</span>
                            <span class="comment-date">Reviewed {{$item->created_at->diffForHumans()}}</span>
                            <div class="review-count rating">
                                @for ($i = 0; $i < $item->ratting; $i++)
                                <i class="fas fa-star filled"></i>
                            @endfor
                               
                            </div>
                        </div>
                        <p class="comment-content">
                            {{$item->rdescription}}
                        </p>
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
                    </div>
                </div> --}}
            </li>
            @empty
                <li><p>No Data</p></li>
            @endforelse
           
          
            
          
            
        </ul>
        <!-- /Comment List -->
        
    </div>
</div>
@endsection