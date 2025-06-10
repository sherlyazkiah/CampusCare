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
        Schema::create('facilities', function (Blueprint $table) {
            $table->id('facility_id');
            $table->string('facility_name', 100); 
            $table->integer('jumlah')->nullable();

            // Relasi ke room dan floor
            $table->unsignedBigInteger('room_id');
            $table->unsignedBigInteger('floor_id');

            // Foreign keys
            $table->foreign('room_id')->references('room_id')->on('rooms')->onDelete('cascade');
            $table->foreign('floor_id')->references('floor_id')->on('floors')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('facilities');
    }
};
