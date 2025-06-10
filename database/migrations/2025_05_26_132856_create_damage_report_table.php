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
        Schema::create('damage_report', function (Blueprint $table) {
            $table->id('damage_report_id');
            $table->string('report_name', 100);
            $table->text('description');
           //$table->enum('damage_level', ['Very Minor (Minimal Damage)', 'Minor (Still Functions Well)', 'Moderate (Function Disrupted)', 'Major (Hardly Functions)', 'Severe (Not Usable)']);
            $table->enum('status', ['Repaired', 'In Progress', 'Cancelled', 'In review', 'pending']);
            $table->unsignedTinyInteger('c1')->nullable(); // Usage frequency (user)
            $table->unsignedTinyInteger('c2')->nullable(); // Safety concern (admin)
            $table->unsignedTinyInteger('c3')->nullable(); // Repair urgency (admin)
            $table->unsignedTinyInteger('c4')->nullable(); // Impact on people (admin)
            $table->unsignedTinyInteger('c5')->nullable();
             $table->unsignedTinyInteger('c6')->nullable();
            $table->timestamps();

            // Relasi ke user
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('role_id');

            // Relasi ke room dan floor
            $table->unsignedBigInteger('room_id');
            $table->unsignedBigInteger('floor_id');

            $table->unsignedBigInteger('facility_id');


            // Foreign keys
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('role_id')->references('role_id')->on('roles')->onDelete('cascade');
            $table->foreign('room_id')->references('room_id')->on('rooms')->onDelete('cascade');
            $table->foreign('floor_id')->references('floor_id')->on('floors')->onDelete('cascade');
            $table->foreign('facility_id')->references('facility_id')->on('facilities')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('damage_report');
    }
};
