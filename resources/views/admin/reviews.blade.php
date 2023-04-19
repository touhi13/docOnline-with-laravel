@extends('layouts.admin')
@section('title')

Doctorkhuji || Review List
@endsection
@section('content')
<!-- Page Wrapper -->         
                <div class="content container-fluid">				
					
					
					<div class="row">
                         
						<div class="col-sm-12">
                            <p>Doctors <b>Review</b></p>    
							<div class="card">
                              
								<div class="card-body">
								<style>
                                    table{
                                        border-collapse:collapse; table-layout:fixed; width:100% ;
                                    }
                                    table td{
                                        border:solid 1px #fab; width:100px; word-wrap:break-word;
                                    }
                                </style>
                                        <table id="example" class="table " style="">
											<thead>
												<tr>
													<th>Patient Name</th>
													<th>Doctor Name</th>
													<th>Ratings</th>
													<th>Description</th>
													<th>Date</th>
													<th class="text-right">Actions</th>
												</tr>
											</thead>
											<tbody>
                                                @foreach ($review as $item)
                                                <tr>
													<td>
														<h2 class="table-avatar">
															<a href="profile.html" class="avatar avatar-sm mr-2"><img class="avatar-img rounded-circle" src="{{asset('assets/img/profile.png')}}" alt="User Image"></a>
															<a href="profile.html">{{$item->rname}} </a>
														</h2>
													</td>
													<td>
														<h2 class="table-avatar">
                                                            <a href="{{url('doctor-profile-/'.$item->user_id)}}" class="avatar avatar-sm mr-2">
                                                                @if ($item->user->photo)
                                                                <img class="avatar-img rounded-circle" src="{{asset('files/uploads/'.$item->user->photo)}}" alt="User Image">
                                                                @else
                                                                <img class="avatar-img rounded-circle" src="{{asset('assets/img/profile.png')}}" alt="User Image">
                                                                @endif
                                                                </a>
                                                            
                                                            <a href="{{url('doctor-profile-/'.$item->user_id)}}"> {{$item->user->fname}} {{$item->user->lname}}  </a>
														
														</h2>
													</td>
													
													<td>
                                                        @for ($i = 0; $i < $item->ratting; $i++)
                                                        <i class="fe fe-star text-warning"></i>
                                                    @endfor
														
														
													</td>
													
													<td style="">
														{{$item->rdescription}}
													</td>
														<td>{{$item->created_at}}</td>
													<td class="text-right">
														<div class="actions">
															<a class="btn btn-sm bg-danger-light" data-toggle="modal" href="#" onclick="deleteConfirmation({{$item->id}})">
																<i class="fe fe-trash"></i> 
															</a>
															
														</div>
													</td>
												</tr> 
                                                @endforeach
											
											
											</tbody>
										</table>
									
								</div>
							</div>
						</div>			
					</div>
					
				</div>			
		
			<!-- /Page Wrapper -->
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
    url: "{{url('/delete-review')}}/" + id,
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