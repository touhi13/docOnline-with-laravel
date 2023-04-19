@extends('layouts.admin')
@section('title')
    Doctorkhuji|| Speciality
@endsection
@section('content')
    <div class="content container-fluid">

        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}
                    <img src="images/{{ Session::get('image') }}" height="50">
                </strong>
            </div>
        @endif
        <div class="float-right">
            <a href="#" class="btn btn-sm btn-success" data-toggle="modal" data-target="#exampleModal"
                data-whatever="@mdo">Add Speciality</a>
        </div>
        <div class="mt-5">
            <table id="example" class="display table " style="width:100%">

                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Typical Name</th>
                        <th>Profession Name</th>
                        <th>Description</th>
                        <th>Icon</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($specialities as $speciality)
                        <tr>
                            <td>{{ $speciality->id }}</td>
                            <td>{{ $speciality->name }}</td>
                            <td>{{ $speciality->typical_name }}</td>
                            <td>{{ $speciality->profession_name }}</td>
                            <td>{{ $speciality->description }}</td>
                            <td>
                                <img src="{{ asset('images/specialities/' . $speciality->icon) }}"
                                    alt="{{ $speciality->name }}" height="50" width="50">
                            </td>
                            <td>
                                <a href="#" class="btn btn-sm btn-info edit-btn" data-toggle="modal"
                                    data-target="#exampleModal" data-whatever="@mdo" data-id="{{ $speciality->id }}"
                                    data-name="{{ $speciality->name }}"
                                    data-typical-name="{{ $speciality->typical_name }}"
                                    data-profession-name="{{ $speciality->profession_name }}"
                                    data-description="{{ $speciality->description }}" data-icon="{{ $speciality->icon }}">
                                    Edit
                                </a>


                                <a href="#" class="btn btn-sm btn-danger"
                                    onclick="deleteConfirmation({{ $speciality->id }})">Delete</a>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>

    </div>


    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New Specialtity</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" enctype="multipart/form-data" action="{{ route('speciality.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="icon" class="col-form-label">Icon:</label>
                            <input type="file" class="form-control" name="icon" id="icon">
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-form-label">Name:</label>
                            <input type="text" class="form-control" name="name" id="name">
                        </div>
                        <div class="form-group">
                            <label for="typical_name" class="col-form-label">Typical Name:</label>
                            <input type="text" class="form-control" name="typical_name" id="typical_name">
                        </div>
                        <div class="form-group">
                            <label for="profession_name" class="col-form-label">Profession Name:</label>
                            <input type="text" class="form-control" name="profession_name" id="profession_name">
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Description:</label>
                            <textarea class="form-control" id="message-text" name="description"></textarea>
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
            }).then(function(e) {
                if (e.value === true) {
                    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                    $.ajax({
                        type: 'POST',
                        url: "{{ url('/admin/speciality') }}/" + id,
                        data: {
                            _token: CSRF_TOKEN,
                            _method: 'DELETE'
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
        $(document).on('click', '.edit-btn', function() {
            var id = $(this).data('id');
            var name = $(this).data('name');
            var typicalName = $(this).data('typical-name');
            var professionName = $(this).data('profession-name');
            var description = $(this).data('description');
            var icon = $(this).data('icon');

            $('#exampleModal').find('.modal-title').text('Edit Specialtity');
            $('#exampleModal').find('.modal-body #name').val(name);
            $('#exampleModal').find('.modal-body #typical_name').val(typicalName);
            $('#exampleModal').find('.modal-body #profession_name').val(professionName);
            $('#exampleModal').find('.modal-body #message-text').val(description);
            $('#exampleModal').find('.modal-body img').attr('src', icon);
            $('#exampleModal').find('.modal-body form').attr('action', "{{ url('admin/speciality') }}/" + id);
            $('#exampleModal').find('.modal-body form').append('<input type="hidden" name="_method" value="PUT">');

        });
    </script>
@endsection
