<?php

namespace App\Http\Controllers;

use App\Models\Finance;
use App\Models\Stock;
use App\Models\StockTransfer;
use Illuminate\Http\Request;

class StockTransferController extends Controller
{


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("dashboard.stock_transfers.index",[
        "list"=>StockTransfer::get()->map(function($item){
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
      //stock_id, quantity, finance_id, comment, direction
              $obj = new StockTransfer();
                      $obj->stock_id = $request->stock_id;
                      $obj->quantity = $request->quantity;
                      $obj->finance_id = $request->finance_id;
                      $obj->comment = $request->comment;
                      $obj->direction = $request->direction;
                      $obj->save();

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
      $obj->direction = $request->direction;
      $obj->save();

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
