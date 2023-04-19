@extends('layouts.admin')
@section('title')
   
Doctorkhuji || Patients   
@endsection
@section('content')
<div class="content container-fluid">

    @if ($message = Session::get('success'))
    <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}  </strong>
    </div>
   
    @endif
   
    <div class="tab-pane" id="today-appointments">
        <h5>Patient Lists </h5>
        <div class="card card-table mb-0">
            <div class="card-body">
              
                    <table id="example" class="display table " style="width:100%">
                        <thead>
                            <tr>
                                <th>Doctor <br> Name</th>
                                <th>Patient <br> Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Appt Date</th>
                                <th>Details</th>
                                <th>Action</th>
                               
                            </tr>
                        </thead>
                        <tbody>
                            
                            @forelse ($patients as $v)
                            <tr>
                                <td>{{$v->User->fname}} {{$v->User->lname}}</td>
                                <td>
                                    <h2 class="table-avatar">
                                        <a href="#" class="avatar avatar-sm mr-2"></a>
                                        <a href="#">{{$v->pname}}<span>#PT{{$v->id}}</span></a>
                                    </h2>
                                </td>
                                <td>{{$v->pemail}}</td>
                                <td>{{$v->pphone}}</td>
                                <td>{{date($v->created_at)}}</td>     
                                <td class="text-break">{{$v->pdetails}}</td>
                                <td><a href="#" onclick="deleteConfirmation({{$v->id}})" ><i class="fa fa-trash" aria-hidden="true"></i>
                                </a></td>
                                                                         
                            </tr> 
                            @empty
                               <tr>
                                   <td colspan="5">No Data</td>
                               </tr>
                            @endforelse
                                                                         
                        </tbody>
                    </table>                
            </div>
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
    url: "{{url('/delete-patient')}}/" + id,
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