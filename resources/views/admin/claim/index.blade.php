@extends('layouts.admin')
@section('title')
    Doctorkhuji || Doctor List
@endsection
@section('content')
    <div class="content container-fluid">
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }} </strong>
            </div>
        @endif
        <div class="page-header">
            <div class="row">
                <div class="col-sm-6">
                    <p class="page-title">List of Claims</p>
                </div>
                <div class="col-md-6 text-right">
                    <a class="btn btn-sm btn-dark" href="{{ url('doctor-add') }}">Doctor add</a>
                </div>
            </div>
        </div>
        <div class="">
            <table id="example" class="display table " style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Claim for</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>File</th>
                        <th>Approval</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($claims as $claim)
                        <tr>
                            <td>
                                {{ ++$loop->index }}
                            </td>
                            <td>
                                <h2>
                                    <a href={{ url('doctor/' . $claim->doctor_id) }} target="_blank"
                                        rel="noopener noreferrer">{{ $claim->title }}
                                    </a>
                                </h2>

                            </td>
                            <td>
                                {{ $claim->email }}
                            </td>
                            <td>
                                {{ $claim->phone }}
                            </td>
                            <td>
                                <a href={{ asset('storage/document/claim_files/' . $claim->file) }} target="_blank"
                                    rel="noopener noreferrer">
                                    <i class="far fa-file-pdf"></i>
                                </a>
                            </td>
                            <td>
                                @if ($claim->status === 0)
                                    <span class="badge badge-pill bg-secondary inv-badge">Pending</span>
                                @elseif ($claim->status === 1)
                                    <span class="badge badge-pill bg-success inv-badge">Approved</span>
                                @else
                                    <span class="badge badge-pill bg-danger inv-badge">Rejected</span>
                                @endif
                            </td>
                            <td>
                                <div class="actions">
                                    <a class="btn btn-sm bg-success-light review" data-toggle="modal" href="#review-modal"
                                        data-id={{ $claim->id }}>
                                        <i class="fe fe-pencil"></i> Review
                                    </a>
                                    <a data-toggle="modal" href="#delete_modal" class="btn btn-sm bg-danger-light">
                                        <i class="fe fe-trash"></i> Delete
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>

    </div>
    <!--Modal -->
    <div class="modal fade" id="review-modal" aria-hidden="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Specialities</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        @csrf
                        <div class="row form-row">
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label>Review Request</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="approval" id="approve"
                                            value=1>
                                        <label class="form-check-label" for="approve">
                                            Approve
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="approval" id="reject"
                                            value=2>
                                        <label class="form-check-label" for="reject">
                                            Reject
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label>Mail Body</label>
                                    <textarea name="mail" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /Edit Details Modal -->
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
            }).then(function(e) {
                if (e.value === true) {
                    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                    $.ajax({
                        type: 'POST',
                        url: "{{ url('/delete-category') }}/" + id,
                        data: {
                            _token: CSRF_TOKEN
                        },
                        dataType: 'JSON',
                        success: function(results) {
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
            }, function(dismiss) {
                return false;
            })
        }
    </script>
    <script>
        $(document).ready(function() {
            $(document).on('click', '.review', function(e) {
                e.preventDefault();
                const id = $(this).attr('data-id');
                const form = $("#review-modal").find("form");
                form.attr("action", "{{ url('review_claim') }}/" + id);
            });
        });
    </script>
@endsection
