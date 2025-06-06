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
        Schema::create('biodata', function (Blueprint $table) {
            $table->id('id_number');
            $table->foreignId('id_user')->constrained('users')->onDelete('cascade');
            $table->string('name');

            $table->unsignedBigInteger('role_id');
            $table->foreign('role_id')->references('role_id')->on('roles');

            $table->string('title');
            $table->string('email')->unique();
            $table->timestamps();
            $table->string('photo')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('biodata');
    }
};
