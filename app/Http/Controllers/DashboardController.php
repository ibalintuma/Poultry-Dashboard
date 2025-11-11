<?php

namespace App\Http\Controllers;

use App\Models\Finance;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
      $financial_types = Finance::distinct("type")->pluck('type')->map(function($item){
        $item_total = Finance::where("type",$item)->sum('amount');
        return [
          "type"=>$item,
          "amount"=>$item_total
        ];
      });


      $daily_data_for_last_30_days = [];
      for($i=30; $i>=0; $i--){
        $date = now()->subDays($i)->format("Y-m-d");
        $daily_expense = Finance::where("type","expense")->whereDate("date",$date)->sum("amount");
        $daily_debt = Finance::where("type","debt")->whereDate("date",$date)->sum("amount");
        $daily_income = Finance::where("type","income")->whereDate("date",$date)->sum("amount");
        $daily_capital = Finance::where("type","capital")->whereDate("date",$date)->sum("amount");
        $daily_data_for_last_30_days[] = [
          "date"=>$date,
          "expense"=>$daily_expense,
          "debt"=>$daily_debt,
          "income"=>$daily_income,
          "capital"=>$daily_capital
        ];
      }


        return view('dashboard.analytics.index',[
          "expenses_total" => \App\Models\Finance::where("type","expense")->sum('amount'),

          "debt_total" => \App\Models\Finance::where("type","debt")->sum('amount'),
          "debt_paid_total" => \App\Models\Finance::where("type","debt")->where("status","cleared")->sum('amount'),

          "chickens_total" => \App\Models\Flock::sum('quantity'),
          "chicken_received_total" => \App\Models\Flock::whereIn("status",["ongoing","sold"])->sum('quantity'),

          "financial_types"=>$financial_types,
          "daily_data_for_last_30_days"=>$daily_data_for_last_30_days
        ]);
    }
}
