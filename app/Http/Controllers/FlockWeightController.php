<?php

namespace App\Http\Controllers;

use App\Models\FlockWeight;
use Illuminate\Http\Request;

class FlockWeightController extends Controller
{

  //flock_id, date, weight,comment

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return view("dashboard.flock_weights.index",[
                "list"=>FlockWeight::orderBy("date","desc")->get()->map(function($item){
                    $item->flock = \App\Models\Flock::find($item->flock_id);
                    return $item;
                }),
                  "flock_id"=>$request->input("flock_id")
              ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
      $flocks = \App\Models\Flock::all();
        return view("dashboard.flock_weights.create",[
          "flocks"=>$flocks,
          "flock_id"=>$request->input("flock_id")
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
              $obj = new FlockWeight();
                      $obj->flock_id = $request->flock_id;
                      $obj->date = $request->date;
                      $obj->weight = $request->weight;
                      $obj->comment = $request->comment;
                      $obj->save();

              return redirect( $request->previous_url );
    }

    /**
     * Display the specified resource.
     */
    public function show(FlockWeight $flockWeight)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FlockWeight $flockWeight)
    {
      $flocks = \App\Models\Flock::all();
        return view("dashboard.flock_weights.edit", ["obj" => $flockWeight, "flocks"=>$flocks]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FlockWeight $flockWeight)
    {
              $flockWeight->flock_id = $request->flock_id;
              $flockWeight->date = $request->date;
              $flockWeight->weight = $request->weight;
              $flockWeight->comment = $request->comment;
              $flockWeight->save();

              return redirect( $request->previous_url );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FlockWeight $flockWeight)
    {
        $flockWeight->delete();
        return redirect()->route('flock_weights.index');
    }
}
