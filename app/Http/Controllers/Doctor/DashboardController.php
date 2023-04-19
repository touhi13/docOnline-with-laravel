<?php

namespace App\Http\Controllers\Doctor;

use App\Appointment;
use App\Services\AppointmentService;
use App\Http\Controllers\Controller;
use App\Speciality;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * The appointment service instance.
     *
     * @var AppointmentService
     */
    protected $appointmentService;

    /**
     * Create a new controller instance.
     *
     * @param AppointmentService $appointmentService
     */
    public function __construct(AppointmentService $appointmentService)
    {
        $this->appointmentService = $appointmentService;
    }

    /**
     * Show the doctor's dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Get today's date and the date six days ago
        $today = Carbon::today();
        $dateSixDaysAgo = $today->copy()->subDays(6)->toDateString();

        // Retrieve appointments with status 'Pending' and created in the past six days
        $appointments = Appointment::with('patient')
            ->where('doctor_id', Auth::id())
            ->where('created_at', '>=', $dateSixDaysAgo)
            ->where('status', '=', 'Pending')
            ->get();


        //Sort the given appointments by their next scheduled date.
        $sortedAppointments = $this->appointmentService->sortAppointmentsByDate($appointments);

        $totalPatientTillToday = Appointment::where('doctor_id', Auth::id())->where('status', 'complete')->count();

        // $todaysPatient =  

        // Return the dashboard index view with appointments, and isToday and isUpcoming and getNextWeekdayDate callbacks
        return view('doctor.dashboard.index')
            ->with('appointments', $sortedAppointments)
            ->with('totalPatientTillToday', $totalPatientTillToday)
            ->with('isToday', function ($appointment) {
                return $this->appointmentService->isToday($appointment);
            })
            ->with('isUpcoming', function ($appointment) {
                return $this->appointmentService->isUpcoming($appointment);
            })
            ->with('getNextWeekdayDate', function ($appointment) {
                return $this->appointmentService->getNextWeekdayDate($appointment->created_at, $appointment->day);
            });
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return void
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return void
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return void
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return void
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Show the registration status page.
     *
     * @return \Illuminate\View\View
     */
    public function registrationStatus()
    {
        $specialities = Speciality::pluck('name', 'id');
        return view('doctor.dashboard.registrationStatus')->with('specialities', $specialities);
    }
}
