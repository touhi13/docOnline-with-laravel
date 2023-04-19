<?php

namespace App\Http\Controllers;

use App\Hospital;
use Illuminate\Http\Request;

class HospitalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hospital= Hospital::orderBy('id','DESC')->get();
        return view('admin.hospital')->with('hospitals',$hospital);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.hospital_create');
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
            'name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            
     ]);
      $hospital =new Hospital();
        if ($request->hasFile('logo')) {
         $imageName =rand(100,1000000).time().'.'.$request->logo->extension();     
         $request->logo->move(public_path('/files/uploads/'), $imageName);
         $hospital->logo=$imageName;           
        }
       
        $hospital->name=$request->name;        
        $hospital->email=$request->email;     
        $hospital->phone =$request->phone;
        $hospital->address= $request->address;
        $hospital->info=$request->info;
       $hospital->save();
        return redirect('hospitals')->with('success','Hospital Profile created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Hospital  $hospital
     * @return \Illuminate\Http\Response
     */
    public function show(Hospital $hospital)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Hospital  $hospital
     * @return \Illuminate\Http\Response
     */
    public function edit(Hospital $hospital)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Hospital  $hospital
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Hospital $hospital)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Hospital  $hospital
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = Hospital::where('id', $id)->delete();
      // check data deleted or not
      if ($delete) {
          $success = true;
          $message = "Hospital deleted successfully";
      } else {
          $success = true;
          $message = "Hospital not found";
      }
      //  Return response
      return response()->json([
          'success' => $success,
          'message' => $message,
      ]);
    }
}
