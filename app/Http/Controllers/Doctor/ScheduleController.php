<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;

use App\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $schedules = Schedule::whereJsonContains('time_slots->Monday', [['start_time' => '09:00:00', 'end_time' => '12:00:00']])->get();
        $schedules = Schedule::where('doctor_id', Auth::id())->first();
        // dd(json_decode($schedules->time_slots));
        $timeSlots = $schedules !== null ? json_decode($schedules->time_slots) : null;
        // dd($timeSlots);
        return view('doctor.schedule.index')->with('timeSlots', $timeSlots);
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
        // Get all the submitted data from the form
        $data = $request->all();

        // Initialize an empty array to store the new data
        $newData = [];

        // Loop through the 'start_time' array and create a new stdClass object for each time slot
        foreach ($data['start_time'] as $key => $value) {
            $newObject = new \stdClass();
            $newObject->start_time = $value;
            $newObject->end_time = $data['end_time'][$key];
            $newData[] = $newObject;
        }

        // Check if the doctor already has a schedule for the submitted day
        $schedules = Schedule::where('doctor_id', Auth::id())->first();

        if (!empty($schedules)) {
            // If the doctor has an existing schedule, update it with the new time slots
            $deCodedData = json_decode($schedules->time_slots);
            if (is_object($deCodedData)) {
                $deCodedData->{$data['schedule_day']} = $newData;
            } elseif (is_array($deCodedData) && array_key_exists($data['schedule_day'], $deCodedData)) {
                $deCodedData[$data['schedule_day']] = $newData;
            }
            $schedules->time_slots = json_encode($deCodedData);
            $schedules->save();
        } else {
            // If the doctor doesn't have a schedule for the submitted day, create a new one
            $newSchedule = new Schedule();
            $newSchedule->doctor_id = Auth::id();
            $newSchedule->time_slots = json_encode(
                (object) [
                    $data['schedule_day'] => $newData
                ]
            );
            $newSchedule->save();
        }

        // Redirect the user back to the previous page with a success message
        return back()->with('success', 'Profile created successfully!');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function show(Schedule $schedule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function edit(Schedule $schedule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Schedule $schedule)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function destroy(Schedule $schedule)
    {
        //
    }
}