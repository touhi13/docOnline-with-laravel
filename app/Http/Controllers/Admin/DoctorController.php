<?php

namespace App\Http\Controllers\Admin;

use App\Award;
use App\District;
use App\Doctor;
use App\Education;
use App\Experience;
use App\Http\Controllers\Controller;
use App\Membership;
use App\Registration;
use App\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class DoctorController extends Controller
{
    /**
     *Display a listing of the resource.
     *@return \Illuminate\Http\Response
     */
    public function index()
    {
        // Retrieve a list of doctors with their new experiences, qualifications, and specialities, ordered by descending ID.
        $doctors = Doctor::with('newExperiences', 'qualifications', 'specialities')->orderBy('id', 'DESC')->get();

        // Return the view "admin.doctor.index" with the retrieved data.
        return view('admin.doctor.index')->with('doctors', $doctors);
    }
    /**
     *Show the form for creating a new resource.
     *@return \Illuminate\Http\Response
     */
    public function create()
    {
        // Retrieve all districts except the one with id 65.
        $districts = District::where('id', '!=', 65)->pluck('id', 'district');

        // Pass the $districts variable to the view.
        return view('admin.doctor.create')->with('districts', $districts);
    }

    /**
     *Store a newly created resource in storage.
     *
     *@param \Illuminate\Http\Request $request
     *
     *@return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate incoming request data
        $validatedData = $request->validate([
            'title' => 'nullable|string|max:255',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'gender' => 'nullable|string|max:10',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'date_of_birth' => 'nullable|date',
            'district_id' => 'nullable|integer',
            'nid' => 'nullable|string|max:255',
            'regno' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:255',
            'email' => 'nullable|string|email|max:255|unique:doctors,email',
            'password' => 'nullable|string|min:6|confirmed',
            'is_doctor' => 'nullable|boolean',
        ]);

        // Create name from title, first_name, and last_name
        $name = $validatedData['title'] . ' ' . $validatedData['first_name'] . ' ' . $validatedData['last_name'];
        $validatedData['name'] = $name;

        // Upload profile photo
        if ($request->hasFile('profile_photo')) {
            $image = $request->file('profile_photo');
            $filename = time() . '_' . $image->getClientOriginalName();
            $path = public_path('images/doctors/' . $filename);

            // Save image
            $img = Image::make($image->getRealPath());
            $img->save($path);

            $validatedData['profile_photo'] = $filename;
        }

        // Hash the password before saving to database
        $validatedData['password'] = Hash::make($validatedData['password']);

        // Create a new Doctor object with validated data and save to database
        $doctor = Doctor::create($validatedData);

        // Redirect to index page with success message
        return redirect()->route('doctor.index')
            ->with('success', 'Doctor created successfully.');
    }

    public function show(Doctor $doctor)
    {
        return view('admin.doctor.show')->with('doctor', $doctor);
    }
    public function doctor_profile_settings()
    {
        $user = User::where('id', Auth::user()->id)->first();
        return view('doctor.profile')->with('users', $user);
    }
    public function doctor_profile_update($id, Request $request)
    {
        // dd($request->design);
        // $this->validate($request, []);
        // $this->validate($request, [

        //     'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        // ]);

        $user = User::where('id', $id)->first();

        if ($request->hasFile('photo')) {
            $imageName = rand(100, 1000000) . time() . '.' . $request->photo->extension();
            $request->photo->move(public_path('/files/uploads/'), $imageName);
            $user->photo = $imageName;
        }
        $user->slug = $request->fname . '-' . $request->lname . rand(1, 100);
        $user->fname = $request->fname;
        $user->lname = $request->lname;
        $user->phone = $request->phone;
        $user->gender = $request->gender;
        $user->dateOfbirth = $request->dateOfbirth;
        $user->present_address = $request->present_address;
        $user->permanent_address = $request->permanent_address;
        $user->aboutMe = $request->aboutMe;
        $user->pwork = $request->pwork;
        $user->services = $request->services;
        $user->designa = $request->design;
        $user->specialization = $request->specialist;
        $user->cat_id = $request->cat_id;
        $user->save();
        return back()->with('success', 'Profile created successfully!');
    }

    public function education(Request $request)
    {
        if ($request->degree) {
            for ($i = 0; $i < count($request->degree); $i++) {
                $education = new Education;
                $education->user_id = $request->did;
                $education->degree = $request->degree[$i];
                $education->institute = $request->institute[$i];
                $education->completion = $request->completion[$i];
                $education->save();
            }
        }
        return back()->with('success', 'Education created successfully!');
    }

    public function experience(Request $request)
    {
        if ($request->hospitalName) {
            for ($i = 0; $i < count($request->hospitalName); $i++) {
                $experience = new Experience;
                $experience->user_id = $request->did;
                $experience->hospitalName = $request->hospitalName[$i];
                $experience->from = $request->from[$i];
                $experience->to = $request->to[$i];
                $experience->designation = $request->designation[$i];
                $experience->save();
            }
        }
        return back()->with('success', 'Experience created successfully!');
    }
    public function awards(Request $request)
    {
        if ($request->awards) {
            for ($i = 0; $i < count($request->awards); $i++) {
                $award = new Award;
                $award->user_id = $request->did;
                $award->awards = $request->awards[$i];
                $award->year = $request->ayear[$i];
                $award->save();
            }
        }
        return back()->with('success', 'Awards created successfully!');
    }
    public function memberships(Request $request)
    {
        if ($request->memberships) {
            for ($i = 0; $i < count($request->memberships); $i++) {
                $membership = new Membership();
                $membership->user_id = $request->did;
                $membership->membership = $request->memberships[$i];
                $membership->save();
            }
        }
        return back()->with('success', 'Memberships created successfully!');
    }
    public function registrations(Request $request)
    {
        if ($request->registrations) {
            for ($i = 0; $i < count($request->registrations); $i++) {
                $registration = new Registration();
                $registration->user_id = $request->did;
                $registration->registrations = $request->registrations[$i];
                $registration->year = $request->ryear[$i];
                $registration->save();
            }
        }
        return back()->with('success', 'Registrations created successfully!');
    }

    public function review()
    {
        $review = Review::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->get();
        return view('doctor.review')->with('review', $review);
    }

    public function doctor_backround()
    {
        $deducation = Education::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->get();
        $dexprience = Experience::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->get();
        $daward = Award::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->get();
        $dregistration = Registration::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->get();
        return view('doctor.doctor_background')->with('education', $deducation)->with('exprience', $dexprience)->with('award', $daward)->with('registration', $dregistration);
    }
}
