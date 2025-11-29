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
        Schema::create('stock_quantities', function (Blueprint $table) {
            $table->id();
            /*- stock id
              - type / manual, auto
              - quantity / double
              - comment
              - date
              */
            $table->unsignedBigInteger('stock_id')->nullable();
            $table->string('type')->nullable();
            $table->double('quantity')->default(0);
            $table->text('comment')->nullable();
            $table->date('date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_quantities');
    }
};
