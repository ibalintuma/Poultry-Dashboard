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
        Schema::create('flock_outs', function (Blueprint $table) {
            $table->id();
            //flock_id, quantity, reason, date, comment
            $table->foreignId('flock_id')->constrained()->onDelete('cascade');
            $table->integer('quantity')->default(0);
            $table->string('reason')->nullable();
            $table->date('date')->nullable();
            $table->text('comment')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flock_outs');
    }
};
