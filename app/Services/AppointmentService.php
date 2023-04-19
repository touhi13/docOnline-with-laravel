<?php

namespace App\Services;

use Carbon\Carbon;

class AppointmentService
{
    /**
     *Returns the next occurrence of the specified weekday based on the createdAt date.
     *@param string $createdAt The date to use as a reference for finding the next weekday.
     *@param string $weekday The weekday to find (e.g. "Monday", "Tuesday", etc.).
     *@return string The formatted date string of the next occurrence of the specified weekday.
     */
    public function getNextWeekdayDate($createdAt, $weekday)
    {
        // Parse the created date
        $createdAtDate = Carbon::parse($createdAt);

        // Retrieves the current date using the Carbon library and then retrieves the English day of the week corresponding to the current date.
        $today = Carbon::today();
        $englishDayOfWeek = $today->englishDayOfWeek;

        if ($createdAtDate->isSameDay($today) && $englishDayOfWeek === $weekday) {
            // If the provided date is the same as today and today is the specified weekday,
            // return the provided date formatted as 'd M Y'.
            return $createdAtDate->format('d M Y');
        }

        // Calculate the next occurrence of the specified weekday based on the provided date.
        $nextDate = $createdAtDate->next($weekday);
        return $nextDate->format('d M Y');
    }
    /**
     *Determine if the appointment is scheduled for today.
     *@param object $appointment
     *@return bool
     */
    public function isToday($appointment)
    {
        // Parse the created date from the appointment object
        $createdDate = Carbon::parse($appointment->created_at);

        // Retrieves the current date using the Carbon library and then retrieves the English day of the week corresponding to the current date.
        $today = Carbon::today();
        $englishDayOfWeek = $today->englishDayOfWeek;

        // Check if the appointment was created on today's date and on the same day of the week as the appointment day
        if ($createdDate->isSameDay($today) && $englishDayOfWeek === $appointment->day) {
            return true;
        }

        // Check if the next occurrence of the appointment day is today
        $nextDate = $createdDate->copy()->next($appointment->day)->toDateString();
        return Carbon::parse($nextDate)->isSameDay($today);
    }
    /**
     * Determines if the appointment is upcoming or not.
     *
     * @param object $appointment
     * @return bool
     */
    public function isUpcoming($appointment)
    {
        // Parse the created date from the appointment object
        $createdDate = Carbon::parse($appointment->created_at);

        // If the created date is on the same day as the appointment day, then the appointment is not upcoming
        if ($createdDate->englishDayOfWeek === $appointment->day) {
            return false;
        }

        // Get the date of the next occurrence of the appointment day
        $nextDate = $createdDate->copy()->next($appointment->day)->toDateString();

        // Check if the next occurrence of the appointment day is in the future
        return Carbon::parse($nextDate)->isFuture();
    }
    /**
     * Sorts the given array of appointments by the date of the next occurrence.
     *
     * @param  array  $appointments  The array of appointments to sort
     * @return array                 The sorted array of appointments
     */
    public function sortAppointmentsByDate($appointments)
    {
        return collect($appointments)->sortBy(function ($appointment) {
            // Parse the created date of the appointment
            $createdAtDate = Carbon::parse($appointment->created_at);

            // Get the date of the next occurrence of the appointment's day
            $nextDate = $createdAtDate->next($appointment->day);

            // Return the next date to sort the appointments by
            return $nextDate;
        })->values()->all();
    }
}
