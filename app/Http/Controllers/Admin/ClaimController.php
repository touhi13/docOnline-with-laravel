<?php

namespace App\Http\Controllers\Admin;

use App\Claim;
use App\Doctor;
use App\Http\Controllers\Controller;
use App\Mail\ClaimMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ClaimController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get all claims from the database and sort them by ID in descending order
        $claims = Claim::orderBy('id', 'DESC')->get();
        // Render the admin.claim.index view and pass the claims data to it
        return view('admin.claim.index')->with('claims', $claims);
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
     * @param  \App\Claim  $claim
     * @return \Illuminate\Http\Response
     */
    public function show(Claim $claim)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Claim  $claim
     * @return \Illuminate\Http\Response
     */
    public function edit(Claim $claim)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Claim  $claim
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Claim $claim)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Claim  $claim
     * @return \Illuminate\Http\Response
     */
    public function destroy(Claim $claim)
    {
        //
    }
    /**
     * Show the claim form for the specified doctor.
     *
     * @param int $id The ID of the doctor to create a claim for
     * @return \Illuminate\Http\Response
     */
    public function claimProfile($id)
    {
        // Get the doctor with the specified ID from the database
        $doctor = Doctor::find($id);
        // Render the doctor.claim_form view and pass the doctor data to it
        return view('doctor.claim_form')->with('doctor', $doctor);
    }

    /**
     * Submit a new claim request for the specified doctor.
     *
     * @param \Illuminate\Http\Request $request The HTTP request object
     * @param int $id The ID of the doctor to create a claim for
     * @return \Illuminate\Http\Response
     */
    public function submitForClaimProfile(Request $request, $id)
    {
        // Validate the incoming request data
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email'],
            'phone_number' => ['required'],
            "file" => ['required', 'mimes:pdf', 'max:10000'],
            'agree' => ['required'],
        ]);
        // Create a new Claim instance
        $claim = new Claim();

        // Store the uploaded file
        $fileTemp = $request->file('file');
        if ($fileTemp->isValid()) {
            $fileExtension = $fileTemp->getClientOriginalExtension();
            $fileName = uniqid() . "." . $fileExtension;
            $fileTemp->storeAs(
                'public/document/claim_files',
                $fileName
            );
            $claim->file = $fileName;
        }

        // Set other attributes of the Claim instance from the request data
        $claim->title = $request->title;
        $claim->email = $request->email;
        $claim->phone = $request->phone_number;
        $claim->doctor_id = $id;

        // Save the Claim instance to the database
        $claim->save();

        // Check if the claim was saved successfully and redirect with appropriate message
        if ($claim->id) {
            return redirect()->back()->with('message', 'Your claim request submitted successfully!');
        } else {
            return redirect()->back()->with('message', 'Your claim request not submitted!');
        }
    }

    /**
     *
     *Update the status of a claim and send an email notification to the specified email address.
     *@param \Illuminate\Http\Request $request The HTTP request object containing the form data.
     *@param int $id The ID of the claim to update.
     *@return \Illuminate\Http\RedirectResponse The redirect response to the previous page with a success message.
     *@throws \Swift_TransportException If there was an error sending the email.
     */
    public function review_of_claim(Request $request, $id)
    {
        $claim = Claim::find($id);
        $claim->status = intval($request->approval);
        $claim->save();
        try {
            Mail::to('linkingroup02@gmail.com')->send(new ClaimMail($claim));
            return redirect()->back()->with('message', 'Your claim request submitted successfully!');
        } catch (\Swift_TransportException $e) {
            if ($e->getMessage()) {
                dd($e->getMessage());
            }
        }
    }
}
