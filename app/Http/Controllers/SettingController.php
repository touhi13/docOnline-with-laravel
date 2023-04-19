<?php

namespace App\Http\Controllers;

use App\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $setting= Setting::where('status',1)->first();
       return view('admin.setting.index')->with('s',$setting);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function edit(Setting $setting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $setting= Setting::where('status',1)->first();
        $setting->name=$request->name;
        $setting->email=$request->email;
        $setting->phone=$request->phone;
        $setting->address=$request->address;
        $setting->facbook=$request->fac;
        $setting->youtube=$request->youtube;
        $setting->twitter=$request->twitter;
        $setting->instagram=$request->instagram;
        $setting->linkdin=$request->linkdin;
        if ($request->hasFile('logo')) {
            $imageName =rand(100,1000000).time().'.'.$request->logo->extension();     
            $request->logo->move(public_path('/files/uploads/'), $imageName);
            $setting->logo=$imageName;           
           }
        $setting->save();
        return back()->with('success','Compnay Profile is update !!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Setting $setting)
    {
        //
    }
}
