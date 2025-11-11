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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            /*
            - name
            - phone
            - role
            - type
            - comment*/
            $table->string('name')->nullable();
            $table->string('phone')->nullable();
            $table->string('role')->nullable();
            $table->string('type')->nullable();
            $table->text('comment')->nullable();
            $table->text('address')->nullable();
            $table->text('status')->nullable();
            //name, phone, role, type, comment,address,status
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
