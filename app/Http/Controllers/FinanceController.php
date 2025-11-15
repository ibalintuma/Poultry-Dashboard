<?php

namespace App\Http\Controllers;

use App\Models\Finance;
use Illuminate\Http\Request;

class FinanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
      $builder = Finance::orderBy("date","desc");

      //parent_id
      $parent_id = $request->input("parent_id");
      if($parent_id){
          $builder->where("parent_id",$parent_id);
      }

      //type
      $type = $request->input("type");
      if($type){
          $builder->where("type",$type);
      }

        return view("dashboard.finances.index",[
                "list"=>$builder->get()->map(function($item){
                    $item->farm = \App\Models\Farm::find($item->farm_id);
                    $item->flock = \App\Models\Flock::find($item->flock_id);
                    $item->contact = \App\Models\Contact::find($item->contact_id);
                    $item->parent = \App\Models\Finance::find($item->parent_id);
                    return $item;
                })
              ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      $categories = ['General',"Feeding","Treatment",'Building',"Labor","Transport", 'Operational','Emergency','Miscellaneous'];
      $farms = \App\Models\Farm::all();
      $flocks = \App\Models\Flock::all();
      $contacts = \App\Models\Contact::all();
      $finances = \App\Models\Finance::where("type","capital")->orderBy("id","desc")->get();
        return view("dashboard.finances.create",["farms"=>$farms,"flocks"=>$flocks, "contacts"=>$contacts, "finances"=>$finances, "categories"=>$categories]);
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
                          $obj->contact_id = $request->contact_id;
                          $obj->parent_id = $request->parent_id;

                          //category, affects_profits
                          $obj->category = $request->category;
                          $obj->affects_profits = $request->affects_profits;
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
      $categories = ['General',"Feeding","Treatment",'Building',"Labor","Transport", 'Operational','Emergency','Miscellaneous'];
        $farms = \App\Models\Farm::all();
        $flocks = \App\Models\Flock::all();
        $contacts = \App\Models\Contact::all();
      $finances = \App\Models\Finance::where("type","capital")->orderBy("id","desc")->get();
        return view("dashboard.finances.edit", ["obj" => $finance, "farms"=>$farms,"flocks"=>$flocks, "contacts"=>$contacts, "finances"=>$finances, "categories"=>$categories ]);
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
          $obj->contact_id = $request->contact_id;
          $obj->parent_id = $request->parent_id;

          $obj->category = $request->category;
          $obj->affects_profits = $request->affects_profits;

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
