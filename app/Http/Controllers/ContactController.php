<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;
use date;

class ContactController extends Controller
{
    public function contact(Request $request){
        $contact= new Contact;
        $contact->user_id=$request->did;
        $contact->pname=$request->pname;
        $contact->pphone=$request->pphone;
        $contact->pemail=$request->pemail;
        $contact->pdetails= $request->pdetails;
        $contact->cr_date= date('Y-m-d');
        $contact->save();
        return back()->with('success','Contact has been Successfully!');

    }
}
