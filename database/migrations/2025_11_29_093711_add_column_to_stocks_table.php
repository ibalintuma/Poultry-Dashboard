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
        Schema::table('stocks', function (Blueprint $table) {
            //alert_quantity, priority_level,unit_price, supplier_id
            $table->double('quantity')->default(0);
            $table->double('alert_quantity')->default(0);
            $table->string('priority_level')->nullable();
            $table->double('unit_price')->default(0);
            $table->unsignedBigInteger('supplier_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('stocks', function (Blueprint $table) {
            //
            $table->dropColumn('quantity');
            $table->dropColumn('alert_quantity');
            $table->dropColumn('priority_level');
            $table->dropColumn('unit_price');
            $table->dropColumn('supplier_id');
        });
    }
};
