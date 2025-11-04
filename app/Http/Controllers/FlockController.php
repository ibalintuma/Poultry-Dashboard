<?php

namespace App\Http\Controllers;

use App\Models\Farm;
use App\Models\Flock;
use Illuminate\Http\Request;

class FlockController extends Controller
{


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("dashboard.flocks.index",[
            "list"=>Flock::get()->map(function($item){
                $item->farm = Farm::find($item->farm_id);
                $item->quantity_out = \App\Models\FlockOut::where("flock_id",$item->id)->sum("quantity");
                $item->quantity_current = $item->quantity - $item->quantity_out;
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
      $statuses = ['pending', 'deposited', 'paid', 'received', 'ongoing', 'sold'];
        return view("dashboard.flocks.create",["farms"=>$farms, "statuses"=>$statuses]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
              $obj = new Flock();
                      $obj->name = $request->name;
                      $obj->quantity = $request->quantity;
                      $obj->farm_id = $request->farm_id;
                      $obj->type = $request->type;
                      $obj->date = $request->date;
                      $obj->seller = $request->seller;
                      $obj->status = $request->status;

                      if ($files = $request->file('picture')){
                          $fName = time().'.'.$request->picture->extension();
                          $request->picture->move(public_path("images"), $fName);
                          $obj->picture = url("images/".$fName);
                      }

                      $obj->save();

                      return redirect()->route('flocks.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Flock $flock)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Flock $flock)
    {
        $farms = \App\Models\Farm::all();
      $statuses = ['pending', 'deposited', 'paid', 'received', 'ongoing', 'sold'];
        return view("dashboard.flocks.edit", ["obj" => $flock, "farms"=>$farms, "statuses"=>$statuses]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Flock $flock)
    {
          $obj = $flock;
          $obj->name = $request->name;
          $obj->quantity = $request->quantity;
          $obj->farm_id = $request->farm_id;
          $obj->type = $request->type;
      $obj->date = $request->date;
      $obj->seller = $request->seller;
      $obj->status = $request->status;

          if ($files = $request->file('picture')){
              $fName = time().'.'.$request->picture->extension();
              $request->picture->move(public_path("images"), $fName);
              $obj->picture = url("images/".$fName);
          }

          $obj->save();

          return redirect()->route('flocks.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Flock $flock)
    {
          $flock->delete();
          return redirect( url()->previous() );
    }
}
