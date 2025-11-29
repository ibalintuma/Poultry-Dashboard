<?php

namespace App\Http\Controllers;

use App\Models\Finance;
use App\Models\Stock;
use App\Models\StockQuantity;
use App\Models\StockTransfer;
use Illuminate\Http\Request;

class StockTransferController extends Controller
{


    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
      $query = StockTransfer::query();

      //stock_id
      if( $request->has("stock_id") && $request->stock_id != null ){
        $query->where("stock_id",$request->stock_id);
      }

        return view("dashboard.stock_transfers.index",[
        "list"=>$query->orderBy("date","desc")->get()->map(function($item){
          $item->stock = Stock::find($item->stock_id);
          $item->finance  = Finance::find($item->finance_id);
          return $item;
        })
      ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $finances = Finance::all();
        $stocks = Stock::all();
        return view("dashboard.stock_transfers.create",[
          "stocks"=>$stocks,
          "finances"=>$finances,
          "direction"=>$request->direction,
          "stock_id"=>$request->stock_id,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

      $stock = Stock::find( $request->stock_id );


      //stock_id, quantity, finance_id, comment, direction
              $obj = new StockTransfer();
                      $obj->stock_id = $request->stock_id;
                      $obj->quantity = $request->quantity;
                      $obj->finance_id = $request->finance_id;
                      $obj->comment = $request->comment;
                      $obj->date = $request->date;
                      $obj->direction = $request->direction;
                      $obj->quantity_before = $stock->quantity;
                      if( $obj->direction == "add"){
                        $obj->quantity_after = $obj->quantity_before + $obj->quantity;
                      } else {
                        $obj->quantity_after = $obj->quantity_before - $obj->quantity;
                      }
                      $obj->save();

                      $stock->quantity = $obj->quantity_after;
                      $stock->save();

                      //return redirect()->route('stock_transfers.index');
        return redirect( $request->previous_url );
    }

    /**
     * Display the specified resource.
     */
    public function show(StockTransfer $stockTransfer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StockTransfer $stockTransfer)
    {
      //if this is the last record in the table, allow edit
      $st = StockTransfer::orderBy("id","desc")->where("stock_id",$stockTransfer->stock_id)->first();
      if( $st != null) {
        if ($st->id != $stockTransfer->id) {
          return redirect()->route('stock_transfers.index')->with("error", "Only the latest stock transfer can be edited.");
        }
      }


      $finances = Finance::all();
      $stocks = Stock::all();
        return view("dashboard.stock_transfers.edit", [
          "obj" => $stockTransfer,
          "stocks"=>$stocks,
          "finances"=>$finances
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, StockTransfer $stockTransfer)
    {


      $obj = $stockTransfer;
      $obj->stock_id = $request->stock_id;
      $obj->quantity = $request->quantity;
      $obj->finance_id = $request->finance_id;
      $obj->comment = $request->comment;
      $obj->date = $request->date;
      $obj->direction = $request->direction;

      if( $obj->direction == "add"){
        $obj->quantity_after = $obj->quantity_before + $obj->quantity;
      } else {
        $obj->quantity_after = $obj->quantity_before - $obj->quantity;
      }

      $obj->save();

      $stock = Stock::find( $obj->stock_id );
      $stock->quantity = $obj->quantity_after;
      $stock->save();

      return redirect()->route('stock_transfers.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StockTransfer $stockTransfer)
    {

              $stockTransfer->delete();
              return redirect( url()->previous() );
    }
}
