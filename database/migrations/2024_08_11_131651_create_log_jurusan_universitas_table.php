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
        Schema::create('log_jurusan_universitas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_jurusan');
            $table->foreign('id_jurusan')->references('id')->on('jurusan_universitas');
            $table->unsignedBigInteger('id_universitas');
            $table->foreign('id_universitas')->references('id')->on('universitas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log_jurusan_universitas');
    }
};
