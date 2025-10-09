<?php

namespace App\Http\Controllers;

use App\Models\Treatment;
use Illuminate\Http\Request;

class TreatmentController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      $treats = Treatment::all()->map(function($item){
        $item->farm = \App\Models\Farm::find($item->farm_id);
        $item->flock = \App\Models\Flock::find($item->flock_id);
        return $item;
      });
        return view("dashboard.treatments.index",[
          "list"=>$treats
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      $farms = \App\Models\Farm::all();
      $flocks = \App\Models\Flock::all();
        return view("dashboard.treatments.create",[
          "farms"=>$farms,
          "flocks"=>$flocks,
          ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
              $obj = new Treatment();
                      $obj->farm_id = $request->farm_id;
                      $obj->flock_id = $request->flock_id;
                      $obj->treatment = $request->treatment;
                      $obj->diagnosis = $request->diagnosis;
                      $obj->medication = $request->medication;
                      $obj->date = $request->date;
                      $obj->comment = $request->comment;
                      $obj->days = $request->days;
                      $obj->save();

                      return redirect()->route('treatments.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Treatment $treatment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Treatment $treatment)
    {
      $farms = \App\Models\Farm::all();
      $flocks = \App\Models\Flock::all();
        return view("dashboard.treatments.edit", ["obj" => $treatment, "farms"=>$farms, "flocks"=>$flocks]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Treatment $treatment)
    {
          $obj = $treatment;
          $obj->farm_id = $request->farm_id;
          $obj->flock_id = $request->flock_id;
          $obj->treatment = $request->treatment;
          $obj->diagnosis = $request->diagnosis;
          $obj->medication = $request->medication;
          $obj->date = $request->date;
          $obj->comment = $request->comment;
          $obj->days = $request->days;
          $obj->save();

          return redirect()->route('treatments.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Treatment $treatment)
    {
      $treatment->delete();
      return redirect()->route('treatments.index');
    }
}
