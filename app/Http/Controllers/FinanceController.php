<?php

namespace App\Http\Controllers;

use App\Models\Finance;
use Illuminate\Http\Request;

class FinanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("dashboard.finances.index",[
                "list"=>Finance::orderBy("date","desc")->get()->map(function($item){
                    $item->farm = \App\Models\Farm::find($item->farm_id);
                    $item->flock = \App\Models\Flock::find($item->flock_id);
                    return $item;
                })
              ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      $farms = \App\Models\Farm::all();
      $flocks = \App\Models\Flock::all();
        return view("dashboard.finances.create",["farms"=>$farms,"flocks"=>$flocks]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
                  $obj = new Finance();
                          $obj->type = $request->type;
                          $obj->name = $request->name;
                          $obj->amount = $request->amount;
                          $obj->date = $request->date;
                          $obj->comment = $request->comment;
                          $obj->flock_id = $request->flock_id;
                          $obj->farm_id = $request->farm_id;

                          if ($files = $request->file('picture')){
                              $fName = time().'.'.$request->picture->extension();
                              $request->picture->move(public_path("images"), $fName);
                              $obj->picture = url("images/".$fName);
                          }

                          $obj->save();

                          return redirect()->route('finances.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Finance $finance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Finance $finance)
    {
        $farms = \App\Models\Farm::all();
        $flocks = \App\Models\Flock::all();
        return view("dashboard.finances.edit", ["obj" => $finance, "farms"=>$farms,"flocks"=>$flocks]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Finance $finance)
    {
          $obj = $finance;
          $obj->type = $request->type;
          $obj->name = $request->name;
          $obj->amount = $request->amount;
          $obj->date = $request->date;
          $obj->comment = $request->comment;
          $obj->flock_id = $request->flock_id;
          $obj->farm_id = $request->farm_id;
          $obj->status = $request->status;

          if ($files = $request->file('picture')){
              $fName = time().'.'.$request->picture->extension();
              $request->picture->move(public_path("images"), $fName);
              $obj->picture = url("images/".$fName);
          }

          $obj->save();

          return redirect()->route('finances.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Finance $finance)
    {
        $finance->delete();
        return redirect()->route('finances.index');
    }
}
