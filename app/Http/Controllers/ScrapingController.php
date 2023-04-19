<?php

namespace App\Http\Controllers;

use App\AdditionalQualification;
use App\Degree;
use App\Doctor;
use App\ExperienceBeta;
use App\NewExperience;
use App\Speciality;
use Facade\Ignition\Http\Controllers\ScriptController;
use Illuminate\Http\Request;
use Image;

class ScrapingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.scraping.index');
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
        $request->validate([
            'specs_number' => ['required']
        ]);
        $specs = $request->specs_number;
        $perPage = 400;
        $page = 1;
        self::scraper($specs, $perPage, $page);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    private function scraper($specs, $perPage, $page)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://admin.doctime.com.bd/api/doctors/search?specialities[]=" . $specs . "&per_page=" . $perPage . "&page=" . $page,
            // your preferred link
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_TIMEOUT => 30000,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                // Set Here Your Requesred Headers
                'Content-Type   : application/json',
            ),
        )
        );
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $doctors = (json_decode($response));
            if (!empty($doctors->data)) {
                self::saveData($doctors, $specs, $perPage, $page);
            } else {
                return redirect()->back()->with('msg', 'Data Unavailable!');

                // return redirect('scraping.index')->with('msg','Data Unavailable!');
            }
        }
    }
    private function saveData($doctors, $specs, $perPage, $page)
    {
        foreach ($doctors->data as $key => $value) {
            $path = $value->user->profile_photo;
            $filename = uniqid() . "." . pathinfo($path, PATHINFO_EXTENSION);
            Image::make($path)->save(public_path('images/doctors/' . $filename));
            $value->user->profile_photo = $filename;
            $newDoc = new Doctor();
            $newDoc->title = $value->user->title;
            $newDoc->first_name = $value->user->first_name;
            $newDoc->last_name = $value->user->last_name;
            $newDoc->name = $value->user->name;
            $newDoc->gender = $value->user->gender;
            $newDoc->profile_photo = $filename;
            $newDoc->save();
            if ($newDoc->id) {
                foreach ($value->degree_names as $name) {
                    $newDegree = new Degree();
                    $newDegree->doctor_id = $newDoc->id;
                    $newDegree->title = $name;
                    $newDegree->save();
                }
                foreach ($value->additional_qualifications as $qualification) {
                    $newQualification = new AdditionalQualification();
                    $newQualification->doctor_id = $newDoc->id;
                    $newQualification->title = $qualification;
                    $newQualification->save();
                }
                foreach ($value->experiences as $experience) {
                    $newExperience = new NewExperience();
                    $newExperience->doctor_id = $newDoc->id;
                    $newExperience->organization_name = $experience->organization_name;
                    $newExperience->designation = $experience->designation;
                    $newExperience->department = $experience->department;
                    $newExperience->from = $experience->from;
                    $newExperience->to = $experience->to;
                    $newExperience->is_current = $experience->is_current;
                    $newExperience->duration_month = $experience->duration_month;
                    $newExperience->save();
                }
                foreach ($value->specialities as $speciality) {
                    $oldSpecialities = Speciality::firstWhere('name', $speciality->name);
                    if (!empty($oldSpecialities) && $oldSpecialities->count()) {
                        $newDoc->specialities()->attach($oldSpecialities->id);
                    } else {
                        $newSpeciality = new Speciality();
                        $newSpeciality->name = $speciality->name;
                        $newSpeciality->typical_name = $speciality->typical_name;
                        $newSpeciality->profession_name = $speciality->profession_name;
                        $newSpeciality->save();
                        $newDoc->specialities()->attach($newSpeciality->id);
                    }
                }
            }
        }
        if (!is_null($doctors->links->next)) {
            $doctors = self::scraper($specs, $perPage, ++$page);
        } else {
            return redirect()->back()->with('msg', 'Data Scraped successfully!');
            // return redirect()->route('/scraping')->with('msg', 'Data Scraped successfully!');
            // return redirect('scraping.index')->with('msg','Data Scraped successfully!');
        }
    }
}
//colorectal-surgery-42
//podiatry-20
//parasitology-17
//optometry-25
//herbal-medicine-31
//neonatology-54
//chiropractic-28
