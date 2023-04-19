@extends('layouts.admin')
@section('title')
    
Doctorkhuji || Hospital List 
@endsection
@section('content')
<div class="content container-fluid">

    @if ($message = Session::get('success'))
    <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}  </strong>
    </div>
   
    @endif
    <div class="page-header">
        <div class="row">
            <div class="col-sm-6">
                <p class="page-title">List of Hospital</p>                
            </div>
            <div class="col-md-6 text-right">
                <a class="btn btn-sm btn-dark" href="{{url('hospital-create')}}">Hospital Create</a>
                
            </div>
        </div>
    </div>
   
    <div class="">
        <table id="example" class="display table " style="width:100%">
    
            <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>                   
                <th>Phone <br> Email</th> 
                <th>Address</th>
                <th>Info</th>           
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($hospitals as $v)
            <tr> 
                <td>{{$v->id}}</td>
                <td> <h2 class="table-avatar">
                    <a href="#" class="avatar avatar-sm mr-2">
                        @if ($v->logo)
                        <img class="avatar-img rounded-circle" src="{{asset('files/uploads/'.$v->logo)}}" alt="User Image">
                        @else
                        <img class="avatar-img rounded-circle" src="{{asset('assets/img/profile.png')}}" alt="User Image">
                        @endif
                        </a>
                        <br>
                    
                    <a href="#"> {{$v->name}}  
                    </a>
                    
            
                </h2>
                </td>
                <td>
                   {{$v->phone}} <br> {{$v->email}}
                </td>
                <td>{{
                    $v->address                   
                    
                }}</td>
                <td>
                    {{$v->info}}
                </td>
                <td>
                  
                    <a href="#" onclick="deleteConfirmation({{$v->id}})" ><i class="fa fa-trash" aria-hidden="true"></i>
                    </a>
                    
                </td>
            </tr>
            @endforeach
            
        </tbody>
        </table>
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
    url: "{{url('/delete-hospital')}}/" + id,
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