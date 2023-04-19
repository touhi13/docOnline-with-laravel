@extends('layouts.admin')
@section('title')
   
Doctorkhuji|| category
@endsection
@section('content')
<div class="content container-fluid">

    @if ($message = Session::get('success'))
    <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}  <img src="images/{{ Session::get('image') }}" height="50"></strong>
    </div>
   
    @endif
    <div class="float-right">
        <a href="#" class="btn btn-sm btn-success" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Add Category</a>
    </div>
    <div class="mt-5">
        <table id="example" class="display table " style="width:100%">
    
            <thead>
            <tr>
                <th>Id</th>           
                <th>Name</th>
                <th>Description</th>
                <th>Logo</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($category as $v)
            <tr>
                <td>{{$v->id}}</td>
                <td>{{$v->name}}</td>
                <td>{{$v->des}}</td>
                <td><img src="{{asset('images/'.$v->logo)}}" alt="" height="50" width="50"></td>
                <td><a href="" class="btn btn-sm btn-info">Edit</a>
                    <a href="#" class="btn btn-sm btn-danger" onclick="deleteConfirmation({{$v->id}})">Delete</a></td>
            </tr>
            @endforeach
            
        </tbody>
        </table>
    </div>

</div>


<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">New Category</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="POST" enctype="multipart/form-data" action="{{url('create-category')}}">
            @csrf
            <div class="form-group">
                <label for="recipient-name" class="col-form-label">Logo:</label>
                <input type="file" class="form-control"  name="logo">
              </div>
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Name:</label>
              <input type="text" class="form-control"  name="name">
            </div>
            <div class="form-group">
              <label for="message-text" class="col-form-label">Description:</label>
              <textarea class="form-control" id="message-text" name="des"></textarea>
            </div>
         
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
      </div>
    </div>
  </div>
@endsection
@section('extrajs')
<script type="text/javascript">
    function deleteConfirmation(id) {
    swal({
    title: "Delete?",
    text: "Please ensure and then confirm!",
    type: "warning",
    showCancelButton: !0,
    confirmButtonText: "Yes, delete it!",
    cancelButtonText: "No, cancel!",
    reverseButtons: !0
    }).then(function (e) {
    if (e.value === true) {
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
    type: 'POST',
    url: "{{url('/delete-category')}}/" + id,
    data: {_token: CSRF_TOKEN},
    dataType: 'JSON',
    success: function (results) {
    if (results.success === true) {
    swal("Done!", results.message, "success");
    location.reload();
    } else {
    swal("Error!", results.message, "error");
    }
    }
    });
    } else {
    e.dismiss;
    }
    }, function (dismiss) {
    return false;
    })
    }
    </script>
@endsection