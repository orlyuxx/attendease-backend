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
        Schema::table('users', function (Blueprint $table) {
            // Add new columns
            $table->string('image')->nullable();
            $table->string('gender')->nullable();
            $table->unsignedBigInteger('department_id')->nullable();
            $table->unsignedBigInteger('shift_id')->nullable();

            // Add foreign key constraints
            $table->foreign('department_id')->references('department_id')->on('departments');
            $table->foreign('shift_id')->references('shift_id')->on('shifts');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Drop foreign key constraints
            $table->dropForeign(['department_id']);
            $table->dropForeign(['shift_id']);

            // Drop columns
            $table->dropColumn(['image', 'gender', 'department_id', 'shift_id']);
        });
    }
};
