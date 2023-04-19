<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Review;
use App\User;
use App\Award;
use App\Education;
use App\Experience;
use App\Hospital;
use App\Membership;
use App\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function doctors()
    {
        $doctors = User::where('is_admin', 3)->orderBy('id', 'DESC')->get();
        return view('admin.doctor')->with('doctor', $doctors);
    }

    public function active_doctor($id)
    {
        $doctors = User::where('id', $id)->first();
        $doctors->status = 1;
        $doctors->save();

        $review = new Review();
        $review->user_id = $id;
        $review->rname = 'Admin';
        $review->rdescription = "He is Good Doctor";
        $review->ratting = 3;
        $review->save();
        return back()->with('success', 'Doctor has been active successfully');
    }
    public function inactive_doctor($id)
    {
        $doctors = User::where('id', $id)->first();
        $doctors->status = null;
        $doctors->save();
        return back()->with('success', 'Doctor has been Dactive successfully');
    }
    public function doctor_profile($id)
    {
        $doctors = User::where('id', $id)->orderBy('id', 'DESC')->first();
        return view('admin.doctor_profile')->with('doctor', $doctors);
    }

    public function doctor_update(Request $request, $id)
    {
        $user = User::where('id', $id)->first();


        $user->fname = $request->fname;
        $user->lname = $request->lname;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->dateOfbirth = $request->dateOfbirth;
        $user->present_address = $request->present_address;
        $user->permanent_address = $request->permanent_address;

        $user->save();
        return back()->with('success', 'Profile created successfully!');
    }

    public function patients()
    {
        $patient = Contact::orderBy('id', 'DESC')->get();
        return view('admin.patients')->with('patients', $patient);

    }
    public function delete_patient($id)
    {
        $delete = Contact::where('id', $id)->delete();
        // check data deleted or not
        if ($delete) {
            $success = true;
            $message = "Patient deleted successfully";
        } else {
            $success = true;
            $message = "Patient not found";
        }
        //  Return response
        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }

    public function reviews()
    {
        $review = Review::orderBy('id', 'DESC')->get();
        return view('admin.reviews')->with('review', $review);
    }

    public function delete_review($id)
    {
        $delete = Review::where('id', $id)->delete();
        // check data deleted or not
        if ($delete) {
            $success = true;
            $message = "Review deleted successfully";
        } else {
            $success = true;
            $message = "Review not found";
        }
        //  Return response
        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }

    public function doctor_add()
    {
        return view('admin.doctor_create');
    }
    public function doctor_create(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        $user = new User;
        if ($request->hasFile('photo')) {
            $imageName = rand(100, 1000000) . time() . '.' . $request->photo->extension();
            $request->photo->move(public_path('/files/uploads/'), $imageName);
            $user->photo = $imageName;
        }
        $user->slug = $request->fname . '-' . $request->lname . rand(1, 100);
        $user->name = $request->name;
        $user->is_admin = 3;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
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
        return redirect('doctors')->with('success', 'Doctor Profile created successfully!');
        //   return back()
    }
    public function profile_add_doctor($id)
    {
        $hospital = Hospital::all();
        $user = User::where('id', $id)->first();
        // dd($user);
        return view('admin.doctor_s')->with('success', 'Profile created successfully!')->with('users', $user)->with('hospitals', $hospital);

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
                $membership = new Membership;
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
                $registration = new Registration;
                $registration->user_id = $request->did;
                $registration->registrations = $request->registrations[$i];
                $registration->year = $request->ryear[$i];
                $registration->save();
            }
        }
        return back()->with('success', 'Registrations created successfully!');
    }
}