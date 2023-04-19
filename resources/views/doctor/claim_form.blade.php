@extends('layouts.front')
@section('title')
    Doctorkhuji || Doctor Profile
@endsection
@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-success alert-block">
            <ul>
                @foreach ($errors->all() as $error)
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <!-- Breadcrumb -->
    <div class="breadcrumb-bar">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-12 col-12">
                    <nav aria-label="breadcrumb" class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index-2.html">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $doctor->name }}'s Profile</li>
                            <li class="breadcrumb-item active" aria-current="page">Claim {{ $doctor->name }}'s Profile
                            </li>
                        </ol>
                    </nav>
                    <h2 class="breadcrumb-title">Claim {{ $doctor->name }}'s Profile</h2>
                </div>
            </div>
        </div>
    </div>
    <!-- /Breadcrumb -->
    <!-- Page Content -->
    <div class="content">
        <div class="container">
            <!-- Doctor Widget -->
            <div class="card">
                <div class="card-body">
                    <div class="block">
                        <p>
                            You are attempting to claim the Justia Lawyer Directory profile of <strong>George
                                Marek</strong>.
                        </p>
                        <p>
                            Successfully claiming this profile activates your membership in Justia Connect, a program
                            designed for legal
                            professionals, and allows you to leverage all of the benefits of your presence in the Justia
                            Lawyer Directory.
                            Best of all, it’s free!
                        </p>
                        <p>
                            First, we need to verify your identity. Depending on the contact information associated with
                            this lawyer
                            profile, you may be provided with one or more options for verifying your identity. To start,
                            select a
                            verification process below. We will provide you with detailed instructions as you progress.
                        </p>
                        <p>
                            To claim this profile, you will need to provide us with proof of your identity and status as
                            an
                            attorney. We accept a photo or scanned image of your bar card, law license, letter of good
                            standing, courtroom access card, or documentation from a court addressing you as an attorney
                            of
                            record. You may upload your copy using the form below or send us a copy by either an email
                            or
                            fax at a later time.
                        </p>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-12 col-lg-6 d-flex">
                            <div class="card flex-fill">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">The following forms of proof are acceptable:</h5>
                                </div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">Bar card </li>
                                    <li class="list-group-item">Law license</li>
                                    <li class="list-group-item">Letter of good standing</li>
                                    <li class="list-group-item">Courtroom access card</li>
                                    <li class="list-group-item">Documentation from a court addressing you as the
                                        attorney of
                                        record</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-12 col-md-12 col-lg-6 d-flex">
                            <div class="card flex-fill">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">The following forms of proof are not acceptable:
                                    </h5>
                                </div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">Driver's license
                                    </li>
                                    <li class="list-group-item">Passport</li>
                                    <li class="list-group-item">Photo of yourself </li>
                                    <li class="list-group-item">URL or screenshot of a bar website </li>
                                    <li class="list-group-item">URL, screenshot, logo or banner of your website</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">Basic Inputs</h5>
                                </div>
                                <div class="card-body">
                                    <form action="{{ url('claim-profile/' . $doctor->id) }}" enctype="multipart/form-data"
                                        method="post">
                                        @csrf
                                        <input type="hidden" name="title"
                                            value="{{ $doctor->name . "'s profile claimation" }}">
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">Email</label>
                                            <div class="col-md-10">
                                                <input type="email" name="email" value="" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">Phone Number</label>
                                            <div class="col-md-10">
                                                <input type="text" name="phone_number" value="" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">File Input</label>
                                            <div class="col-md-10">
                                                <input class="form-control" name="file" value="" type="file">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2"></label>
                                            <div class="col-md-10">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" name="agree" value="1">Agree to
                                                        terms
                                                        and
                                                        conditions
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2"></label>
                                            <div class="col-md-10">
                                                <button type="submit" class="btn btn-danger btn-lg">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="block">
                        <p>
                            Each claimed profile on the Justia Lawyer Directory must be associated with the
                            corresponding attorney’s personal law firm email address. All claimed profiles are
                            subject to a moderation period in which the associated Justia Account will be reviewed
                            to ensure that the same corresponds to the attorney’s personal law firm email address.
                            If a claimed profile is not associated with the corresponding attorney’s personal law
                            firm email address, you will receive notification that your access to the profile has
                            been revoked. If your access is revoked, you may always claim the profile using the
                            appropriate account associated with the attorney’s personal law firm email address.
                        </p>
                        <p>
                            Each profile must have unique login credentials. Justia does not create or allow master
                            logins for multiple profiles. If you are a marketing manager or a marketing consultant
                            and wish to create multiple profiles for your firm or client, please <a
                                href="https://lawyers.justia.com/faq#qC4300">click here</a> and follow the
                            instructions.
                        </p>
                        <p>
                            By claiming your profile, you agree to abide by the <a
                                href="https://www.justia.com/terms-of-service/">Justia Terms of Service</a>. You may
                            read more about our <a href="https://www.justia.com/privacy-policy/">privacy policy
                                here</a>.
                        </p>
                    </div>


                </div>
            </div>
        </div>
    </div>
@endsection
