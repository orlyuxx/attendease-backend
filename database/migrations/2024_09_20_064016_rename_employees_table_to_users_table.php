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
        // Rename the employees table to users
        Schema::rename('employees', 'users');

        // Rename the employee_id to user_id
        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('employee_id', 'user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Reverse the changes in case of rollback
        Schema::rename('users', 'employees');

        Schema::table('employees', function (Blueprint $table) {
            $table->renameColumn('user_id', 'employee_id');
        });
    }
};
