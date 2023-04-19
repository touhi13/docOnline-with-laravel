@extends('layouts.front')
@section('title')
    Doctorkhuji || Specialist Doctor
@endsection
@section('content')
    <!-- Page Content -->
    <div class="content">
        <div class="container">

            <div class="row">
                <div class="col-md-7 col-lg-8">
                    <div class="card">
                        <div class="card-body">

                            {{--  <!-- Checkout Form -->
                            <form action="https://dreamguys.co.in/demo/doccure/booking-success.html">

                                <!-- Personal Information -->
                                <div class="info-widget">
                                    <h4 class="card-title">Personal Information</h4>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group card-label">
                                                <label>First Name</label>
                                                <input class="form-control" type="text">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group card-label">
                                                <label>Last Name</label>
                                                <input class="form-control" type="text">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group card-label">
                                                <label>Email</label>
                                                <input class="form-control" type="email">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group card-label">
                                                <label>Phone</label>
                                                <input class="form-control" type="text">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="exist-customer">Existing Customer? <a href="#">Click here to login</a>
                                    </div>
                                </div>
                                <!-- /Personal Information -->

                                <div class="payment-widget">
                                    <h4 class="card-title">Payment Method</h4>

                                    <!-- Credit Card Payment -->
                                    <div class="payment-list">
                                        <label class="payment-radio credit-card-option">
                                            <input type="radio" name="radio" checked>
                                            <span class="checkmark"></span>
                                            Credit card
                                        </label>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group card-label">
                                                    <label for="card_name">Name on Card</label>
                                                    <input class="form-control" id="card_name" type="text">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group card-label">
                                                    <label for="card_number">Card Number</label>
                                                    <input class="form-control" id="card_number"
                                                        placeholder="1234  5678  9876  5432" type="text">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group card-label">
                                                    <label for="expiry_month">Expiry Month</label>
                                                    <input class="form-control" id="expiry_month" placeholder="MM"
                                                        type="text">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group card-label">
                                                    <label for="expiry_year">Expiry Year</label>
                                                    <input class="form-control" id="expiry_year" placeholder="YY"
                                                        type="text">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group card-label">
                                                    <label for="cvv">CVV</label>
                                                    <input class="form-control" id="cvv" type="text">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /Credit Card Payment -->

                                    <!-- Paypal Payment -->
                                    <div class="payment-list">
                                        <label class="payment-radio paypal-option">
                                            <input type="radio" name="radio">
                                            <span class="checkmark"></span>
                                            Paypal
                                        </label>
                                    </div>
                                    <!-- /Paypal Payment -->

                                    <!-- Terms Accept -->
                                    <div class="terms-accept">
                                        <div class="custom-checkbox">
                                            <input type="checkbox" id="terms_accept">
                                            <label for="terms_accept">I have read and accept <a href="#">Terms &amp;
                                                    Conditions</a></label>
                                        </div>
                                    </div>
                                    <!-- /Terms Accept -->

                                    <!-- Submit Section -->
                                    <div class="submit-section mt-4">
                                        <button type="submit" class="btn btn-primary submit-btn">Confirm and Pay</button>
                                    </div>
                                    <!-- /Submit Section -->

                                </div>
                            </form>
                            <!-- /Checkout Form -->  --}}
                            <div class="payment-widget">
                                <div class="submit-section mt-4">
                                    <button type="submit" class="btn btn-primary submit-btn" id="sslczPayBtn"
                                        token="if you have any token validation"
                                        postdata="your javascript arrays or objects which requires in backend"
                                        order="If you already have the transaction generated for current order"
                                        endpoint="{{ url('/pay-via-ajax') }}">Pay Now</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-md-5 col-lg-4 ">

                    <!-- Booking Summary -->
                    <div class="card booking-card">
                        <div class="card-header">
                            <h4 class="card-title">Booking Summary</h4>
                        </div>
                        <div class="card-body">

                            <!-- Booking Doctor Info -->
                            <div class="booking-doc-info">
                                <a href="doctor-profile.html" class="booking-doc-img">
                                    @if ($doctor->profile_photo)
                                        <img src={{ asset('images/doctors/' . $doctor->profile_photo) }}
                                            alt={{ $doctor->name }}>
                                    @else
                                        <img src={{ asset('assets/img/profile.png') }} alt="User Image">
                                    @endif
                                </a>
                                <div class="booking-info">
                                    <h4><a href="doctor-profile.html">{{ $doctor->name }}</a></h4>
                                    <div class="rating">
                                        <i class="fas fa-star filled"></i>
                                        <i class="fas fa-star filled"></i>
                                        <i class="fas fa-star filled"></i>
                                        <i class="fas fa-star filled"></i>
                                        <i class="fas fa-star"></i>
                                        <span class="d-inline-block average-rating">35</span>
                                    </div>
                                    <div class="clinic-details">
                                        <p class="doc-location"><i class="fas fa-map-marker-alt"></i> Newyork, USA</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Booking Doctor Info -->

                            <div class="booking-summary">
                                <div class="booking-item-wrap">
                                    <ul class="booking-date">
                                        <li>Date <span>{{ $appointmentDate }}</span></li>
                                        <li>Time <span>10:00 AM</span></li>
                                    </ul>
                                    <ul class="booking-fee">
                                        <li>Consulting Fee <span id="fee"
                                                data-fee="{{ $doctor->consultationFee->first_consultation_fee }}">$
                                                {{ $doctor->consultationFee->first_consultation_fee }}</span></li>
                                        <li>Booking Fee <span>$10</span></li>
                                        <li>Video Call <span>$50</span></li>
                                    </ul>
                                    <div class="booking-total">
                                        <ul class="booking-total-list">
                                            <li>
                                                <span>Total</span>
                                                <span class="total-cost"
                                                    data-total="{{ $doctor->consultationFee->first_consultation_fee }}"
                                                    data-currency="{{ $doctor->consultationFee->currency }}">
                                                    $160
                                                </span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /Booking Summary -->
                </div>
            </div>
        </div>
    </div>
    <!-- /Page Content -->
@endsection

@push('script')
    <script>
        const obj = {};
        {{--  obj.cus_name = $('#customer_name').val();
        obj.cus_phone = $('#mobile').val();
        obj.cus_email = $('#email').val();
        obj.cus_addr1 = $('#address').val();
        obj.amount = $('#total_amount').val();  --}}

        const queryString = window.location.search;
        const urlParams = new URLSearchParams(queryString);
        obj.doctorId = urlParams.get('doctorId');
        obj.day = urlParams.get('day');
        obj.startTime = urlParams.get('startTime');
        obj.endTime = urlParams.get('endTime');
        obj.patientId = "{{ auth()->id() }}";
        obj.total = $('.total-cost').attr('data-total');
        obj.currency = $('.total-cost').attr('data-currency');

        console.log(obj);


        $('#sslczPayBtn').prop('postdata', obj);

        (function(window, document) {
            var loader = function() {
                var script = document.createElement("script"),
                    tag = document.getElementsByTagName("script")[0];
                // script.src = "https://seamless-epay.sslcommerz.com/embed.min.js?" + Math.random().toString(36).substring(7); // USE THIS FOR LIVE
                script.src = "https://sandbox.sslcommerz.com/embed.min.js?" + Math.random().toString(36).substring(
                    7); // USE THIS FOR SANDBOX
                tag.parentNode.insertBefore(script, tag);
            };

            window.addEventListener ? window.addEventListener("load", loader, false) : window.attachEvent("onload",
                loader);
        })(window, document);
    </script>
@endpush
