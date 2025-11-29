<?php

namespace App\Console\Commands;

use App\Models\Stock;
use App\Models\StockQuantity;
use Illuminate\Console\Command;

class GenerateStockQuantities extends Command
{
  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'stocks:generate-quantities';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Generate daily stock quantities snapshot for all stocks';

  /**
   * Execute the console command.
   */
  public function handle()
  {
    $this->info('Generating stock quantities.. .');

    $stocks = Stock::all();
    foreach ($stocks as $stock) {
      $d = now()->toDateString();

      //if there is a record for this stock today, skip
      $existing = StockQuantity::where('stock_id', $stock->id)
        ->where('date', $d)
        ->first();

        if ($existing) {
          continue;
        }

        $obj = new StockQuantity();
        $obj->stock_id = $stock->id;
        $obj->type = 'auto';
        $obj->quantity = $stock->quantity;
        $obj->comment = 'Auto-generated daily snapshot';
        $obj->date = $d;
        $obj->save();

    }

    return Command::SUCCESS;
  }
}
