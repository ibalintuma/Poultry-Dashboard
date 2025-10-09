<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('stock_transfers', function (Blueprint $table) {
            $table->id();
            //stock_id, quantity, finance_id, comment, direction
            $table->foreignId('stock_id')->nullable()->constrained()->onDelete('cascade')->nullOnDelete();
            $table->foreignId('finance_id')->nullable()->constrained()->onDelete('cascade')->nullOnDelete();
            $table->double("quantity")->default(0);
            $table->string("direction")->nullable();
            $table->text("comment")->nullable();


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_transfers');
    }
};
