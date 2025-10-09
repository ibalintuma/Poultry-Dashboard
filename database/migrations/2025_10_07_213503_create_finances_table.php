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
        Schema::create('finances', function (Blueprint $table) {
            $table->id();
            //type; income, expense, debt, loan; name, amount, date, comment, flock_id (nullable), farm_id (nullable), picture, status (pending, completed)
            $table->string('type')->default('income');
            $table->string('name')->nullable();
            $table->double("amount")->default(0);
            $table->date('date')->nullable();
            $table->text('comment')->nullable();
            $table->foreignId('flock_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('farm_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('picture')->nullable();
            $table->string('status')->default('pending');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('finances');
    }
};
