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
        Schema::create('flock_weights', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('flock_id');
            $table->date('date')->nullable();
            $table->double('weight')->nullable();
            $table->text('comment')->nullable();
            //flock_id, date, weight,comment
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flock_weights');
    }
};
