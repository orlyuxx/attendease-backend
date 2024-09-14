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
        // Rename the 'users' table to 'employees'
        Schema::rename('users', 'employees');

        // Rename the primary key column 'id' to 'employee_id'
        Schema::table('employees', function (Blueprint $table) {
            $table->renameColumn('id', 'employee_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert column name back to 'id'
        Schema::table('employees', function (Blueprint $table) {
            $table->renameColumn('employee_id', 'id');
        });

        // Rename the 'employees' table back to 'users'
        Schema::rename('employees', 'users');
    }
};
