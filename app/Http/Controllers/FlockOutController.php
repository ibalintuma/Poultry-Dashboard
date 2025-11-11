<?php

namespace App\Http\Controllers;

use App\Models\FlockOut;
use Illuminate\Http\Request;

class FlockOutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
      $flock_id = $request->input("flock_id");

      $builder = FlockOut::query();
      if($flock_id){
          $builder->where("flock_id",$flock_id);
      }

        return view("dashboard.flock_outs.index",[
                "list"=>$builder->orderBy("date","desc")->get()->map(function($item){
                    $item->flock = \App\Models\Flock::find($item->flock_id);
                    return $item;
                }),
                "flock_id"=>$flock_id
              ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $flocks = \App\Models\Flock::all();
        return view("dashboard.flock_outs.create",["flocks"=>$flocks, "flock_id"=>$request->input("flock_id")]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

                $obj = new FlockOut();
                        $obj->flock_id = $request->flock_id;
                        $obj->quantity = $request->quantity;
                        $obj->reason = $request->reason;
                        $obj->date = $request->date;
                        $obj->comment = $request->comment;
                        $obj->type = $request->type;
                        $obj->save();

                return redirect( $request->previous_url );
    }

    /**
     * Display the specified resource.
     */
    public function show(FlockOut $flockOut)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FlockOut $flockOut)
    {
      $flocks = \App\Models\Flock::all();
        return view("dashboard.flock_outs.edit", ["obj" => $flockOut,  "flocks"=>$flocks]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FlockOut $flockOut)
    {
              $obj = $flockOut;
              $obj->flock_id = $request->flock_id;
              $obj->quantity = $request->quantity;
              $obj->reason = $request->reason;
              $obj->date = $request->date;
              $obj->comment = $request->comment;
              $obj->type = $request->type;
              $obj->save();

              return redirect()->route('flock_outs.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FlockOut $flockOut)
    {
          $flockOut->delete();
          return redirect()->route('flock_outs.index');
    }
}
