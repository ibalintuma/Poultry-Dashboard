<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use App\Models\StockTransfer;
use Illuminate\Http\Request;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      $stocks = Stock::get()->map(function($item){
          $item->farm = \App\Models\Farm::find($item->farm_id);
          $item->quantity_add = StockTransfer::where('stock_id',$item->id)->where('direction',"add")->sum('quantity');
          $item->quantity_subtract = StockTransfer::where('stock_id',$item->id)->where('direction',"subtract")->sum('quantity');
          $item->quantity_current = $item->quantity_add - $item->quantity_subtract;
          return $item;
        });

      //return $stocks;

        return view("dashboard.stocks.index",[
                "list"=> $stocks
              ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
      $farms = \App\Models\Farm::all();
        return view("dashboard.stocks.create",[
          "farms"=>$farms,
          ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
                  $obj = new Stock();
                          $obj->name = $request->name;
                          $obj->units = $request->units;
                          $obj->comment = $request->comment;
                          $obj->farm_id = $request->farm_id;

                          if ($files = $request->file('picture')){
                              $fName = time().'.'.$request->picture->extension();
                              $request->picture->move(public_path("images"), $fName);
                              $obj->picture = url("images/".$fName);
                          }

                          $obj->save();

                          return redirect()->route('stocks.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Stock $stock)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Stock $stock)
    {
        $farms = \App\Models\Farm::all();
        return view("dashboard.stocks.edit", ["obj" => $stock, "farms"=>$farms]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Stock $stock)
    {
          $obj = $stock;
          $obj->name = $request->name;
          $obj->units = $request->units;
          $obj->comment = $request->comment;
          $obj->farm_id = $request->farm_id;

          if ($files = $request->file('picture')){
              $fName = time().'.'.$request->picture->extension();
              $request->picture->move(public_path("images"), $fName);
              $obj->picture = url("images/".$fName);
          }

          $obj->save();

          return redirect()->route('stocks.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Stock $stock)
    {
        $stock->delete();
        return redirect()->route('stocks.index');
    }
}
