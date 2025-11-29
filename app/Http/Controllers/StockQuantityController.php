<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use App\Models\StockQuantity;
use Illuminate\Http\Request;

class StockQuantityController extends Controller
{


  /**
   * Display a listing of the resource.
   */
  public function index(Request $request)
  {
    $query = StockQuantity::query();

    //stock_id
    if( $request->has("stock_id") && $request->stock_id != null ){
      $query->where("stock_id",$request->stock_id);
    }

    return view("dashboard.stock_quantities.index",[
      "list"=>$query->orderBy("date","desc")->get()->map(function($item){
        $item->stock = Stock::find($item->stock_id);
        return $item;
      })
    ]);
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create(Request $request)
  {
    $stocks = Stock::all();
    return view("dashboard.stock_quantities.create",[
      "stocks"=>$stocks,
      "stock_id"=>$request->stock_id,
      "type"=>$request->type,
    ]);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {

    //stock_id, type, quantity, comment, date
    $obj = new StockQuantity();
    $obj->stock_id = $request->stock_id;
    $obj->type = "manual";
    $obj->quantity = $request->quantity;
    $obj->comment = $request->comment;
    $obj->date = $request->date;
    $obj->save();

    //return redirect()->route('stock_quantities.index');
    return redirect( $request->previous_url );
  }

  /**
   * Display the specified resource.
   */
  public function show(StockQuantity $stockQuantity)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(StockQuantity $stockQuantity)
  {
    //if this is the last record in the table, allow edit
    $sq = StockQuantity::orderBy("id","desc")->where("stock_id",$stockQuantity->stock_id)->first();
    if( $sq != null) {
      if ($sq->id != $stockQuantity->id) {
        return redirect()->route('stock_quantities.index')->with("error", "Only the latest stock quantity can be edited.");
      }
    }


    $stocks = Stock::all();
    return view("dashboard.stock_quantities.edit", [
      "obj" => $stockQuantity,
      "stocks"=>$stocks
    ]);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, StockQuantity $stockQuantity)
  {


    $obj = $stockQuantity;
    $obj->stock_id = $request->stock_id;
    $obj->type = $request->type;
    $obj->quantity = $request->quantity;
    $obj->comment = $request->comment;
    $obj->date = $request->date;

    $obj->save();

    return redirect()->route('stock_quantities.index');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(StockQuantity $stockQuantity)
  {

    $stockQuantity->delete();
    return redirect( url()->previous() );
  }
}
