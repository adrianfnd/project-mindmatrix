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
        Schema::create('pilihan_summaries', function (Blueprint $table) {
            $table->id();
            $table->string('nama_bakat');
            $table->string('singkatan');
            $table->text('keterangan');
            $table->unsignedBigInteger('id_test');
            $table->foreign('id_test')->references('id')->on('test_descriptions');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pilihan_summaries');
    }
};
