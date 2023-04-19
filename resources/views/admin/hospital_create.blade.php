@extends('layouts.admin')
@section('title')

Doctorkhuji || Hospital Create 
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
<form action="{{url('hospital-add')}}" enctype="multipart/form-data" method="post">
    @csrf
    <!-- Basic Information -->
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Hospital Information</h4>
            <div class="row form-row">
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="change-avatar">
                           
                            <div class="upload-img">
                                <div class="change-photo-btn">
                                    <span><i class="fa fa-upload"></i> Upload Logo</span>
                                    <input type="file" name="logo" class="upload" required>
                                </div>
                                <small class="form-text text-muted">Allowed JPG, GIF or PNG. Max size of 2MB</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Name <span class="text-danger">*</span></label>
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
                    <div class="form-group">
                        <label>Phone </label>
                        <input type="text" value="" name="phone" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Address </label>
                       <textarea name="address" id="" cols="30" rows="3" class="form-control"></textarea>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Hospital Info </label>
                       <textarea name="info" id="" cols="30" rows="5" class="form-control"></textarea>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <input type="submit" name="" value="submit" class="btn btn-sm btn-info" >
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Basic Information -->
  

 

   

   

  
</form>
   

    


   

   

   
</div>
@endsection
