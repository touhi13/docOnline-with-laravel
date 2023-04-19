@extends('layouts.front')
@section('title')
    Doctorkhuji || Doctor Profile
@endsection
@push('styles')
    {{-- select2 --}}
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/smartwizard@6/dist/css/smart_wizard_all.min.css" rel="stylesheet"
        type="text/css" />
    <style>
        .custom-card-for-doctor-data {
            border: 1px solid #e4e9ed;
            min-height: 20rem;
            overflow: hidden;
            padding: 2rem;
            width: 100%;
        }

        .drop-container {
            position: relative;
            display: flex;
            gap: 10px;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 200px;
            padding: 20px;
            border-radius: 10px;
            border: 2px dashed #555;
            color: #444;
            cursor: pointer;
            transition: background .2s ease-in-out, border .2s ease-in-out;
        }

        .drop-container:hover {
            background: #eee;
            border-color: #111;
        }

        .drop-container:hover .drop-title {
            color: #222;
        }

        .drop-title {
            color: #444;
            font-size: 20px;
            font-weight: bold;
            text-align: center;
            transition: color .2s ease-in-out;
        }

        input[type=file] {
            width: 350px;
            max-width: 100%;
            color: #444;
            padding: 5px;
            background: #fff;
            border-radius: 10px;
            border: 1px solid #555;
        }

        input[type=file]::file-selector-button {
            margin-right: 20px;
            border: none;
            background: #084cdf;
            padding: 10px 20px;
            border-radius: 10px;
            color: #fff;
            cursor: pointer;
            transition: background .2s ease-in-out;
        }

        input[type=file]::file-selector-button:hover {
            background: #0d45a5;
        }
    </style>
    <!-- Bootstrap CSS -->
@endpush
@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
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
                            <li class="breadcrumb-item active" aria-current="page">Doctor Profile</li>
                        </ol>
                    </nav>
                    <h2 class="breadcrumb-title">Doctor Profile</h2>
                </div>
            </div>
        </div>
    </div>
    <!-- /Breadcrumb -->

    <!-- Page Content -->
    <div class="content">
        <div class="container-fluid px-1 py-5 mx-auto">
            {{-- <div class="row d-flex justify-content-center text-center">

                <div class="col-lg-9 col-md-10"> --}}
            <!-- SmartWizard html -->
            <div id="smartwizard" class="mx-5" style="height: 100%;" dir="rtl-">
                <ul class="nav nav-progress">
                    <li class="nav-item">
                        <a class="nav-link" href="#step-1">
                            <div class="num">1</div>
                            Educational Qualification
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#step-2">
                            <span class="num">2</span>
                            Speciality
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#step-3">
                            <span class="num">3</span>
                            Experience
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#step-4">
                            <span class="num">4</span>
                            Schedule
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#step-5">
                            <span class="num">5</span>
                            Fees
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#step-6">
                            <span class="num">6</span>
                            Confirm Identity
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#step-7">
                            <span class="num">7</span>
                            Upload your profile picture
                        </a>
                    </li>
                </ul>

                <div class="tab-content">
                    <div id="step-1" class="tab-pane" role="tabpanel" aria-labelledby="step-1">
                        <div class="row mx-4" id="qualification">
                            <div class="col-6 mb-4">
                                <div class="custom-card-for-doctor-data text-center">
                                    <p id="qualificationMsg">Currently no data exist!
                                        Please click on the following button
                                        to add your academic qualification.</p>
                                    <button type="button" class="btn btn-secondary" data-toggle="modal"
                                        data-target="#exampleModalCenter" id=qalificationBtn>
                                        Add Qualification Information
                                    </button>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div id="step-2" class="tab-pane" role="tabpanel" aria-labelledby="step-2">
                        <div class="row mx-4" id="expertise">
                            <div class="col-12 mb-4">
                                <div class="custom-card-for-doctor-data text-center">
                                    <p>Currently no data exist! Please click on the
                                        following button to add your area of expertise.</p>
                                    <form id="form-2" class="row row-cols-1 ms-5 me-5 needs-validation" novalidate>
                                        <select name="specialiy" id="specialiy" multiple="multiple" required="">
                                            @foreach ($specialities as $key => $value)
                                                <option value={{ $key }}>{{ $value }}</option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">
                                            Please enter your shipping address.
                                        </div>
                                    </form>

                                </div>
                            </div>

                        </div>
                    </div>
                    <div id="step-3" class="tab-pane" role="tabpanel" aria-labelledby="step-3">
                        <div class="row mx-4" id="experience">
                            <div class="col-6 mb-4">
                                <div class="custom-card-for-doctor-data text-center">
                                    <p>Currently no data exist!
                                        Please click on the following button
                                        to add your academic qualification.</p>
                                    <button type="button" class="btn btn-secondary" data-toggle="modal"
                                        data-target="#experienceModalCenter">
                                        Add Qualification Information
                                    </button>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div id="step-4" class="tab-pane" role="tabpanel" aria-labelledby="step-4">
                        <div class="row mx-4">
                            <div class="col-12 mb-4">
                                <!-- Schedule Header -->
                                <div class="schedule-header">
                                    <!-- Schedule Nav -->
                                    <div class="schedule-nav">
                                        <ul class="nav nav-tabs nav-justified">
                                            @foreach (config('app.weekdays') as $key => $value)
                                                <li class="nav-item">
                                                    <a class="nav-link {{ $value === date('l') ? 'active' : '' }}"
                                                        data-toggle="tab"
                                                        href="#slot_{{ $key }}">{{ $value }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                <div class="tab-content schedule-cont">
                                    @foreach (config('app.weekdays') as $key => $value)
                                        <div id="slot_{{ $key }}"
                                            class="tab-pane fade {{ $value === date('l') ? 'active show' : '' }}">
                                            <h4 class="card-title d-flex justify-content-between">
                                                <span>Time Slots</span>
                                                <a class="edit-link" data-toggle="modal" href="#add_time_slot"
                                                    data-target="#add_time_slot" data-weekday="{{ $value }}">
                                                    <i class="fa fa-plus-circle"></i> Update Slot</a>
                                            </h4>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="step-5" class="tab-pane" role="tabpanel" aria-labelledby="step-5">
                        <div class="row mx-4" id="fee">
                            <div class="col-12 mb-4">
                                <form id="form-5" class="needs-validation" novalidate>
                                    <div class="form-group">
                                        <label>Regular Fee</label>
                                        <input type="text" id="first_consultation_fee" class="form-control"
                                            required="">
                                        <div class="invalid-feedback">
                                            Please enter your shipping address.
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Follow Up Fee</label>
                                        <input type="text" id="follow_up_fee" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Discount</label>
                                        <input type="text" id="discount" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Discount Start Date</label>
                                        <input type="date" id="discount_start_date" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Discount End Date</label>
                                        <input type="date" id="discount_end_date" class="form-control">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div id="step-6" class="tab-pane" role="tabpanel" aria-labelledby="step-6">
                        <div class="row mx-4" id="identity">
                            <div class="col-12 mb-4">
                                <p>
                                    We need your national ID/Passport to verify your identity. We're aiming to protect our
                                    authorised doctors and patients to make sure no un-authorised person is registering as
                                    doctor. Your ID will be stored securely and will not be visible to anyone.
                                </p>
                                <form id="form-6" class="needs-validation" novalidate>
                                    <label for="images" class="drop-container">
                                        <span class="drop-title">Drop files here</span>
                                        or
                                        <input type="file" id="images" accept="image/*" required="">
                                    </label>
                                </form>

                            </div>
                        </div>
                    </div>
                    <div id="step-7" class="tab-pane" role="tabpanel" aria-labelledby="step-7">
                        <div class="row mx-4" id="profile_photo">
                            <div class="col-12 mb-4">
                                <div class="d-flex align-items-center justify-content-center">
                                    <div class="avatar avatar-xxl">
                                        <img src={{ asset('images/doc.avif') }} class="avatar-img rounded-circle"
                                            alt="">
                                    </div>
                                </div>
                                <form id="form-7" class="needs-validation" novalidate>
                                    <label for="images" class="drop-container">
                                        <span class="drop-title">Drop files here</span>
                                        or
                                        <input type="file" id="images" accept="image/*" required="">
                                    </label>
                                </form>
                                <p>
                                    This will be visible to patients.
                                </p>
                                <p>
                                    Example of a good profile picture:

                                </p>
                                <ul>
                                    <li>
                                        Face is clearly visible
                                    </li>
                                    <li>
                                        Smiling,wearing apron and stethoscope
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25"
                        aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>


            <br /> &nbsp;
            {{-- </div>


            </div> --}}
        </div>
    </div>
    </div>
    <!-- /Page Content -->
    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Add new</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form-1">

                        <div class="form-group">
                            <label>Degree</label>
                            <select name="degree" id="degree" class="form-control">
                                <option hidden value="">choose One</option>
                                <option value="MBBS">
                                    MBBS
                                </option>
                                <option value="BDS">
                                    BDS
                                </option>
                                <option value="BMBS">
                                    BMBS
                                </option>
                                <option value="MBChB">
                                    MBChB
                                </option>
                                <option value="MBBCh">
                                    MBBCh
                                </option>
                                <option value="MD">
                                    MD
                                </option>
                                <option value="Dr.MuD">
                                    Dr.MuD
                                </option>
                                <option value="Dr.Med">
                                    Dr.Med
                                </option>
                                <option value="DO">
                                    DO
                                </option>
                                <option value="MCM">
                                    MCM
                                </option>
                                <option value="MMSc">
                                    MMSc
                                </option>
                                <option value="MMedSc">
                                    MMedSc
                                </option>
                                <option value="MM">
                                    MM
                                </option>
                                <option value="MMed">
                                    MMed
                                </option>
                                <option value="MPhil">
                                    MPhil
                                </option>
                                <option value="MS">
                                    MS
                                </option>
                                <option value="MSurg">
                                    MSurg
                                </option>
                                <option value="MMSc">
                                    MMSc
                                </option>
                                <option value="MChir">
                                    MChir
                                </option>
                                <option value="MCh">
                                    MCh
                                </option>
                                <option value="ChM">
                                    ChM
                                </option>
                                <option value="MSc">
                                    MSc
                                </option>
                                <option value="DCM">
                                    DCM
                                </option>
                                <option value="DClinSurg">
                                    DClinSurg
                                </option>
                                <option value="DMSc">
                                    DMSc
                                </option>
                                <option value="DMedSc">
                                    DMedSc
                                </option>
                                <option value="DS">
                                    DS
                                </option>
                                <option value="DSurg">
                                    DSurg
                                </option>
                                <option value="DA">
                                    DA
                                </option>
                                <option value="DLO">
                                    DLO
                                </option>
                                <option value="DEM">
                                    DEM
                                </option>
                                <option value="DCH">
                                    DCH
                                </option>
                                <option value="DTCD">
                                    DTCD
                                </option>
                                <option value="MRCP">
                                    MRCP
                                </option>
                                <option value="MRCS">
                                    MRCS
                                </option>
                                <option value="FRCP">
                                    FRCP
                                </option>
                                <option value="FRCS">
                                    FRCS
                                </option>
                                <option value="MRCOG">
                                    MRCOG
                                </option>
                                <option value="MRCPCH">
                                    MRCPCH
                                </option>
                                <option value="MCPS">
                                    MCPS
                                </option>
                                <option value="MPH">
                                    MPH
                                </option>
                                <option value="Phd">
                                    Phd
                                </option>
                                <option value="FCPS">
                                    FCPS
                                </option>
                                <option value="Diploma">
                                    Diploma
                                </option>
                                <option value="PGT">
                                    PGT
                                </option>
                                <option value="CCD">
                                    CCD
                                </option>
                                <option value="BSc">
                                    BSc
                                </option>
                                <option value="DDV">
                                    DDV
                                </option>
                                <option value="BCS(Health)">
                                    BCS(Health)
                                </option>
                                <option value="DCO">
                                    DCO
                                </option>
                            </select>
                            <p id="degreeError" class="text-danger"></p>
                        </div>
                        <div class="form-group">
                            <label>Speciality</label>
                            <select name="speciality" id="speciality" class="form-control">
                                <option hidden value="">Choose One</option>
                                @foreach ($specialities as $speciality)
                                    <option value={{ $speciality }}>{{ $speciality }}</option>
                                @endforeach
                            </select>
                            <p id="specialityError" class="text-danger"></p>
                        </div>
                        <div class="form-group">
                            <label>Institute Name</label>
                            <input type="text" name="institute_name" id="institute_name" class="form-control"
                                placeholder="Institute Name">
                            <p id="instituteNameError" class="text-danger"></p>
                        </div>
                        <div class="form-group">
                            <label>Institute Location</label>
                            <select name="institute_location" id="institute_location" class="form-control">
                                <option hidden value="">Choose One</option>
                                <option value="AFG">
                                    AFG
                                </option>
                                <option value="ALBANIA">
                                    ALBANIA
                                </option>
                                <option value="ALGERIA">
                                    ALGERIA
                                </option>
                                <option value="AMERICAN SAMOA">
                                    AMERICAN SAMOA
                                </option>
                                <option value="ANDORRA">
                                    ANDORRA
                                </option>
                                <option value="ANGOLA">
                                    ANGOLA
                                </option>
                                <option value="ANGUILLA">
                                    ANGUILLA
                                </option>
                                <option value="ANTARCTICA">
                                    ANTARCTICA
                                </option>
                                <option value="ANTIGUA AND BARBUDA">
                                    ANTIGUA AND BARBUDA
                                </option>
                                <option value="ARG">
                                    ARG
                                </option>
                                <option value="ARMENIA">
                                    ARMENIA
                                </option>
                                <option value="ARUBA">
                                    ARUBA
                                </option>
                                <option value="AUS">
                                    AUS
                                </option>
                                <option value="AUSTRIA">
                                    AUSTRIA
                                </option>
                                <option value="AZERBAIJAN">
                                    AZERBAIJAN
                                </option>
                                <option value="BAHAMAS">
                                    BAHAMAS
                                </option>
                                <option value="BAHRAIN">
                                    BAHRAIN
                                </option>
                                <option value="BD">
                                    BD
                                </option>
                                <option value="BARBADOS">
                                    BARBADOS
                                </option>
                                <option value="BELARUS">
                                    BELARUS
                                </option>
                                <option value="BELGIUM">
                                    BELGIUM
                                </option>
                                <option value="BELIZE">
                                    BELIZE
                                </option>
                                <option value="BENIN">
                                    BENIN
                                </option>
                                <option value="BERMUDA">
                                    BERMUDA
                                </option>
                                <option value="BHUTAN">
                                    BHUTAN
                                </option>
                                <option value="BOLIVIA">
                                    BOLIVIA
                                </option>
                                <option value="BOSNIA AND HERZEGOVINA">
                                    BOSNIA AND HERZEGOVINA
                                </option>
                                <option value="BOTSWANA">
                                    BOTSWANA
                                </option>
                                <option value="BOUVET ISLAND">
                                    BOUVET ISLAND
                                </option>
                                <option value="BRAZIL">
                                    BRAZIL
                                </option>
                                <option value="BRITISH INDIAN OCEAN TERRITORY">
                                    BRITISH INDIAN OCEAN TERRITORY
                                </option>
                                <option value="BRUNEI DARUSSALAM">
                                    BRUNEI DARUSSALAM
                                </option>
                                <option value="BULGARIA">
                                    BULGARIA
                                </option>
                                <option value="BURKINA FASO">
                                    BURKINA FASO
                                </option>
                                <option value="BURUNDI">
                                    BURUNDI
                                </option>
                                <option value="CAMBODIA">
                                    CAMBODIA
                                </option>
                                <option value="CAMEROON">
                                    CAMEROON
                                </option>
                                <option value="CANADA">
                                    CANADA
                                </option>
                                <option value="CAPE VERDE">
                                    CAPE VERDE
                                </option>
                                <option value="CAYMAN ISLANDS">
                                    CAYMAN ISLANDS
                                </option>
                                <option value="CENTRAL AFRICAN REPUBLIC">
                                    CENTRAL AFRICAN REPUBLIC
                                </option>
                                <option value="CHAD">
                                    CHAD
                                </option>
                                <option value="CHILE">
                                    CHILE
                                </option>
                                <option value="CHINA">
                                    CHINA
                                </option>
                                <option value="CHRISTMAS ISLAND">
                                    CHRISTMAS ISLAND
                                </option>
                                <option value="COCOS (KEELING) ISLANDS">
                                    COCOS (KEELING) ISLANDS
                                </option>
                                <option value="COLOMBIA">
                                    COLOMBIA
                                </option>
                                <option value="COMOROS">
                                    COMOROS
                                </option>
                                <option value="CONGO">
                                    CONGO
                                </option>
                                <option value="CONGO, THE DEMOCRATIC REPUBLIC OF THE">
                                    CONGO, THE DEMOCRATIC REPUBLIC OF THE
                                </option>
                                <option value="COOK ISLANDS">
                                    COOK ISLANDS
                                </option>
                                <option value="COSTA RICA">
                                    COSTA RICA
                                </option>
                                <option value="COTE DIVOIRE">
                                    COTE DIVOIRE
                                </option>
                                <option value="CROATIA">
                                    CROATIA
                                </option>
                                <option value="CUBA">
                                    CUBA
                                </option>
                                <option value="CYPRUS">
                                    CYPRUS
                                </option>
                                <option value="CZECH REPUBLIC">
                                    CZECH REPUBLIC
                                </option>
                                <option value="DENMARK">
                                    DENMARK
                                </option>
                                <option value="DJIBOUTI">
                                    DJIBOUTI
                                </option>
                                <option value="DOMINICA">
                                    DOMINICA
                                </option>
                                <option value="DOMINICAN REPUBLIC">
                                    DOMINICAN REPUBLIC
                                </option>
                                <option value="ECUADOR">
                                    ECUADOR
                                </option>
                                <option value="EGYPT">
                                    EGYPT
                                </option>
                                <option value="EL SALVADOR">
                                    EL SALVADOR
                                </option>
                                <option value="EQUATORIAL GUINEA">
                                    EQUATORIAL GUINEA
                                </option>
                                <option value="ERITREA">
                                    ERITREA
                                </option>
                                <option value="ESTONIA">
                                    ESTONIA
                                </option>
                                <option value="ETHIOPIA">
                                    ETHIOPIA
                                </option>
                                <option value="FALKLAND ISLANDS (MALVINAS)">
                                    FALKLAND ISLANDS (MALVINAS)
                                </option>
                                <option value="FAROE ISLANDS">
                                    FAROE ISLANDS
                                </option>
                                <option value="FIJI">
                                    FIJI
                                </option>
                                <option value="FINLAND">
                                    FINLAND
                                </option>
                                <option value="FRANCE">
                                    FRANCE
                                </option>
                                <option value="FRENCH GUIANA">
                                    FRENCH GUIANA
                                </option>
                                <option value="FRENCH POLYNESIA">
                                    FRENCH POLYNESIA
                                </option>
                                <option value="FRENCH SOUTHERN TERRITORIES">
                                    FRENCH SOUTHERN TERRITORIES
                                </option>
                                <option value="GABON">
                                    GABON
                                </option>
                                <option value="GAMBIA">
                                    GAMBIA
                                </option>
                                <option value="GEORGIA">
                                    GEORGIA
                                </option>
                                <option value="GERMANY">
                                    GERMANY
                                </option>
                                <option value="GHANA">
                                    GHANA
                                </option>
                                <option value="GIBRALTAR">
                                    GIBRALTAR
                                </option>
                                <option value="GREECE">
                                    GREECE
                                </option>
                                <option value="GREENLAND">
                                    GREENLAND
                                </option>
                                <option value="GRENADA">
                                    GRENADA
                                </option>
                                <option value="GUADELOUPE">
                                    GUADELOUPE
                                </option>
                                <option value="GUAM">
                                    GUAM
                                </option>
                                <option value="GUATEMALA">
                                    GUATEMALA
                                </option>
                                <option value="GUINEA">
                                    GUINEA
                                </option>
                                <option value="GUINEA-BISSAU">
                                    GUINEA-BISSAU
                                </option>
                                <option value="GUYANA">
                                    GUYANA
                                </option>
                                <option value="HAITI">
                                    HAITI
                                </option>
                                <option value="HEARD ISLAND AND MCDONALD ISLANDS">
                                    HEARD ISLAND AND MCDONALD ISLANDS
                                </option>
                                <option value="HOLY SEE (VATICAN CITY STATE)">
                                    HOLY SEE (VATICAN CITY STATE)
                                </option>
                                <option value="HONDURAS">
                                    HONDURAS
                                </option>
                                <option value="HONG KONG">
                                    HONG KONG
                                </option>
                                <option value="HUNGARY">
                                    HUNGARY
                                </option>
                                <option value="ICELAND">
                                    ICELAND
                                </option>
                                <option value="INDIA">
                                    INDIA
                                </option>
                                <option value="INDONESIA">
                                    INDONESIA
                                </option>
                                <option value="IRAN, ISLAMIC REPUBLIC OF">
                                    IRAN, ISLAMIC REPUBLIC OF
                                </option>
                                <option value="IRAQ">
                                    IRAQ
                                </option>
                                <option value="IRELAND">
                                    IRELAND
                                </option>
                                <option value="ISRAEL">
                                    ISRAEL
                                </option>
                                <option value="ITALY">
                                    ITALY
                                </option>
                                <option value="JAMAICA">
                                    JAMAICA
                                </option>
                                <option value="JAPAN">
                                    JAPAN
                                </option>
                                <option value="JORDAN">
                                    JORDAN
                                </option>
                                <option value="KAZAKHSTAN">
                                    KAZAKHSTAN
                                </option>
                                <option value="KENYA">
                                    KENYA
                                </option>
                                <option value="KIRIBATI">
                                    KIRIBATI
                                </option>
                                <option value="KOREA, DEMOCRATIC PEOPLE`S REPUBLIC OF">
                                    KOREA, DEMOCRATIC PEOPLE`S REPUBLIC OF
                                </option>
                                <option value="KOREA, REPUBLIC OF">
                                    KOREA, REPUBLIC OF
                                </option>
                                <option value="KUWAIT">
                                    KUWAIT
                                </option>
                                <option value="KYRGYZSTAN">
                                    KYRGYZSTAN
                                </option>
                                <option value="LAOS PEOPLE`S DEMOCRATIC REPUBLIC">
                                    LAOS PEOPLE`S DEMOCRATIC REPUBLIC
                                </option>
                                <option value="LATVIA">
                                    LATVIA
                                </option>
                                <option value="LEBANON">
                                    LEBANON
                                </option>
                                <option value="LESOTHO">
                                    LESOTHO
                                </option>
                                <option value="LIBERIA">
                                    LIBERIA
                                </option>
                                <option value="LIBYAN ARAB JAMAHIRIYA">
                                    LIBYAN ARAB JAMAHIRIYA
                                </option>
                                <option value="LIECHTENSTEIN">
                                    LIECHTENSTEIN
                                </option>
                                <option value="LITHUANIA">
                                    LITHUANIA
                                </option>
                                <option value="LUXEMBOURG">
                                    LUXEMBOURG
                                </option>
                                <option value="MACAO">
                                    MACAO
                                </option>
                                <option value="MACEDONIA, THE FORMER YUGOSLAV REPUBLIC OF">
                                    MACEDONIA, THE FORMER YUGOSLAV REPUBLIC OF
                                </option>
                                <option value="MADAGASCAR">
                                    MADAGASCAR
                                </option>
                                <option value="MALAWI">
                                    MALAWI
                                </option>
                                <option value="MALAYSIA">
                                    MALAYSIA
                                </option>
                                <option value="MALDIVES">
                                    MALDIVES
                                </option>
                                <option value="MALI">
                                    MALI
                                </option>
                                <option value="MALTA">
                                    MALTA
                                </option>
                                <option value="MARSHALL ISLANDS">
                                    MARSHALL ISLANDS
                                </option>
                                <option value="MARTINIQUE">
                                    MARTINIQUE
                                </option>
                                <option value="MAURITANIA">
                                    MAURITANIA
                                </option>
                                <option value="MAURITIUS">
                                    MAURITIUS
                                </option>
                                <option value="MAYOTTE">
                                    MAYOTTE
                                </option>
                                <option value="MEXICO">
                                    MEXICO
                                </option>
                                <option value="MICRONESIA, FEDERATED STATES OF">
                                    MICRONESIA, FEDERATED STATES OF
                                </option>
                                <option value="MOLDOVA, REPUBLIC OF">
                                    MOLDOVA, REPUBLIC OF
                                </option>
                                <option value="MONACO">
                                    MONACO
                                </option>
                                <option value="MONGOLIA">
                                    MONGOLIA
                                </option>
                                <option value="MONTSERRAT">
                                    MONTSERRAT
                                </option>
                                <option value="MOROCCO">
                                    MOROCCO
                                </option>
                                <option value="MOZAMBIQUE">
                                    MOZAMBIQUE
                                </option>
                                <option value="MYANMAR">
                                    MYANMAR
                                </option>
                                <option value="NAMIBIA">
                                    NAMIBIA
                                </option>
                                <option value="NAURU">
                                    NAURU
                                </option>
                                <option value="NEPAL">
                                    NEPAL
                                </option>
                                <option value="NETHERLANDS">
                                    NETHERLANDS
                                </option>
                                <option value="NETHERLANDS ANTILLES">
                                    NETHERLANDS ANTILLES
                                </option>
                                <option value="NEW CALEDONIA">
                                    NEW CALEDONIA
                                </option>
                                <option value="NEW ZEALAND">
                                    NEW ZEALAND
                                </option>
                                <option value="NICARAGUA">
                                    NICARAGUA
                                </option>
                                <option value="NIGER">
                                    NIGER
                                </option>
                                <option value="NIGERIA">
                                    NIGERIA
                                </option>
                                <option value="NIUE">
                                    NIUE
                                </option>
                                <option value="NORFOLK ISLAND">
                                    NORFOLK ISLAND
                                </option>
                                <option value="NORTHERN MARIANA ISLANDS">
                                    NORTHERN MARIANA ISLANDS
                                </option>
                                <option value="NORWAY">
                                    NORWAY
                                </option>
                                <option value="OMAN">
                                    OMAN
                                </option>
                                <option value="PK">
                                    PK
                                </option>
                                <option value="PALAU">
                                    PALAU
                                </option>
                                <option value="PALESTINIAN TERRITORY, OCCUPIED">
                                    PALESTINIAN TERRITORY, OCCUPIED
                                </option>
                                <option value="PANAMA">
                                    PANAMA
                                </option>
                                <option value="PAPUA new GUINEA">
                                    PAPUA new GUINEA
                                </option>
                                <option value="PARAGUAY">
                                    PARAGUAY
                                </option>
                                <option value="PERU">
                                    PERU
                                </option>
                                <option value="PHILIPPINES">
                                    PHILIPPINES
                                </option>
                                <option value="PITCAIRN">
                                    PITCAIRN
                                </option>
                                <option value="POLAND">
                                    POLAND
                                </option>
                                <option value="PORTUGAL">
                                    PORTUGAL
                                </option>
                                <option value="PUERTO RICO">
                                    PUERTO RICO
                                </option>
                                <option value="QATAR">
                                    QATAR
                                </option>
                                <option value="REUNION">
                                    REUNION
                                </option>
                                <option value="ROMANIA">
                                    ROMANIA
                                </option>
                                <option value="RUSSIAN FEDERATION">
                                    RUSSIAN FEDERATION
                                </option>
                                <option value="RWANDA">
                                    RWANDA
                                </option>
                                <option value="SAINT HELENA">
                                    SAINT HELENA
                                </option>
                                <option value="SAINT KITTS and NEVIS">
                                    SAINT KITTS and NEVIS
                                </option>
                                <option value="SAINT LUCIA">
                                    SAINT LUCIA
                                </option>
                                <option value="SAINT PIERRE and MIQUELON">
                                    SAINT PIERRE and MIQUELON
                                </option>
                                <option value="SAINT VINCENT and THE GRENADINES">
                                    SAINT VINCENT and THE GRENADINES
                                </option>
                                <option value="SAMOA">
                                    SAMOA
                                </option>
                                <option value="SAN MARINO">
                                    SAN MARINO
                                </option>
                                <option value="SAO TOME and PRINCIPE">
                                    SAO TOME and PRINCIPE
                                </option>
                                <option value="SAUDI ARABIA">
                                    SAUDI ARABIA
                                </option>
                                <option value="SENEGAL">
                                    SENEGAL
                                </option>
                                <option value="SERBIA and MONTENEGRO">
                                    SERBIA and MONTENEGRO
                                </option>
                                <option value="SEYCHELLES">
                                    SEYCHELLES
                                </option>
                                <option value="SIERRA LEONE">
                                    SIERRA LEONE
                                </option>
                                <option value="SINGAPORE">
                                    SINGAPORE
                                </option>
                                <option value="SLOVAKIA">
                                    SLOVAKIA
                                </option>
                                <option value="SLOVENIA">
                                    SLOVENIA
                                </option>
                                <option value="SOLOMON ISLANDS">
                                    SOLOMON ISLANDS
                                </option>
                                <option value="SOMALIA">
                                    SOMALIA
                                </option>
                                <option value="SOUTH AFRICA">
                                    SOUTH AFRICA
                                </option>
                                <option value="SOUTH GEORGIA and THE SOUTH SANDWICH ISLANDS">
                                    SOUTH GEORGIA and THE SOUTH SANDWICH ISLANDS
                                </option>
                                <option value="SPAIN">
                                    SPAIN
                                </option>
                                <option value="SRI LANKA">
                                    SRI LANKA
                                </option>
                                <option value="SUDAN">
                                    SUDAN
                                </option>
                                <option value="SURINAME">
                                    SURINAME
                                </option>
                                <option value="SVALBARD and JAN MAYEN">
                                    SVALBARD and JAN MAYEN
                                </option>
                                <option value="SWAZILAND">
                                    SWAZILAND
                                </option>
                                <option value="SWEDEN">
                                    SWEDEN
                                </option>
                                <option value="SWITZERLAND">
                                    SWITZERLAND
                                </option>
                                <option value="SYRIAN ARAB REPUBLIC">
                                    SYRIAN ARAB REPUBLIC
                                </option>
                                <option value="TAIWAN, PROVINCE OF CHINA">
                                    TAIWAN, PROVINCE OF CHINA
                                </option>
                                <option value="TAJIKISTAN">
                                    TAJIKISTAN
                                </option>
                                <option value="UNITED REPUBLIC OF TANZANIA">
                                    UNITED REPUBLIC OF TANZANIA
                                </option>
                                <option value="THAILAND">
                                    THAILAND
                                </option>
                                <option value="TIMOR - LESTE">
                                    TIMOR - LESTE
                                </option>
                                <option value="TOGO">
                                    TOGO
                                </option>
                                <option value="TOKELAU">
                                    TOKELAU
                                </option>
                                <option value="TONGA">
                                    TONGA
                                </option>
                                <option value="TRINIDAD and TOBAGO">
                                    TRINIDAD and TOBAGO
                                </option>
                                <option value="TUNISIA">
                                    TUNISIA
                                </option>
                                <option value="TURKEY">
                                    TURKEY
                                </option>
                                <option value="TURKMENISTAN">
                                    TURKMENISTAN
                                </option>
                                <option value="TURKS and CAICOS ISLANDS">
                                    TURKS and CAICOS ISLANDS
                                </option>
                                <option value="TUVALU">
                                    TUVALU
                                </option>
                                <option value="UGANDA">
                                    UGANDA
                                </option>
                                <option value="UKRAINE">
                                    UKRAINE
                                </option>
                                <option value="UNITED ARAB EMIRATES">
                                    UNITED ARAB EMIRATES
                                </option>
                                <option value="UK">
                                    UK
                                </option>
                                <option value="US">
                                    US
                                </option>
                                <option value="UNITED STATES MINOR OUTLYING ISLANDS">
                                    UNITED STATES MINOR OUTLYING ISLANDS
                                </option>
                                <option value="URUGUAY">
                                    URUGUAY
                                </option>
                                <option value="UZBEKISTAN">
                                    UZBEKISTAN
                                </option>
                                <option value="VANUATU">
                                    VANUATU
                                </option>
                                <option value="VENEZUELA">
                                    VENEZUELA
                                </option>
                                <option value="VIET NAM">
                                    VIET NAM
                                </option>
                                <option value="VIRGIN ISLANDS, BRITISH">
                                    VIRGIN ISLANDS, BRITISH
                                </option>
                                <option value="VIRGIN ISLANDS, U . S . ">
                                    VIRGIN ISLANDS, U . S .
                                </option>
                                <option value="WALLIS and FUTUNA">
                                    WALLIS and FUTUNA
                                </option>
                                <option value="WESTERN SAHARA">
                                    WESTERN SAHARA
                                </option>
                                <option value="YEMEN">
                                    YEMEN
                                </option>
                                <option value="ZAMBIA">
                                    ZAMBIA
                                </option>
                                <option value="ZIMBABWE">
                                    ZIMBABWE
                                </option>
                                <option value="SERBIA">
                                    SERBIA
                                </option>
                                <option value="ASIA PACIFIC REGION">
                                    ASIA PACIFIC REGION
                                </option>
                                <option value="MONTENEGRO">
                                    MONTENEGRO
                                </option>
                                <option value="ALAND ISLANDS">
                                    ALAND ISLANDS
                                </option>
                                <option value="BONAIRE, SINT EUSTATIUS and SABA">
                                    BONAIRE, SINT EUSTATIUS and SABA
                                </option>
                                <option value="CURACAO">
                                    CURACAO
                                </option>
                                <option value="GUERNSEY">
                                    GUERNSEY
                                </option>
                                <option value="ISLE OF MAN">
                                    ISLE OF MAN
                                </option>
                                <option value="JERSEY">
                                    JERSEY
                                </option>
                                <option value="KOSOVO">
                                    KOSOVO
                                </option>
                                <option value="SAINT BARTHELEMY">
                                    SAINT BARTHELEMY
                                </option>
                                <option value="SAINT MARTIN">
                                    SAINT MARTIN
                                </option>
                                <option value="SINT MAARTEN">
                                    SINT MAARTEN
                                </option>
                                <option value="SOUTH SUDAN">
                                    SOUTH SUDAN
                                </option>
                            </select>
                            <p id="instituteLocationError" class="text-danger"></p>
                        </div>
                        <div class="form-group">
                            <label>Passing Year</label>
                            <select name="passing_year" id="passing_year" class="form-control">
                                <option hidden value="">Choose One</option>
                                @php
                                    $start_year = 1967; // set the start year
                                    $current_year = date('Y'); // get the current year
                                @endphp
                                @for ($year = $current_year; $year >= $start_year; $year--)
                                    <option value="{{ $year }}">{{ $year }}</option>
                                @endfor
                            </select>
                            <p id="passingYearError" class="text-danger"></p>
                        </div>
                        <div class="form-group">
                            <label>Duration</label>
                            <select name="duration" id="duration" class="form-control">
                                <option hidden value="">Choose One</option>
                                <option value="1">
                                    1 year
                                </option>
                                <option value="2">
                                    2 years
                                </option>
                                <option value="3">
                                    3 years
                                </option>
                                <option value="4">
                                    4 years
                                </option>
                                <option value="5">
                                    5 years
                                </option>
                                <option value="6">
                                    6 years
                                </option>
                                <option value="7">
                                    7 years
                                </option>
                                <option value="8">
                                    8 years +
                                </option>
                            </select>
                            <p id="durationError" class="text-danger"></p>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id=save_qualification>Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="experienceModalCenter" tabindex="-1" role="dialog"
        aria-labelledby="experienceModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="experienceModalCenterTitle">Add new</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="experienceForm">
                        <div class="form-group">
                            <label>Hospital</label>
                            <input type="text" name="organization_name" id="organization_name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Designation</label>
                            <input type="text" name="designation" id="designation" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Department</label>
                            <input type="text" name="department" id="department" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="checkbox" name="is_current" id="is_current">
                            <label>Currently Working</label>
                        </div>
                        <div class="form-group">
                            <label>From</label>
                            <input type="date" name="from" id="from" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>To</label>
                            <input type="date" name="to" id="to" class="form-control">
                        </div>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id=save_experience>Save changes</button>
                </div>
            </div>
        </div>
    </div>

    {{-- schedule modal --}}
    <div class="modal fade custom-modal" id="add_time_slot">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Time Slots</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Weekday: <span id="weekday"></span></p>
                    {{-- <form> --}}
                    {{-- <input type="text" name="" id=""> --}}
                    <div class="hours-info">
                        <div class="row form-row hours-cont">
                            <div class="col-12 col-md-10">
                                <div class="row form-row">
                                    <form id="timeSlot">
                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label>Start Time</label>
                                                <input type="time" name="start_time[]" id=""
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label>End Time</label>
                                                <input type="time" name="end_time[]" id=""
                                                    class="form-control">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="add-more mb-3">
                        <a href="javascript:void(0);" class="add-hours"><i class="fa fa-plus-circle"></i> Add
                            More</a>
                    </div>
                    <div class="submit-section text-center">
                        <button type="submit" class="btn btn-primary submit-btn" id="save_schedule">Save
                            Changes</button>
                    </div>
                    {{-- </form> --}}
                </div>
            </div>
        </div>
    </div>
    <!-- Confirm Modal -->
    <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmModalLabel">Order Placed</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Congratulations! Your order is placed.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="closeModal()">Ok, close and
                        reset</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/smartwizard@6/dist/js/jquery.smartWizard.min.js" type="text/javascript">
    </script>
    <script>
        $(document).ready(function() {
            let qualificationData = [];
            let experienceData = [];
            let scheduleData = {};
            const myModal = new bootstrap.Modal(document.getElementById('confirmModal'));

            function onCancel() {
                // Reset wizard
                $('#smartwizard').smartWizard("reset");

                // Reset form
                document.getElementById("form-1").reset();
                document.getElementById("form-2").reset();
                document.getElementById("form-3").reset();
                document.getElementById("form-4").reset();
            }

            function onConfirm() {
                let form = document.getElementById('form-4');
                if (form) {
                    if (!form.checkValidity()) {
                        form.classList.add('was-validated');
                        $('#smartwizard').smartWizard("setState", [3], 'error');
                        $("#smartwizard").smartWizard('fixHeight');
                        return false;
                    }

                    myModal.show();
                }
            }

            function closeModal() {
                // Reset wizard
                $('#smartwizard').smartWizard("reset");

                // Reset form
                document.getElementById("form-1").reset();
                document.getElementById("form-2").reset();
                document.getElementById("form-3").reset();
                document.getElementById("form-4").reset();

                myModal.hide();
            }

            function showConfirm() {
                const name = $('#first-name').val() + ' ' + $('#last-name').val();
                const products = $('#sel-products').val();
                const shipping = $('#address').val() + ' ' + $('#state').val() + ' ' + $('#zip').val();
                let html =
                    `<h4 class="mb-3-">Customer Details</h4>
                    <hr class="my-2">
                    <div class="row g-3 align-items-center">
                      <div class="col-auto">
                        <label class="col-form-label">Name</label>
                      </div>
                      <div class="col-auto">
                        <span class="form-text-">${name}</span>
                      </div>
                    </div>

                    <h4 class="mt-3">Products</h4>
                    <hr class="my-2">
                    <div class="row g-3 align-items-center">
                      <div class="col-auto">
                        <span class="form-text-">${products}</span>
                      </div>
                    </div>

                    <h4 class="mt-3">Shipping</h4>
                    <hr class="my-2">
                    <div class="row g-3 align-items-center">
                      <div class="col-auto">
                        <span class="form-text-">${shipping}</span>
                      </div>
                    </div>`;
                $("#order-details").html(html);
                $('#smartwizard').smartWizard("fixHeight");
            }

            $(function() {
                // Leave step event is used for validating the forms
                $("#smartwizard").on("leaveStep", function(e, anchorObject, currentStepIdx, nextStepIdx,
                    stepDirection) {
                    console.log({
                        anchorObject,
                        currentStepIdx,
                        nextStepIdx,
                        stepDirection
                    })
                    console.log(qualificationData);
                    console.log(qualificationData.length);

                    // Validate only on forward movement  
                    if (stepDirection == 'forward') {
                        if (!qualificationData.length > 0 && nextStepIdx > 0) {
                            // Show a message
                            $("#message").text("Please add at least one item before proceeding.");
                            console.log("hi");
                            // Change the style of the navigation link
                            anchorObject.addClass("error");

                            return false;
                        } else {
                            // Reset the message
                            $("#message").text("");
                            // Reset the style of the navigation link
                            anchorObject.removeClass("error");
                        }
                        if (!Object.keys(experienceData).length > 0 && nextStepIdx > 2) {
                            // Show a message
                            $("#message").text("Please add at least one item before proceeding.");

                            // Change the style of the navigation link
                            anchorObject.addClass("error");
                            return false;

                        } else {
                            // Reset the message
                            $("#message").text("");
                            // Reset the style of the navigation link
                            anchorObject.removeClass("error");
                        }
                        if (!Object.keys(scheduleData).length > 0 && nextStepIdx > 3) {
                            // Show a message
                            $("#message").text("Please add at least one item before proceeding.");

                            // Change the style of the navigation link
                            anchorObject.addClass("error");
                            return false;

                        } else {
                            // Reset the message
                            $("#message").text("");
                            // Reset the style of the navigation link
                            anchorObject.removeClass("error");
                        }
                        let form = document.getElementById('form-' + (currentStepIdx + 1));
                        if (form) {
                            if (!form.checkValidity()) {
                                form.classList.add('was-validated');
                                $('#smartwizard').smartWizard("setState", [currentStepIdx],
                                    'error');
                                $("#smartwizard").smartWizard('fixHeight');
                                return false;
                            }
                            $('#smartwizard').smartWizard("unsetState", [currentStepIdx], 'error');
                        }
                    }
                });

                // Step show event
                $("#smartwizard").on("showStep", function(e, anchorObject, stepIndex, stepDirection,
                    stepPosition) {
                    // console.log({
                    //     anchorObject,
                    //     stepIndex,
                    //     stepDirection,
                    //     stepPosition
                    // })
                    $("#prev-btn").removeClass('disabled').prop('disabled', false);
                    $("#next-btn").removeClass('disabled').prop('disabled', false);
                    if (stepPosition === 'first') {
                        $("#prev-btn").addClass('disabled').prop('disabled', true);
                    } else if (stepPosition === 'last') {
                        $("#next-btn").addClass('disabled').prop('disabled', true);
                    } else {
                        $("#prev-btn").removeClass('disabled').prop('disabled', false);
                        $("#next-btn").removeClass('disabled').prop('disabled', false);
                    }

                    // Get step info from Smart Wizard
                    let stepInfo = $('#smartwizard').smartWizard("getStepInfo");
                    $("#sw-current-step").text(stepInfo.currentStep + 1);
                    $("#sw-total-step").text(stepInfo.totalSteps);

                    if (stepPosition == 'last') {
                        showConfirm();
                        $("#btnFinish").prop('disabled', false);
                    } else {
                        $("#btnFinish").prop('disabled', true);
                    }

                    // Focus first name
                    if (stepIndex == 1) {
                        setTimeout(() => {
                            $('#first-name').focus();
                        }, 0);
                    }
                });

                // Smart Wizard
                $('#smartwizard').smartWizard({
                    selected: 0,
                    // autoAdjustHeight: false,
                    theme: 'arrows', // basic, arrows, square, round, dots
                    transition: {
                        animation: 'none'
                    },
                    toolbar: {
                        showNextButton: true, // show/hide a Next button
                        showPreviousButton: true, // show/hide a Previous button
                        position: 'bottom', // none/ top/ both bottom
                        extraHtml: `<button class="btn btn-success" id="btnFinish" disabled onclick="onConfirm()">Complete Order</button>
                      <button class="btn btn-danger" id="btnCancel" onclick="onCancel()">Cancel</button>`
                    },
                    anchor: {
                        enableNavigation: true, // Enable/Disable anchor navigation 
                        enableNavigationAlways: false, // Activates all anchors clickable always
                        enableDoneState: true, // Add done state on visited steps
                        markPreviousStepsAsDone: true, // When a step selected by url hash, all previous steps are marked done
                        unDoneOnBackNavigation: true, // While navigate back, done state will be cleared
                        enableDoneStateNavigation: true // Enable/Disable the done state navigation
                    },
                });

                $("#state_selector").on("change", function() {
                    $('#smartwizard').smartWizard("setState", [$('#step_to_style').val()], $(this)
                        .val(), !$(
                            '#is_reset').prop("checked"));
                    return true;
                });

                $("#style_selector").on("change", function() {
                    $('#smartwizard').smartWizard("setStyle", [$('#step_to_style').val()], $(this)
                        .val(), !$(
                            '#is_reset').prop("checked"));
                    return true;
                });

            });
            // $("#smartwizard").smartWizard({
            //     // options and settings
            //     onFinish: function() {
            //         // hide next button in last step
            //         $(".sw-btn-next").hide();
            //         console.log("hi");
            //     }
            // });
            function validateField(field, errorMessage) {
                if (!field) {
                    $(errorMessage).text('Please enter ' + field.attr('id').replace('_', ' '));
                    return false;
                } else {
                    $(errorMessage).empty();
                    return true;
                }
            }


            $('#save_qualification').on("click", function() {
                const degree = $('#degree').val();
                const speciality = $('#speciality').val();
                const institute_name = $('#institute_name').val();
                const institute_location = $('#institute_location').val();
                const passing_year = $('#passing_year').val();
                const duration = $('#duration').val();



                // Check if any field is empty and show validation message
                if (!validateField($('#degree'), '#degreeError') ||
                    !validateField($('#speciality'), '#specialityError') ||
                    !validateField($('#institute_name'), '#instituteNameError') ||
                    !validateField($('#institute_location'), '#instituteLocationError') ||
                    !validateField($('#passing_year'), '#passingYearError') ||
                    !validateField($('#duration'), '#durationError')) {
                    return;
                } else {
                    $('#exampleModalCenter').modal('hide');
                }

                qualificationData.push({
                    degree,
                    speciality,
                    institute_name,
                    institute_location,
                    passing_year,
                    duration
                })
                console.log(qualificationData);

                // Determine the appropriate unit of time
                const timeUnit = duration > 1 ? 'years' : 'year';
                const html =
                    `<div class="col-6 mb-4">
                        <div class="custom-card-for-doctor-data">
                            <div class="row">
                                <div class="col-6">
                                    <p class="h3">
                                        ${degree}
                                    </p>
                                </div>
                                <div class="col-6 text-right"><span class="pointer mr-2">
                                        <button>Delete</button>
                                    </span>
                                    <span class="pointer">
                                        <button>Edit</button>
                                    </span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <p class="text-muted">
                                        Speciality
                                    </p>
                                    <p class="mt-n3">
                                        ${speciality}
                                    </p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <p class="text-muted">
                                        Speciality
                                    </p>
                                    <p class="mt-n3">
                                        ${institute_name}
                                    </p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <p class="text-muted">
                                        Speciality
                                    </p>
                                    <p class="mt-n3">
                                        ${institute_location}
                                    </p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <p class="text-muted">
                                        Passing Year
                                    </p>
                                    <p class="mt-n3">
                                        ${passing_year}
                                    </p>
                                </div>
                                <div class="col-6 text-right">
                                    <p class="text-muted">
                                        Duration
                                    </p>
                                    <p class="mt-n3">
                                        ${duration} ${timeUnit}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>`;
                $('#qualification').prepend(html);
                $('#form-1').trigger("reset");
                $('#degreeError').empty();
                $('#specialityError').empty();
                $('#instituteNameError').empty();
                $('#instituteLocationError').empty();
                $('#durationError').empty();
                $('#qualificationMsg').empty();
                $('#qalificationBtn').text("Add More Qualification");

            });
            $('#save_experience').on("click", function() {
                const organization_name = $('#organization_name').val();
                const designation = $('#designation').val();
                const department = $('#department').val();
                const from = $('#from').val();
                const to = $('#to').val();
                const is_current = $('#is_current').is(':checked');

                // Check if any required field is empty and show validation message
                if (!organization_name || !designation || !department || !from) {
                    // Show validation message for each field
                    if (!organization_name) {
                        $('#organizationNameError').text('Please enter your organization name');
                    }
                    if (!designation) {
                        $('#designationError').text('Please enter your designation');
                    }
                    if (!department) {
                        $('#departmentError').text('Please enter your department');
                    }
                    if (!from) {
                        $('#fromError').text('Please enter your start date');
                    }
                    return;
                }

                // Check if to date is required but empty, and show validation message
                if (!is_current && !to) {
                    $('#toError').text('Please enter your end date');
                    return;
                }

                const startDate = new Date(from);
                const endDate = new Date(to);
                const duration_month = getFormattedDuration(startDate, endDate, is_current);


                experienceData.push({
                    organization_name,
                    designation,
                    department,
                    from,
                    to,
                    is_current,
                    duration_month
                });

                console.log(experienceData);
                const html =
                    `<div class="col-lg-6 mb-4">
                        <div class="custom-card-for-doctor-data">
                            <div class="row">
                                <div class="col-6">
                                    <p class="">
                                        ${organization_name}
                                    </p>
                                </div>
                                <div class="col-6 text-right">
                                    <span class="pointer md-2 mr-2">
                                        <button>Edit</button>
                                    </span> 
                                    <span class="pointer" data-toggle="modal" data-target="#two">
                                        <button>Delete</button>
                                    </span>
                                </div>
                            </div>
                            <p class="">
                                Designation
                            </p>
                            <p class="mt-n3">
                                ${designation}
                            </p>
                            <p class="">
                                Department
                            </p>
                            <p class="mt-n3">
                                ${department}
                            </p>
                            <div class="row">
                                <div class="col-6">
                                    <p class="">
                                        Employment period
                                    </p>
                                    <p class="mt-3 text-xs">
                                        ${from} - ${
                                            is_current?"PRESENT":to
                                        }
                                    </p>
                                </div>
                                <div class="col-6 text-right">
                                    <p class="">
                                        Period
                                    </p>
                                    <p class="mt-3">                        
                                        ${
                                            duration_month
                                        }                    
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>`
                $('#experience').prepend(html);
                $('#experienceForm').trigger("reset");
                $('#experienceModalCenter').modal('hide');

            });

            function getFormattedDuration(startDate, endDate, isCurrent) {
                var startDay = startDate.getDate();
                var startMonth = startDate.getMonth() + 1;
                var startYear = startDate.getFullYear();

                var endDay = endDate.getDate();
                var endMonth = endDate.getMonth() + 1;
                var endYear = endDate.getFullYear();

                var start = new Date(startYear, startMonth, startDay);
                var end = new Date(endYear, endMonth, endDay);

                var durationInDays = (end - start) / (1000 * 60 * 60 * 24);
                var averageDaysPerMonth = 365.25 / 12;
                var durationInMonths = durationInDays / averageDaysPerMonth;

                if (isCurrent && durationInMonths < 1) {
                    return "--";
                } else {
                    return Math.floor(durationInMonths) + " months";
                }
            }

            const hourscontent = (start_time = "", end_time = "") => {
                return '<div class="row form-row hours-cont">' +
                    '<div class="col-12 col-md-10">' +
                    '<div class="row form-row">' +
                    '<div class="col-12 col-md-6">' +
                    '<div class="form-group">' +
                    '<label>Start Time</label>' +
                    '<input type="time" name="start_time[]" id="" value="' + start_time +
                    '" class="form-control">' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-12 col-md-6">' +
                    '<div class="form-group">' +
                    '<label>End Time</label>' +
                    '<input type="time" name="end_time[]" id="" value="' + end_time +
                    '" class="form-control">' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-12 col-md-2">' +
                    '<label class="d-md-block d-sm-none d-none">&nbsp;</label>' +
                    '<a href="#" class="btn btn-danger trash">' +
                    '<i class="far fa-trash-alt"></i>' +
                    '</a>' +
                    '</div>' +
                    '</div>';
            }
            $(".add-hours").on('click', function() {
                $(".hours-info").append(hourscontent());
                return false;
            });
            $(".hours-info").on('click', '.trash', function() {
                $(this).closest('.hours-cont').remove();
                return false;
            });
            $('#add_time_slot').on('show.bs.modal', function(e) {
                var weekday = $(e.relatedTarget).data('weekday');
                $("#weekday").html(weekday);
            });
            $('#save_schedule').on('click', function(e) {
                e.preventDefault();
                const weekday = $('#weekday').text();
                // Get the value of the first "Start Time" input field by name
                const startTime = document.getElementsByName('start_time[]');
                const endTime = document.getElementsByName('end_time[]');
                // console.log({
                //     startTime,
                //     endTime
                // })
                const timeSlots = [];

                for (let i = 0; i < startTime.length; i++) {
                    timeSlots.push({
                        "start_time": startTime[i].value,
                        "end_time": endTime[i].value
                    });
                }

                if (scheduleData[weekday]) {
                    // Append timeSlots to the existing array
                    scheduleData[weekday].push(...timeSlots);
                } else {
                    // Create a new array with timeSlots
                    scheduleData[weekday] = timeSlots;
                }

                $('#add_time_slot').modal('hide');
                console.log(scheduleData);

                for (const key in scheduleData) {
                    // Get the element with ID "my-element"
                    const slotIdEl = $(`#slot_${key.toLowerCase()}`);

                    const timeSlots = scheduleData[key];

                    let timeSlotsHtml = '';

                    for (const slot of timeSlots) {
                        // console.log(`- ${slot.start_time} - ${slot.end_time}`);
                        const startTime = new Date(slot.start_time);
                        const endTime = new Date(slot.end_time);
                        const start = isNaN(Date.parse(`2000-01-01T${slot.start_time}:00`)) ? null :
                            new Date(
                                `2000-01-01T${slot.start_time}:00`);
                        const end = isNaN(Date.parse(`2000-01-01T${slot.end_time}:00`)) ? null : new Date(
                            `2000-01-01T${slot.end_time}:00`);

                        if (!start || !end) {
                            console.log("Invalid date string");
                        }

                        const startFormatted = start.toLocaleTimeString('en-US', {
                            hour: 'numeric',
                            minute: 'numeric',
                            hour12: true
                        });
                        const endFormatted = end.toLocaleTimeString('en-US', {
                            hour: 'numeric',
                            minute: 'numeric',
                            hour12: true
                        });
                        const timeRange = `${startFormatted} - ${endFormatted}`;
                        console.log(timeRange);

                        timeSlotsHtml +=
                            `<div class="doc-slot-list">
                                ${timeRange}
                                <a href="javascript:void(0)" class="delete_schedule">
                                    <i class="fa fa-times"></i>
                                </a>
                            </div>`;
                    }

                    const docTimesHtml = `
                        <div class="doc-times" data-slots="" data-day="">
                            ${timeSlotsHtml}
                        </div>`;

                    slotIdEl.children().not(':first-child').empty();
                    slotIdEl.append(docTimesHtml);
                    console.log(docTimesHtml);
                }


            });
        });
    </script>
    {{-- select2 --}}
    <script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $("#specialiy").select2({
                width: '300px'
            });
            // $("#degree").select2({
            //     width: '300px'
            // });
        });
    </script>
@endpush
