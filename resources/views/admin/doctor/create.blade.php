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
        <form action="{{ route('doctor.store') }}" enctype="multipart/form-data" method="post">
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
                                            <input type="file" name="profile_photo" class="upload" required>
                                        </div>
                                        <small class="form-text text-muted">Allowed JPG, GIF or PNG. Max size of 2MB</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Title <span class="text-danger">*</span></label>
                                <select name="title" id="" class="form-control select">
                                    <option hidden></option>
                                    <option value="Dr.">
                                        Dr.
                                    </option>
                                    <option value="Prof. Dr.">
                                        Prof. Dr.
                                    </option>
                                    <option value="Assoc. Prof. Dr.">
                                        Assoc. Prof. Dr.
                                    </option>

                                    <option value="Asst. Prof. Dr.">
                                        Asst. Prof. Dr.
                                    </option>
                                </select>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>First Name <span class="text-danger">*</span></label>
                                <input type="text" name="first_name" value="" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Last Name <span class="text-danger">*</span></label>
                                <input type="text" value="" name="last_name" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-0">
                                <label>Date of Birth</label>
                                <input type="date" name="date_of_birth" class="form-control" value="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Gender</label>
                                <select class="form-control select" name="gender">
                                    <option hidden></option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>

                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>District</label>
                                <select class="form-control select" name="district_id">
                                    <option hidden></option>
                                    <option hidden></option>
                                    @foreach ($districts as $key => $value)
                                        <option value={{ $value }}>{{ $key }}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>National ID / Passport Number</label>
                                <input type="text" value="" name="nid" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Registration Number (BMDC) </label>
                                <input type="text" value="" name="regno" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Mobile Number</label>
                                <input type="text" value="" name="phone" class="form-control">
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
                        <div class="col-md-12">
                            <div class="form-group">
                                <button class="btn btn-primary btn-lg">submit</button>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Basic Information -->
        </form>
    </div>
@endsection
@section('extrajs')
    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    </script>
@endsection
