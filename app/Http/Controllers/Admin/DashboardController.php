<?php

namespace App\Http\Controllers\Admin;

use App\Doctor;
use App\Http\Controllers\Controller;
use App\Patient;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $doctor = Doctor::where('is_doctor', 1)->count();
        $patient = Patient::count();
        return view('admin.dashboard.index')
            ->with([
                'doctor' => $doctor,
                'patient' => $patient,
            ]);
    }

}
