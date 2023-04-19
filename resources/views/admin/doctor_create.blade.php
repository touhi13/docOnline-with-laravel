@extends('layouts.admin')
@section('title')
    Doctorkhuji || Doctor Create
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
        <form action="{{ url('doctor-create') }}" enctype="multipart/form-data" method="post">
            @csrf
            <!-- Basic Information -->
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Basic Information</h4>
                    <div class="row form-row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="change-avatar">

                                    <div class="upload-img">
                                        <div class="change-photo-btn">
                                            <span><i class="fa fa-upload"></i> Upload Photo</span>
                                            <input type="file" name="photo" class="upload" required>
                                        </div>
                                        <small class="form-text text-muted">Allowed JPG, GIF or PNG. Max size of 2MB</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Username <span class="text-danger">*</span></label>
                                <input type="text" name="name" value="" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Email <span class="text-danger">*</span></label>
                                <input type="email" name="email" value="" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-focus">
                                <label class="focus-label">Create Password</label>
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password" required
                                    autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-focus">
                                <label class="focus-label">Confirm Password</label>
                                <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" required autocomplete="new-password">



                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>First Name <span class="text-danger">*</span></label>
                                <input type="text" name="fname" value="" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Last Name <span class="text-danger">*</span></label>
                                <input type="text" value="" name="lname" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Phone Number</label>
                                <input type="text" value="" name="phone" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Gender</label>

                                <select class="form-control select" name="gender">
                                    <option>Select</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Category</label>
                                <?php $cat = App\Category::all();
                                ?>

                                <select class="form-control js-example-basic-single" name="cat_id">
                                    <option value="">Select One</option>
                                    @foreach ($cat as $v)
                                        <option value="{{ $v->id }}">{{ $v->name }}</option>
                                    @endforeach
                                </select>


                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-0">
                                <label>Date of Birth</label>
                                <input type="text" name="dateOfbirth" class="form-control" value="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Basic Information -->
            {{-- designation  --}}
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-0">
                                <label>Designation</label>
                                <input type="text" name="design" id="" class="form-control" value="">

                            </div>
                        </div>
                        <div class="col-md-6">
                            <?php $hos = App\Hospital::get(); ?>
                            <label>Present Work</label>
                            <select name="pwork" id="" class="form-control js-example-basic-single">
                                @foreach ($hos as $h)
                                    <option value="{{ $h->name }}">{{ $h->name }}</option>
                                @endforeach

                            </select>
                        </div>
                    </div>


                </div>
            </div>
            <!-- About Me -->
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">About Me</h4>
                    <div class="form-group mb-0">
                        <label>Biography</label>
                        <textarea name="aboutMe" class="form-control" rows="5"></textarea>
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
                                <textarea class="form-control" name="present_address" id="" cols="30" rows="5"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Permanent Address</label>
                                <textarea class="form-control" name="permanent_address" id="" cols="30" rows="5"></textarea>
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
                        <input type="text" data-role="tagsinput" class="input-tags form-control"
                            placeholder="Enter Services" name="services" value="" id="services">
                        <small class="form-text text-muted">Note : Type & Press enter to add </small>
                    </div>
                    <div class="form-group mb-0">
                        <label>Specialization </label>
                        <input class="input-tags form-control" type="text" data-role="tagsinput"
                            placeholder="Enter Specialization" name="specialist" value="" id="specialist">
                        <small class="form-text text-muted">Note : Type & Press enter to add </small>
                        <button type="submit" class="btn btn-danger btn-sm submit-btn mt-2">Save Changes</button>
                    </div>
                </div>
            </div>
            <div class="form-group mb-0">

            </div>
        </form>
        <!-- /Services and Specialization -->

        <!-- Education -->









    </div>
@endsection
@section('extrajs')
    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    </script>
@endsection
