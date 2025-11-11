<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("dashboard.contacts.index",[
                "list"=>Contact::all()
              ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("dashboard.contacts.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      //name, phone, role, type, comment,address,status
        $obj = new Contact();
                $obj->name = $request->name;
                $obj->phone = $request->phone;
                $obj->role = $request->role;
                $obj->type = $request->type;
                $obj->comment = $request->comment;
                $obj->address = $request->address;
                $obj->status = $request->status;
      //email, enable_sms_notifications, enable_email_notifications
      $obj->email = $request->email;
      $obj->enable_sms_notifications = $request->enable_sms_notifications ? true : false;
      $obj->enable_email_notifications = $request->enable_email_notifications ? true : false;
                $obj->save();

                return redirect()->route('contacts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Contact $contact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contact $contact)
    {
        return view("dashboard.contacts.edit", ["obj" => $contact]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contact $contact)
    {
        $obj = $contact;
                $obj->name = $request->name;
                $obj->phone = $request->phone;
                $obj->role = $request->role;
                $obj->type = $request->type;
                $obj->comment = $request->comment;
                $obj->address = $request->address;
                $obj->status = $request->status;

      $obj->email = $request->email;
      $obj->enable_sms_notifications = $request->enable_sms_notifications ? true : false;
      $obj->enable_email_notifications = $request->enable_email_notifications ? true : false;

                $obj->save();

                return redirect()->route('contacts.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();
        return redirect()->route('contacts.index');
    }
}
