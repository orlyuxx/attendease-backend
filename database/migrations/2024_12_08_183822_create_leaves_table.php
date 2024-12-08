<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeavesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('leaves', function (Blueprint $table) {
            $table->id('leave_id');
            $table->foreignId('user_id')->constrained('users', 'user_id')->onDelete('cascade');
            $table->foreignId('leave_type_id')->constrained('leave_types', 'leave_type_id')->onDelete('cascade');
            $table->date('leave_start'); // Changed from leave_date to leave_start
            $table->date('leave_end');   // Added leave_end column
            $table->text('reason'); // Added reason column
            $table->integer('number_of_days');
            $table->string('status')->default('pending'); // Added status column with default value 'pending'
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
}
