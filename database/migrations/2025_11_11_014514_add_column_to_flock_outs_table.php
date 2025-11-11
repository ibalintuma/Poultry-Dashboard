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
        Schema::table('flock_outs', function (Blueprint $table) {
            //type
            $table->string('type')->default('died');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('flock_outs', function (Blueprint $table) {
            $table->dropColumn('type');
        });
    }
};
