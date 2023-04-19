<?php

namespace App\Http\Controllers\Patient;

use App\Appointment;
use App\Doctor;
use App\Http\Controllers\Controller;
use App\Library\SslCommerz\SslCommerzNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Doctor $doctor)
    {
        $doctor = Doctor::find(decrypt($request->doctorId ?? ''));
        // dd($request->day);
        $appointmentDate = Carbon::parse('next ' . $request->day)->format('d M Y');

        return view('patient.appointment.index', compact('doctor', 'appointmentDate'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function show(Appointment $appointment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function edit(Appointment $appointment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Appointment $appointment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Appointment $appointment)
    {
        //
    }
    public function payViaAjax(Request $request)
    {
        // Retrieve the payment data from the request
        $paymentData = json_decode($request->input('cart_json'));
        $post_data = array();
        $post_data['total_amount'] = $paymentData->total; # You cant not pay less than 10
        $post_data['currency'] = $paymentData->currency;
        $post_data['tran_id'] = uniqid(); // tran_id must be unique

        # CUSTOMER INFORMATION
        $post_data['cus_name'] = 'Customer Name';
        $post_data['cus_email'] = 'customer@mail.com';
        $post_data['cus_add1'] = 'Customer Address';
        $post_data['cus_add2'] = "";
        $post_data['cus_city'] = "";
        $post_data['cus_state'] = "";
        $post_data['cus_postcode'] = "";
        $post_data['cus_country'] = "Bangladesh";
        $post_data['cus_phone'] = '8801XXXXXXXXX';
        $post_data['cus_fax'] = "";

        # SHIPMENT INFORMATION
        $post_data['ship_name'] = "Store Test";
        $post_data['ship_add1'] = "Dhaka";
        $post_data['ship_add2'] = "Dhaka";
        $post_data['ship_city'] = "Dhaka";
        $post_data['ship_state'] = "Dhaka";
        $post_data['ship_postcode'] = "1000";
        $post_data['ship_phone'] = "";
        $post_data['ship_country'] = "Bangladesh";

        $post_data['shipping_method'] = "NO";
        $post_data['product_name'] = "Computer";
        $post_data['product_category'] = "Goods";
        $post_data['product_profile'] = "physical-goods";
        // Generate a unique transaction ID
        $transactionId = uniqid();

        // Prepare the appointment data for storage in the database
        $appointmentData = [
            'doctor_id' => decrypt($paymentData->doctorId),
            'patient_id' => $paymentData->patientId,
            'total_amount' => $post_data['total_amount'],
            'status' => 'Pending',
            'tran_id' => $post_data['tran_id'],
            'currency' => $post_data['currency'],
            'day' => $paymentData->day,
            'time_slot' => json_encode([['start_time' => $paymentData->startTime, 'end_time' => $paymentData->endTime]])
        ];

        // Create or update the appointment record in the database
        $appointment = $this->createAppointment($appointmentData);

        // Process the payment using the SSLCommerz library
        $payment_options = $this->processPayment($post_data);

        // If the payment options are not an array, output them as text and set an empty array
        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = [];
        }
    }

    /**
     * Create an appointment record in the database.
     *
     * @param  array  $data
     * @return \App\Appointment
     */
    private function createAppointment($data)
    {
        return Appointment::updateOrCreate(['tran_id' => $data['tran_id']], $data);
    }

    /**
     * Process the payment using the SSLCommerz library.
     *
     * @param  $post_data
     * @return mixed
     */
    private function processPayment($post_data)
    {
        $sslc = new SslCommerzNotification();
        return $sslc->makePayment($post_data, 'checkout', 'json');
    }
}