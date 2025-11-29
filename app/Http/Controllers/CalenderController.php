<?php

namespace App\Http\Controllers;

use App\Models\Calender;
use Illuminate\Http\Request;

class CalenderController extends Controller
{

  /**
   * Mark a task as completed.
   */
  public function complete(Calender $calender)
  {
    $calender->status = 'Completed';
    $calender->save();

    return redirect()->back()->with('success', 'Task marked as completed! ');
  }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $builder = Calender::orderBy("date","desc");
        return view("dashboard.calenders.index",[
                "list"=>$builder->get()->map(function($item){
                    $item->contact = \App\Models\Contact::find($item->contact_id);
                    return $item;
                })
              ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      $contacts = \App\Models\Contact::all();
        return view("dashboard.calenders.create",[
            "contacts"=>$contacts
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      //date, type, title, description, amount, comment, status, priority, contact_id,
        $obj = new Calender();
                $obj->date = $request->date;
                $obj->type = $request->type;
                $obj->title = $request->title;
                $obj->description = $request->description;
                $obj->amount = $request->amount;
                $obj->comment = $request->comment;
                $obj->status = $request->status;
                $obj->priority = $request->priority;
                $obj->contact_id = $request->contact_id;
                $obj->save();

                return redirect()->route('calenders.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Calender $calender)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Calender $calender)
    {
        return view("dashboard.calenders.edit", ["obj" => $calender,
            "contacts"=>\App\Models\Contact::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Calender $calender)
    {
      //date, type, title, description, amount, comment, status, priority, contact_id,
        $obj = $calender;
                $obj->date = $request->date;
                $obj->type = $request->type;
                $obj->title = $request->title;
                $obj->description = $request->description;
                $obj->amount = $request->amount;
                $obj->comment = $request->comment;
                $obj->status = $request->status;
                $obj->priority = $request->priority;
                $obj->contact_id = $request->contact_id;
                $obj->save();

                return redirect()->route('calenders.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Calender $calender)
    {
        $calender->delete();
        return redirect()->route('calenders.index');
    }
}
