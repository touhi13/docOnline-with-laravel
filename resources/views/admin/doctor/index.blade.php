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
                    <p class="page-title">List of Doctors</p>
                </div>
                <div class="col-md-6 text-right">
                    <a class="btn btn-sm btn-dark" href="{{ url('admin/doctor/create') }}">Doctor add</a>
                </div>
            </div>
        </div>
        <div class="">
            <table id="example" class="display table " style="width:100%">
                <thead>
                    <tr>
                        <th></th>
                        <th>Doctor Name</th>
                        <th>Degrees</th>
                        <th>Specialities</th>
                        <th>Currently Working</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($doctors as $doctor)
                        <tr>
                            <td class="table-avatar">
                                <div class="avatar avatar-sm mr-2">
                                    @if ($doctor->profile_photo)
                                        <img class="avatar-img rounded-circle"
                                            src="{{ asset('images/doctors/' . $doctor->profile_photo) }}" alt="User Image">
                                    @else
                                        <img class="avatar-img rounded-circle" src="{{ asset('assets/img/profile.png') }}"
                                            alt="User Image">
                                    @endif
                                </div>
                            </td>
                            <td>{{ $doctor->name }}</td>
                            <td>
                                {{ implode(', ', $doctor->qualifications->pluck('title')->toArray()) }}

                            </td>
                            <td>
                                @php
                                    $professionNames = $doctor->specialities->pluck('profession_name')->toArray();
                                    echo implode(', ', $professionNames);
                                @endphp

                            </td>
                            <td>
                                @php
                                    // Retrieve an array of all the current experiences of the doctor.
                                    $currentExperiences = $doctor->newExperiences->where('is_current', 1)->toArray();
                                    
                                    // If there are any current experiences, display the organization name of the first one.
                                    if (!empty($currentExperiences) && isset($currentExperiences[0]['organization_name'])) {
                                        echo $currentExperiences[0]['organization_name'];
                                    }
                                @endphp

                            </td>
                            <td>
                                <a href="{{ url('doctor/' . $doctor->id) }}" class="btn btn-sm btn-info"><i
                                        class="fas fa-info-circle" aria-hidden="true"></i></a>
                                <a href="{{ url('inactive-doctor/' . $doctor->id) }}" class="btn btn-sm btn-warning"><i
                                        class="far fa-edit" aria-hidden="true"></i></a>
                                <a href="{{ url('active-doctor/' . $doctor->id) }}" class="btn btn-sm btn-danger"><i
                                        class="fas fa-trash-alt" aria-hidden="true"></i></a>
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
@endsection
