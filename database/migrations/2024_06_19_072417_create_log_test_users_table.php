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
        Schema::create('log_test_users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_test');
            $table->foreign('id_test')->references('id')->on('test_descriptions');
            $table->uuid('id_biodata');
            $table->foreign('id_biodata')->references('id')->on('biodatas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log_test_users');
    }
};
