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
        Schema::table('contacts', function (Blueprint $table) {
            //email, enable_sms_notifications, enable_email_notifications
          $table->string('email')->nullable();
          $table->boolean('enable_sms_notifications')->default(false);
          $table->boolean('enable_email_notifications')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contacts', function (Blueprint $table) {
            //
          $table->dropColumn('email');
          $table->dropColumn('enable_sms_notifications');
          $table->dropColumn('enable_email_notifications');
        });
    }
};
