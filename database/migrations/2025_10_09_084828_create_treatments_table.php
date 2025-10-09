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
        Schema::create('treatments', function (Blueprint $table) {
            $table->id();
            //farm_id, treatment, diagnosis, medication, date, comment
            $table->foreignId('farm_id')->constrained()->onDelete('cascade');
            $table->foreignId('flock_id')->constrained()->onDelete('cascade');
            $table->text('treatment')->nullable();
            $table->text('diagnosis')->nullable();
            $table->text('medication')->nullable();
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
        Schema::dropIfExists('treatments');
    }
};
