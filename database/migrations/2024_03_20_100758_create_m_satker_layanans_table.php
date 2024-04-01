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
        Schema::create('m_satker_layanan', function (Blueprint $table) {
            $table->unsignedBigInteger('m_satker_id');
            $table->unsignedBigInteger('m_layanan_id');
            $table->foreign('m_satker_id')->references('id')->on('m_satker')->onDelete('cascade');
            $table->foreign('m_layanan_id')->references('id')->on('m_layanan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_satker_layanan');
    }
};
