<?php

namespace App\Http\Controllers;

use App\Booking;
use App\Schedule;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Decrypt the doctor ID from the request parameter
        $decryptedId = $this->decryptRequestId();

        // Find the schedule for the specified doctor ID, or throw an exception if none is found
        $schedules = Schedule::where('doctor_id', $decryptedId)->firstOrFail();

        // Decode the time slots for the schedule into an associative array
        $decodeTimeSlots = json_decode($schedules->time_slots, true);

        // Sort the time slots by weekday and return the result as an array
        $sortedTimeSlots = $this->sortTimeSlots($decodeTimeSlots);

        // Generate an array of dates for the next week
        $dates = $this->generateDateRange();

        // Pass the sorted time slots, schedule, and dates to the booking index view
        return view('patient.booking.index')->with([
            'timeSlots' => $sortedTimeSlots,
            'schedules' => $schedules,
            'dates' => $dates
        ]);
    }

    // Decrypt the doctor ID from the request parameter
    private function decryptRequestId()
    {
        $id = request('doctor_id');
        return decrypt($id);
    }

    // Sort the time slots by weekday and return the result as an array
    private function sortTimeSlots($decodeTimeSlots)
    {
        $sortedTimeSlots = [];
        $currentWeekday = Carbon::now();
        for ($i = 0; $i < 7; $i++) {
            // Get the name of the current weekday and use it to access the time slots for that day
            $weekday = $currentWeekday->copy()->addDays($i)->format('l');
            // Assign the time slots for the current weekday to the sorted time slots array
            $sortedTimeSlots[$weekday] = $decodeTimeSlots[$weekday] ?? null;
        }
        return $sortedTimeSlots;
    }

    // Generate an array of dates for the next week
    private function generateDateRange()
    {
        // Get the start and end dates for the next week
        $start = Carbon::now();
        $end = Carbon::now()->addDays(6);

        // Create a date period for the next week and generate an array of dates
        $period = CarbonPeriod::create($start, $end);
        $dates = [];
        foreach ($period as $date) {
            $dates[] = [
                'day_month' => $date->format('d M'),
                'year' => $date->format('Y'),
                'weekday' => $date->format('D')
            ];
        }
        return $dates;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function show(Booking $booking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function edit(Booking $booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Booking $booking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function destroy(Booking $booking)
    {
        //
    }
}