<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Speciality;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class SpecialityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $specialities = Speciality::orderBy('id', 'DESC')->get();
        return view('admin.speciality.index')->with('specialities', $specialities);
    }

    /**
     *Store a newly created resource in storage.
     *@param \Illuminate\Http\Request $request
     *@return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:specialities,name',
            'typical_name' => 'required|unique:specialities,typical_name',
            'profession_name' => 'required|unique:specialities,profession_name',
            'icon' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $speciality = new Speciality();

        $speciality->name = $request->input('name');
        $speciality->typical_name = $request->input('typical_name');
        $speciality->profession_name = $request->input('profession_name');
        $speciality->description = $request->input('description');

        if ($request->hasFile('icon')) {
            $icon = $request->file('icon');
            $filename = time() . '.' . $icon->getClientOriginalExtension();
            $path = public_path('images/specialities/' . $filename);
            Image::make($icon->getRealPath())->resize(300, 300)->save($path);
            $speciality->icon = $filename;
        }

        $speciality->save();

        return redirect()->back()->with('success', 'Speciality added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Speciality  $speciality
     * @return \Illuminate\Http\Response
     */
    public function show(Speciality $speciality)
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
        // Retrieve the speciality by ID
        $speciality = Speciality::find($id);

        // Update the speciality's attributes from the form input
        $speciality->name = $request->input('name');
        $speciality->typical_name = $request->input('typical_name');
        $speciality->profession_name = $request->input('profession_name');
        $speciality->description = $request->input('description');

        // Check if a new icon file was uploaded
        if ($request->hasFile('icon')) {
            $icon = $request->file('icon');
            $filename = time() . '.' . $icon->getClientOriginalExtension();
            $path = public_path('images/specialities/' . $filename);
            // Resize and save the icon image
            Image::make($icon->getRealPath())->resize(300, 300)->save($path);
            // Update the speciality's icon attribute with the new filename
            $speciality->icon = $filename;
        }

        // Save the updated speciality to the database
        $speciality->save();

        // Redirect back to the specialities index page with a success message
        return redirect()->route('speciality.index')->with('success', 'Speciality updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Speciality  $speciality
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = Speciality::where('id', $id)->delete();
        // check data deleted or not
        if ($delete) {
            $success = true;
            $message = "User deleted successfully";
        } else {
            $success = true;
            $message = "User not found";
        }
        //  Return response
        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }
}
