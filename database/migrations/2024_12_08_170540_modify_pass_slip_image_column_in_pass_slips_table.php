<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyPassSlipImageColumnInPassSlipsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('pass_slips', function (Blueprint $table) {
            // Make the pass_slip_image column not nullable
            $table->string('pass_slip_image')->nullable(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pass_slips', function (Blueprint $table) {
            // Revert back to nullable if rollback is needed
            $table->string('pass_slip_image')->nullable()->change();
        });
    }
}
