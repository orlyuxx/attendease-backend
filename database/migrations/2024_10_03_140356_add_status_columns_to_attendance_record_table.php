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
        Schema::table('attendance_record', function (Blueprint $table) {
            $table->string('time_in_status')->nullable()->after('time_in');
            $table->string('break_in_status')->nullable()->after('break_in');
            $table->string('break_out_status')->nullable()->after('break_out');
            $table->string('time_out_status')->nullable()->after('time_out');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('attendance_record', function (Blueprint $table) {
            $table->dropColumn('time_in_status');
            $table->dropColumn('break_in_status');
            $table->dropColumn('break_out_status');
            $table->dropColumn('time_out_status');
        });
    }
};
