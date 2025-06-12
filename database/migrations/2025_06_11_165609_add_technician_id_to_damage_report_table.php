<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('damage_report', function (Blueprint $table) {
            $table->unsignedBigInteger('technician_id')->nullable();
            $table->foreign('technician_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('damage_report', function (Blueprint $table) {
            $table->dropForeign(['technician_id']);
            $table->dropColumn('technician_id');
        });
    }
};