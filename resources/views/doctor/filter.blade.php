@extends('layouts.front')
@section('title')

Doctorkhuji || Doctors
@endsection
@section('content')
<!-- Breadcrumb -->
<div class="breadcrumb-bar ">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-8 col-12">
                <nav aria-label="breadcrumb" class="page-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Search</li>
                    </ol>
                </nav>
               
            </div>
            {{--  <div class="col-md-4 col-12 d-md-block d-none">
                <div class="sort-by">
                    <span class="sort-title">Sort by</span>
                    <span class="sortby-fliter">
                        <select class="select">
                            <option>Select</option>
                            <option class="sorting">Rating</option>
                            <option class="sorting">Popular</option>
                            <option class="sorting">Latest</option>
                            <option class="sorting">Free</option>
                        </select>
                    </span>
                </div>
            </div>  --}}
        </div>
    </div>
</div>
<!-- /Breadcrumb -->

<!-- Page Content -->
<div class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12 col-lg-4 col-xl-3 theiaStickySidebar">
            
                <!-- Search Filter -->
                <form action="{{url('filter-search')}}" method="post">
                    @csrf
                <div class="card search-filter ">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Search Filter</h4>
                    </div>
                    <div class="card-body">
                    <div class="filter-widget">
                        			
                    </div>
                    <div class="filter-widget">
                        <h4>Gender</h4>
                        <div>
                            <label class="custom_check">
                                <input type="radio" name="gender_type"  value="Male" <?php if($g=="Male") echo "checked"; ?>>
                                <span class="checkmark"></span> Male Doctor
                            </label>
                        </div>
                        <div>
                            <label class="custom_check">
                                <input type="radio" name="gender_type" value="Female" <?php if($g=="Female") echo "checked"; ?> >
                                <span class="checkmark"></span> Female Doctor
                            </label>
                        </div>
                    </div>
                    <div class="filter-widget">
                        <h4>Select Specialist</h4>
                       <div class="scroll-sub">
                        @php
                           $category = App\Category::orderBy('id','DESC')->get(); 
                        @endphp
                        @foreach ($category as $item)
                        <div>
                            <label class="custom_check">
                                <input  type="radio" name="select_specialist" value="{{$item->id}}" <?php if($id==$item->id) echo "checked"; ?>>
                                <span class="checkmark"></span> {{$item->name}}
                            </label>
                        </div>   
                        @endforeach
                    </div>
                       
                    </div>
                        <div class="btn-search">
                            <button type="submit" class="btn btn-block">Search</button>
                        </div>	
                    </div>
                </div>
            </form>
                <!-- /Search Filter -->
                
            </div>
            
            <div class="col-md-12 col-lg-8 col-xl-9">

             
                <!-- Doctor Widget -->
                @forelse ($users as $profile)
                <div class="card">
                    <div class="card-body">
                        <div class="doctor-widget">
                         
                                
                           
                            <div class="doc-info-left">
                                <div class="doctor-img">
                                    <a href="{{url('doctor-profile/'.$profile->slug)}}">
                                        <img src="{{asset('files/uploads/'.$profile->photo)}}" class="" alt="User Image" height="147" width="150">
                                    </a>
                                </div>
                                <div class="doc-info-cont">
                                    <h4 class="doc-name">{{$profile->fname}} {{$profile->lname}}</h4>
                                    
                                    <p class="doc-speciality">{{$profile->designa}}</p>
                                    <?php
                                $cat= App\Category::where('id',$profile->cat_id)->first();
                                ?>
                                <p class="doc-department"><img src="{{asset('images/'.@$cat->logo)}}" class="img-fluid" alt="0">{{@$cat->name}}</p>
                                <div class="rating">
                                    <?php
                                        $rv= App\Review::where('user_id',$profile->id)->get();
                                        $rvc=$rv->count();
                                        $rvr= $rv->sum('ratting');
                                        $rva=$rvr/$rvc;
                                    ?>
                                    @for ( $i=0 ; $i <$rva ; $i++)
                                    <i class="fas fa-star filled"></i>
                                    @endfor
                                    {{-- <i class="fas fa-star filled"></i>
                                    <i class="fas fa-star filled"></i>
                                    <i class="fas fa-star filled"></i>
                                    <i class="fas fa-star filled"></i>
                                    <i class="fas fa-star"></i> --}}
                                    <span class="d-inline-block average-rating">

                                        ({{$rvc}} {{round($rvr/$rvc,2)}})
                                    </span>
                                </div>
                                <div class="clinic-details">
                                    <p class="doc-location"><i class="fas fa-map-marker-alt"></i> {{$profile->present_address}} <a href="javascript:void(0);">Get Directions</a></p>
                                    {{-- <ul class="clinic-gallery">
                                        <li>
                                            <a href="assets/img/features/feature-01.jpg" data-fancybox="gallery">
                                                <img src="assets/img/features/feature-01.jpg" alt="Feature">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="assets/img/features/feature-02.jpg" data-fancybox="gallery">
                                                <img  src="assets/img/features/feature-02.jpg" alt="Feature Image">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="assets/img/features/feature-03.jpg" data-fancybox="gallery">
                                                <img src="assets/img/features/feature-03.jpg" alt="Feature">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="assets/img/features/feature-04.jpg" data-fancybox="gallery">
                                                <img src="assets/img/features/feature-04.jpg" alt="Feature">
                                            </a>
                                        </li>
                                    </ul> --}}
                                </div>
                                <div class="clinic-services">
                                    <?php
                                     $sp =$profile->specialization;
                                                $myArray = explode(',', $sp);
                                                ?>
                                                @foreach($myArray as $my_Array)
                                                <span> {!!$my_Array!!}</span>

                                                @endforeach

                                </div>
                                </div>
                            </div>
                          
                            <div class="doc-info-right">
                                <div class="clini-infos">
                                    <ul>
                                        <li>{{$profile->phone}}</li>
                                        <li> {{$profile->email}}</li>
                                        <li>{{$profile->present_address}}  </li>
                                        
                                    </ul>
                                </div>
                                <div class="clinic-booking">
                                    <a class="view-pro-btn" href="{{url('doctor-profile/'.$profile->slug)}}">View Profile</a>
                                    {{--  <a class="apt-btn" href="booking.html">Book Appointment</a>  --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                   <h1>Data No found</h1> 
                @endforelse
               
                <!-- /Doctor Widget -->

                <div class="load-more text-center">
                  
                </div>	
            </div>
        </div>

    </div>

</div>		
<!-- /Page Content -->


@endsection