@extends('layouts.admin')
@section('title')
 
Doctorkhuji || Settings
@endsection
@section('content')

<div class="col-md-7 col-lg-8 col-xl-9">
  @if ($message = Session::get('success'))
    <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }} 
    </div>
   
    @endif
    <form action="{{url('setting-update')}}" method="POST" enctype="multipart/form-data">
        @csrf
      <div class="row">
          <div class="col-md-6">
            <div class="form-group">
                <label for="formGroupExampleInput">Company Name</label>
                <input type="text" name="name" class="form-control" id="formGroupExampleInput" placeholder="Company Name" value="{{@$s->name}}">
              </div><div class="form-group">
                <label for="formGroupExampleInput">Company Email</label>
                <input type="text" name="email" class="form-control" id="formGroupExampleInput" placeholder="Company Email" value="{{@$s->email}}">
              </div><div class="form-group">
                <label for="formGroupExampleInput">Company Phone</label>
                <input type="text" name="phone" class="form-control" id="formGroupExampleInput" placeholder="Company Phone" value="{{@$s->phone}}">
              </div>
            <div class="form-group">
              <label for="formGroupExampleInput2">Address</label>
              <textarea name="address" class="form-control" id="formGroupExampleInput2" cols="30" rows="3">{{@$s->address}}</textarea>
              
            </div>
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="inputGroupFile01" name="logo">
                <label class="custom-file-label" for="inputGroupFile01">Choose Company Logo</label>
              </div>

          </div>
          <div class="col-md-6">
            <div class="form-group">
                <label for="formGroupExampleInput">Facebook</label>
                <input type="text" name="fac" class="form-control" id="formGroupExampleInput" placeholder="" value="{{@$s->facbook}}">
              </div><div class="form-group">
                <label for="formGroupExampleInput">Youtube</label>
                <input type="text" name="youtube" class="form-control" id="formGroupExampleInput" placeholder="" value="{{@$s->youtube}}">
              </div><div class="form-group">
                <label for="formGroupExampleInput">Twitter</label>
                <input type="text" name="twitter" class="form-control" id="formGroupExampleInput" placeholder="" value="{{@$s->twitter}}">
              </div>
            <div class="form-group">
              <label for="formGroupExampleInput2">Instagram</label>
              <input type="text" name="instagram" class="form-control" id="formGroupExampleInput" placeholder="" value="{{@$s->instagram}}">
              
            </div>
            <div class="form-group">
                <label for="formGroupExampleInput2">Linkedin</label>
                <input type="text" name="linkdin" class="form-control" id="formGroupExampleInput" placeholder="" value="{{@$s->linkdin}}">
                
              </div>
              
          </div>
          <div class="form-group ml-3">
            <input type="submit" value="submit" class="form-control btn btn-sm btn-primary">
        </div>
      </div>
       
      </form>
</div>
@endsection