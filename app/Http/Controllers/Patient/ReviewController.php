<?php

namespace App\Http\Controllers\Patient;

use App\Appointment;
use App\Http\Controllers\Controller;
use App\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    /**
     * Store a new review for a doctor.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // dd($request->all());
        // Find an appointment that matches the authenticated user's ID and the doctor's ID
        $appointment = Appointment::where('patient_id', Auth::id())
            ->where('doctor_id', $request->input('doctor_id'))
            ->where('status', 'complete')
            ->whereNull('reviewed_at')
            ->first();
        // Check if there is a matching appointment
        if (!$appointment) {
            return redirect()->back()->with('error', 'You cannot leave a review at this time.');
        }

        // Validate the review form data
        $validatedData = $request->validate([
            'rating' => 'required|integer|between:1,5',
            'title' => 'nullable|string|max:30',
            'comment' => 'nullable|string|max:255',
        ]);

        // Create a new review
        $review = new Review();
        $review->appointment_id = $appointment->id;
        $review->patient_id = Auth::id();
        $review->doctor_id = $appointment->doctor_id;
        $review->rating = $validatedData['rating'];
        $review->comment = $validatedData['comment'];
        $review->save();

        // Mark the appointment as reviewed
        $appointment->reviewed_at = now();
        $appointment->save();

        return redirect()->back()->with('success', 'Your review has been submitted.');
    }
}
