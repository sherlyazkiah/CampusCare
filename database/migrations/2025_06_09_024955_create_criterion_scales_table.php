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
        Schema::create('criterion_scales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('criterion_id'); // FK ke tabel criteria
            $table->unsignedTinyInteger('scale_value'); // 1 sampai 5
            $table->string('scale_description');
            $table->timestamps();

            $table->foreign('criterion_id')
                  ->references('criterion_id')
                  ->on('criteria')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('criterion_scales');
    }
};
