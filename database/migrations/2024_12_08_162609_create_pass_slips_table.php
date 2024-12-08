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
        Schema::create('pass_slips', function (Blueprint $table) {
            $table->id('pass_slip_id');
            $table->foreignId('user_id')->constrained('users', 'user_id')->onDelete('cascade');
            $table->text('reason');  // Reason for leaving
            $table->timestamp('time_out');  // Time when employee leaves
            $table->timestamp('time_in')->nullable();  // Time when employee returns (nullable)
            $table->string('pass_slip_image')->nullable();  // Path to uploaded pass slip image (nullable)
            $table->string('status')->default('pending');  // Pass slip status (default is 'pending')
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pass_slips');
    }
};
