<?php

use App\Appointment;
use App\Doctor;
use App\Review;
use App\User;
use Illuminate\Database\Seeder;

class ReviewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Get all completed appointments
        $appointments = Appointment::where('status', 'complete')->get();

        // Loop through each appointment and create a review
        foreach ($appointments as $appointment) {
            $doctor = Doctor::find($appointment->doctor_id);
            $patient = User::find($appointment->patient_id);

            $review = new Review();
            $review->doctor_id = $doctor->id;
            $review->patient_id = $patient->id;
            $review->appointment_id = $appointment->id;
            $review->rating = rand(1, 5);
            $review->comment = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.';
            $review->save();
        }
    }
}
