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
        Schema::table('attendance_records', function (Blueprint $table) {
            // Add total_hours column to store the calculated hours (float type for decimal values)
            $table->float('total_hours')->nullable()->after('time_out_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('attendance_records', function (Blueprint $table) {
            // Drop the total_hours column if we rollback the migration
            $table->dropColumn('total_hours');
        });
    }
};
