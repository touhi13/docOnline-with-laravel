@extends('layouts.admin')
@section('title')
{{Auth::user()->name}} - Profile Setting
@endsection
@section('content')
<div class="col-md-7 col-lg-8 col-xl-9">
    @if ($message = Session::get('success'))
<div class="alert alert-success alert-block">
	<button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
</div>
@endif
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <!-- Basic Information -->
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Basic Information</h4>
            <div class="row form-row">
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="change-avatar">
                            <div class="profile-img">
                                <img src="{{asset('files/uploads/'.@$users->photo)}}" alt="User Image">
                            </div>
                           
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Username <span class="text-danger">*</span></label>
                        <input type="text" name="name" value="{{$users->name}}" class="form-control" readonly>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" value="{{$users->email}}" class="form-control" readonly>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>First Name <span class="text-danger">*</span></label>
                        <input type="text" name="fname" value="{{$users->fname}}" class="form-control" readonly>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Last Name <span class="text-danger">*</span></label>
                        <input type="text" value="{{$users->lname}}" name="lname" class="form-control" readonly>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Phone Number</label>
                        <input type="text" value="{{$users->phone}}" name="phone" class="form-control" readonly>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Gender</label>
                        @if ($users->gender)
                        <select class="form-control select" name="gender" >
                        <option value="{{$users->gender}}">{{$users->gender}}</option>
                        </select>                     
                        @else
                        <select class="form-control select" name="gender">
                            <option>Select</option>                            
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Category</label>
                        <?php 	$cat=App\Category::all();
                             ?>
                    
                        <select class="form-control" name="cat_id">
                            <option value="">Select One</option>
                            @foreach ($cat as $v )
                            <option   value="{{$v->id}}" <?php if($users->cat_id==$v->id) echo "selected"; ?> >{{$v->name}}</option>
                            @endforeach
                        </select>                     
                      
                    
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-0">
                        <label>Date of Birth</label>
                        <input type="text" name="dateOfbirth" class="form-control" value="{{$users->dateOfbirth}}" readonly>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Basic Information -->
    {{-- designation  --}}
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Designation</h4>
            <div class="form-group mb-0">
                <label>Designation</label>
                <input type="text" name="design" id="" class="form-control" value="{{$users->designa}}" readonly>

            </div>
        </div>
    </div>
    <!-- About Me -->
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">About Me</h4>
            <div class="form-group mb-0">
                <label>Biography</label>
                <textarea name="aboutMe" class="form-control" rows="5" readonly>{{$users->aboutMe}}</textarea>
            </div>
        </div>
    </div>
    <!-- /About Me -->

   

    <!-- Contact Details -->
    <div class="card contact-card">
        <div class="card-body">
            <h4 class="card-title">Contact Details</h4>
            <div class="row form-row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Present Address</label>
                        <textarea class="form-control" name="present_address" id="" cols="30" rows="5" readonly>{{$users->present_address}}</textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Permanent Address</label>
                        <textarea class="form-control" name="permanent_address" id="" cols="30" rows="5" readonly>{{$users->permanent_address}}</textarea>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- /Contact Details -->

  

    <!-- Services and Specialization -->
    <div class="card services-card">
        <div class="card-body">
            <h4 class="card-title">Services and Specialization</h4>
            <div class="form-group">
                <label>Services</label>
                <input type="text" data-role="tagsinput" class="input-tags form-control" placeholder="Enter Services" name="services" value="{{$users->services}}" id="services" readonly>
                <small class="form-text text-muted">Note : Type & Press enter to add new services</small>
            </div>
            <div class="form-group mb-0">
                <label>Specialization </label>
                <input class="input-tags form-control" type="text" data-role="tagsinput" placeholder="Enter Specialization" name="specialist" value="{{$users->specialization}}" id="specialist" readonly>
                <small class="form-text text-muted">Note : Type & Press  enter to add new specialization</small>
               
            </div>
        </div>
    </div>
    <div class="form-group mb-0">
       
    </div>
</form>
    <!-- /Services and Specialization -->

    <!-- Education -->

    <div id="accordion">
        <div class="card">
          <div class="card-header" id="headingOne">
            <h5 class="mb-0">
              <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                Education
              </button>
            </h5>
          </div>
      
          <div id="collapseOne" class="collapse " aria-labelledby="headingOne" data-parent="#accordion">
            <div class="card">
                <div class="card-body">
                    <form action="{{url('admin-education')}}" method="post">
                        @csrf
                        <input type="hidden" name="did" value="{{$users->id}}">
                    <div class="education-info">
                        <div class="row form-row education-cont">
                            <div class="col-12 col-md-10 col-lg-11">
                                <div class="row form-row">
                                    <div class="col-12 col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label>Degree</label>
                                            <input type="text" name="degree[]" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label>College/Institute</label>
                                            <input type="text" name="institute[]" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label>Year of Completion</label>
                                            <input type="text" name="completion[]" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="add-more">
                        <a href="javascript:void(0);" class="add-education"><i class="fa fa-plus-circle"></i> Add More</a>
                    </div>
                    <button type="submit" class="btn btn-info btn-sm submit-btn mt-2">Save</button>
                </form>
                </div>
            </div>
          </div>
        </div>
        <!-- /Education -->
        <!-- /Experience -->
        <div class="card">
            <div class="card-header" id="headingTwo">
              <h5 class="mb-0">
                <button type="button" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    Experience
                </button>
              </h5>
            </div>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                <div class="card-body">
                    <form action="{{url('admin-experience')}}" method="post">
                        @csrf
                    <input type="hidden" name="did" value="{{$users->id}}">
                    <div class="experience-info">
                        <div class="row form-row experience-cont">
                            <div class="col-12 col-md-10 col-lg-11">
                                <div class="row form-row">
                                    <div class="col-12 col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label>Hospital Name</label>
                                            <select name="hospitalName[]" id="" class="form-control">
                                                @foreach ($hospitals as $hos )
                                                <option value="{{$hos->name}}" >{{$hos->name}}</option>
                                                @endforeach
                                               
                                            </select>
                                            {{--  <input type="text" name="hospitalName[]" class="form-control">  --}}
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label>From</label>
                                            <input type="text" name="from[]" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label>To</label>
                                            <input type="text" name="to[]" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label>Designation</label>
                                            <input type="text" name="designation[]" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="add-more">
                        <a href="javascript:void(0);" class="add-experience"><i class="fa fa-plus-circle"></i> Add More</a>
                    </div>
                    <button type="submit" class="btn btn-info btn-sm submit-btn mt-2">Save</button>
                </form>
                </div>
            </div>
          </div>
          <!-- /Experience -->
          {{--  Awards  --}}
          <div class="card">
            <div class="card-header" id="headingThree">
              <h5 class="mb-0">
                <button type="button" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    Awards
                </button>
              </h5>
            </div>
            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                <div class="card-body">
                    <form action="{{url('admin-awards')}}" method="post">
                        @csrf
                        <input type="hidden" name="did" value="{{$users->id}}">
                    <div class="awards-info">
                        <div class="row form-row awards-cont">
                            <div class="col-12 col-md-5">
                                <div class="form-group">
                                    <label>Awards</label>
                                    <input type="text" name="awards[]" class="form-control">
                                </div>
                            </div>
                            <div class="col-12 col-md-5">
                                <div class="form-group">
                                    <label>Year</label>
                                    <input type="text" name="ayear[]" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="add-more">
                        <a href="javascript:void(0);" class="add-award"><i class="fa fa-plus-circle"></i> Add More</a>
                    </div>
                    <button type="submit" class="btn btn-info btn-sm submit-btn mt-2">Save</button>
                </form>
                </div>
            </div>
          </div>
          {{--  Awards  --}}
          {{--  Memberships  --}}
          <div class="card">
            <div class="card-header" id="headingfive">
              <h5 class="mb-0">
                <button type="button" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapsefive" aria-expanded="false" aria-controls="collapsefive">
                    Memberships
                </button>
              </h5>
            </div>
            <div id="collapsefive" class="collapse" aria-labelledby="headingfive" data-parent="#accordion">
            <div class="card-body">
                <form action="{{url('admin-memberships')}}" method="post">
                    @csrf
                    <input type="hidden" name="did" value="{{$users->id}}">
                <div class="membership-info">
                    <div class="row form-row membership-cont">
                        <div class="col-12 col-md-10 col-lg-5">
                            <div class="form-group">
                                <label>Memberships</label>
                                <input type="text" name="memberships[]" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="add-more">
                    <a href="javascript:void(0);" class="add-membership"><i class="fa fa-plus-circle"></i> Add More</a>
                </div>
                <button type="submit" class="btn btn-info btn-sm submit-btn mt-2">Save</button>
                </form>
            </div>
        </div>
          </div>
          {{--  Memberships  --}}
          {{--  Registrations  --}}
          <div class="card">
            <div class="card-header" id="headingsix">
              <h5 class="mb-0">
                <button type="button" class="btn btn-link  collapsed" data-toggle="collapse" data-target="#collapsesix" aria-expanded="false" aria-controls="collapsesix">
                    Registrations
                </button>
              </h5>
            </div>
            <div id="collapsesix" class="collapse" aria-labelledby="headingsix" data-parent="#accordion">
                <div class="card-body">
                    <form action="{{url('admin-registrations')}}" method="post">
                        @csrf
                        <input type="hidden" name="did" value="{{$users->id}}">
         
                    <div class="registrations-info">
                        <div class="row form-row reg-cont">
                            <div class="col-12 col-md-5">
                                <div class="form-group">
                                    <label>Registrations</label>
                                    <input type="text" name="registrations[]" class="form-control">
                                </div>
                            </div>
                            <div class="col-12 col-md-5">
                                <div class="form-group">
                                    <label>Year</label>
                                    <input type="text" name="ryear[]" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="add-more">
                        <a href="javascript:void(0);" class="add-reg"><i class="fa fa-plus-circle"></i> Add More</a>
                    </div>
                    <button type="submit" class="btn btn-info btn-sm submit-btn mt-2">Save</button>
                </form>
                </div>
            </div>
          </div>
          {{--  Registrations  --}}
        </div>


   

   

   
</div>
@endsection

