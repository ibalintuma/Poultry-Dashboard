<?php

namespace App\Http\Controllers;

use App\Models\Farm;
use App\Models\Flock;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FarmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("dashboard.farms.index",[
                "list"=>Farm::all()->map(function($farm){
                  $farm->user = User::find( $farm->user_id);
                  $farm->total_flock = Flock::where("farm_id",$farm->id)->sum("quantity");
                  return $farm;
                })
              ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("dashboard.farms.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
                $obj = new Farm();
                        $obj->name = $request->name;
                        $obj->user_id = Auth::id();
                        $obj->save();

                        return redirect()->route('farms.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Farm $farm)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Farm $farm)
    {
        return view("dashboard.farms.edit", ["obj" => $farm]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Farm $farm)
    {

              $obj = $farm;
              $obj->name = $request->name;
              $obj->save();

              return redirect()->route('farms.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Farm $farm)
    {

              $farm->delete();
              return redirect( url()->previous() );
    }
}
