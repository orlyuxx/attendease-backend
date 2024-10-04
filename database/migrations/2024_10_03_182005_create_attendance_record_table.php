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
        Schema::create('attendance_records', function (Blueprint $table) {
            $table->id('record_id');
            $table->foreignId('user_id')->constrained('users', 'user_id')->onDelete('cascade');
            $table->date('date');
            $table->time('time_in')->nullable();
            $table->string('status');
            $table->time('break_in')->nullable();
            $table->string('break_in_status')->nullable();
            $table->time('break_out')->nullable();
            $table->string('break_out_status')->nullable();
            $table->time('time_out')->nullable();
            $table->string('time_out_status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendance_record');
    }
};
