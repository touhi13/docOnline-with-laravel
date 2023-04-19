<?php

namespace App\Http\Controllers\Auth;

use App\Admin;
use App\District;
use App\Doctor;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

// use Illuminate\Support\Facades\URL;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
     */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
        $this->middleware('guest:admin');
        $this->middleware('guest:doctor');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function adminValidator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:admins'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }
    protected function userValidator(array $data)
    {

        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:admins'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    protected function doctorValidator(array $data)
    {
        return Validator::make($data, [
            'title' => ['required', 'string'],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'date_of_birth' => ['required', 'date'],
            'gender' => ['required'],
            'district' => ['required'],
            'nid' => ['required', 'string', 'max:30'],
            'regno' => ['required', 'string', 'max:30'],
            'phone' => ['required', 'string', 'max:30'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }
    protected function validator(array $data)
    {

        if (request()->is('register/admin/*')) {
            return $this->adminValidator($data);
        } elseif (request()->is('register/doctor/*')) {
            return $this->doctorValidator($data);
        } else {
            return $this->userValidator($data);
        }
    }
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        // dd($data);
        $user = User::create([
            'name' => $data['first_name'] . ' ' . $data['last_name'],
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'date_of_birth' => $data['date_of_birth'],
            'gender' => $data['gender'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
        // if (array_key_exists('claim', $data)) {
        //     $claimedId = decrypt($data['claim']);
        //     $doctor = Doctor::find($claimedId['doctor']);
        //     $doctor->user_id = $user->id;
        //     $doctor->save();
        // }
        return $user;

    }
    public function showAdminRegisterForm()
    {
        return view('auth.register', ['url' => 'admin']);
    }

    public function showDoctorRegisterForm()
    {
        $districts = District::where('id', '!=', 65)->pluck('id', 'district');
        return view('auth.register', ['url' => 'doctor', 'districts' => $districts]);
    }
    protected function createAdmin(Request $request)
    {
        $this->validator($request->all())->validate();
        $admin = Admin::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);
        return redirect()->intended('login/admin');
    }

    protected function createDoctor(Request $request)
    {

        $this->validator($request->all())->validate();

        $doctor = Doctor::create([
            'title' => $request['title'],
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'name' => $request['title'] . ' ' . $request['first_name'] . ' ' . $request['last_name'],
            'date_of_birth' => $request['date_of_birth'],
            'gender' => $request['gender'],
            'district_id' => intval($request['district']),
            'nid' => $request['nid'],
            'regno' => $request['regno'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);
        // dd($request->all());
        return redirect()->intended('login/doctor');
    }
}
