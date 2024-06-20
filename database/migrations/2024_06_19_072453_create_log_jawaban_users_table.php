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
        Schema::create('log_jawaban_users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_log');
            $table->foreign('id_log')->references('id')->on('log_test_users');
            $table->unsignedBigInteger('id_pertanyaan');
            $table->foreign('id_pertanyaan')->references('id')->on('pilihan_jawabans');
            $table->boolean('jawaban');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log_jawaban_users');
    }
};
