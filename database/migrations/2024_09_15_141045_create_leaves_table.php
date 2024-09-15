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
        Schema::create('leaves', function (Blueprint $table) {
            $table->id('leave_id');
            $table->foreignId('employee_id')->constrained('employees', 'employee_id')->onDelete('cascade');
            $table->date('leave_date');
            $table->integer('number_of_days');
            $table->foreignId('leave_type_id')->constrained('leave_types', 'leave_type_id')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leaves');
    }
};
