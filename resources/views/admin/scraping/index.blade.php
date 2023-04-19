@extends('layouts.admin')
@section('title')
    Doctorkhuji || Scrap Doctor
@endsection
@section('content')
    <div class="col-md-7 col-lg-8 col-xl-9">
        @if ($message = Session::get('msg'))
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
        <form action="{{ route('scraping.store') }}" enctype="multipart/form-data" method="post">
            @csrf
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Scraping Doctors data from <a href="https://www.doctime.com">Doctime.com</a>
                    </h4>
                    <div class="row form-row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Speciality Number <span class="text-danger">*</span></label>
                                <input type="number" name="specs_number" value="" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mt-3">
                                <button type="submit" class="btn btn-danger btn-sm submit-btn mt-2">Start Scraping</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection('content')
