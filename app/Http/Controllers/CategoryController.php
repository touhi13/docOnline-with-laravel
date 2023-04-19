<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $category = Category::orderBy('id', 'DESC')->get();
        return view('admin.category')->with('category', $category);
    }

    public function create_category(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $category = new Category();
        $category->name = $request->name;
        $category->des = $request->des;
        $imageName = time() . '.' . $request->logo->extension();
        $request->logo->move(public_path('images'), $imageName);
        $category->logo = $imageName;
        $category->save();
        return back()->with('success', 'You have successfully upload image.')
            ->with('image', $imageName);
    }

    public function delete($id)
    {
        $delete = Category::where('id', $id)->delete();
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