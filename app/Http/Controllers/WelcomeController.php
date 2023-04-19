<?php

namespace App\Http\Controllers;

use App\District;
use App\Doctor;
use App\Helpers\StringHelper;
use App\Review;
use App\Speciality;
use App\User;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    /**
     *Retrieve the necessary data and pass it to the welcome view.
     *@return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function welcome()
    {
        // Retrieve districts
        $districts = District::pluck('district', 'id')->reject(function ($district, $id) {
            return $id == 65;
        });

        // dd($districts);

        // Retrieve specialities ordered by typical name in ascending order
        $specialities = Speciality::orderBy('typical_name', 'ASC')->get();

        // Retrieve 10 random doctors
        $doctors = Doctor::with('Specialities', 'district')->inRandomOrder()->take(10)->get();

        // Create a new instance of the StringHelper class
        $stringHelper = new StringHelper();

        // Pass the $doctors, $category, and $specialities variables as well as the
        // limitString function as parameters to the welcome view
        return view('welcome')->with('doctors', $doctors)
            ->with('districts', $districts)
            ->with('specialities', $specialities)
            ->with('limitString', [$stringHelper, 'limitString']);
    }
    /**
     * Display the specified doctor's profile.
     *
     * @param string $slug The slug of the doctor's profile.
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException If the doctor with the specified ID is not found.
     */
    public function doctor_profile($slug)
    {
        // Split the slug into an array and get the ID of the doctor from the end of the array.
        $slugArray = explode('-', $slug);
        $id = array_pop($slugArray);

        // Retrieve the doctor with the specified ID and their new experiences.
        $doctor = Doctor::with('newExperiences', 'reviews')->findOrFail($id);

        // Retrieve the first 5 reviews for the doctor.
        $reviews = $doctor->reviews()->take(5)->get();

        // Get the total count of reviews for the doctor.
        $reviewCount = $doctor->reviews()->count();

        // Determine whether to display the "See all reviews" button.
        $showAllReviewsButton = $reviewCount > 5;

        // Return the view to display the doctor's profile.
        return view('doctor.profile_single', [
            'doctor' => $doctor,
            'reviews' => $reviews,
            'showAllReviewsButton' => $showAllReviewsButton,
            'reviewCount' => $reviewCount,
        ]);
    }

    public function all_reviews($slug)
    {
        // Split the slug into an array and get the ID of the doctor from the end of the array.
        $slugArray = explode('-', $slug);
        $id = array_pop($slugArray);
        $review = Review::where('doctor_id', $id)->orderBy('id', 'DESC')->paginate(10);
        return view('doctor.all_reviews')->with('reviews', $review);
    }

    public function speciality($id)
    {
        // Decrypt the ID passed in the URL
        $decryptId = decrypt($id);

        // Find the speciality by its decrypted ID
        $spec = Speciality::find($decryptId);

        // Load the associated doctors and their relationships separately
        $doctors = $spec->doctors()
            ->with(['newExperiences', 'qualifications', 'district', 'specialities'])
            ->paginate(20);

        // Get all the available specialities to display in the view
        $specialities = Speciality::all();

        // Return the view with the paginated doctors, the speciality ID, and all the available specialities
        return view('doctor.type')
            ->with('doctors', $doctors)
            ->with('specId', $decryptId)
            ->with('specialities', $specialities);
    }

    public function slocation(Request $request)
    {
        $data = User::select("name as name", "fname as fn", "lname as ln")
            ->where("title", "LIKE", "%{$request->input('query')}%")
            ->get();
        return response()->json($data);
    }

    // filter-search
    public function search(Request $request)
    {
        // Get the search filters from the request
        $district = $request->district;
        $searchText = $request->searchText;
        $gender = $request->gender;
        $specId = $request->specialist;

        // Query the doctors table with the specified filters
        $doctors = Doctor::with('specialities', 'newExperiences', 'district', 'qualifications')
            ->when($gender, function ($query) use ($gender) {
                // If gender filter is present, add it to the query
                return $query->where('gender', $gender);
            })
            ->when($specId, function ($query) use ($specId) {
                // If speciality filter is present, add it to the query
                return $query->whereHas('specialities', function ($query) use ($specId) {
                    // Use the specialities table's id column to avoid ambiguity
                    return $query->where('specialities.id', $specId);
                });
            })
            ->when($district, function ($query) use ($district) {
                // If district filter is present, add it to the query
                return $query->where('district_id', $district);
            })
            ->when($searchText, function ($query) use ($searchText) {
                // If search text is present, add it to the query
                return $query->where(function ($query) use ($searchText) {
                    // Search for the name and current organization of new experiences,
                    // and the name, typical name, and profession name of specialities
                    $query->where('name', 'like', '%' . $searchText . '%')
                        ->orWhereHas('newExperiences', function ($query) use ($searchText) {
                            $query->where('is_current', true)
                                ->where('organization_name', 'like', '%' . $searchText . '%');
                        })
                        ->orWhereHas('specialities', function ($query) use ($searchText) {
                            $query->where('name', 'like', '%' . $searchText . '%')
                                ->orWhere('typical_name', 'like', '%' . $searchText . '%')
                                ->orWhere('profession_name', 'like', '%' . $searchText . '%');
                        });
                });
            })
            ->paginate(20); // Paginate the results

        // Get all the available specialities to display in the view
        $specialities = Speciality::all();

        // Return the view with the filtered doctors, search filters, and all available specialities
        return view('doctor.type')
            ->with('doctors', $doctors)
            ->with('specId', $specId)
            ->with('gender', $gender)
            ->with('specialities', $specialities)
            ->with('district', $district)
            ->with('searchText', $searchText);
    }

    public function ask_a_doctor()
    {
        // Get all the available specialities to display in the view
        $specialities = Speciality::all();
        return view('welcome.specialities')->with('specialities', $specialities);
    }

    public function term_condition()
    {
        return view('doctor.term_condition');
    }
}
