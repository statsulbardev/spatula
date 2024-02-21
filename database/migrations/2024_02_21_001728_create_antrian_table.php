<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_antrian_satker_layanan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_satker');
            $table->unsignedBigInteger('id_layanan');
            $table->timestamps();

            $table->foreign('id_satker')
                ->references('id')
                ->on('m_satker')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('id_layanan')
                ->references('id')
                ->on('m_layanan')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        Schema::create('d_antrian_satker_config_view', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_antrian_satker_layanan');
            $table->unsignedBigInteger('id_satker');
            $table->unsignedBigInteger('id_layanan');
            $table->string('config_key', 50); //running text, 
            $table->tinyInteger('config_index');
            $table->string('config_value', 1024);
            $table->timestamps();

            $table->foreign('id_antrian_satker_layanan')
                ->references('id')
                ->on('m_antrian_satker_layanan')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('id_satker')
                ->references('id')
                ->on('m_satker')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('id_layanan')
                ->references('id')
                ->on('m_layanan')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        Schema::create('d_antrian_satker', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_antrian_satker_layanan');
            $table->unsignedBigInteger('id_satker');
            $table->unsignedBigInteger('id_layanan');
            $table->string('konsumen_nama', 255);
            $table->string('konsumen_tahun_lahir', 4);
            $table->date('tanggal');
            $table->tinyInteger('antrian');
            $table->string('konsumen_email', 255)->nullable();
            $table->string('konsumen_no_wa_telepon', 15)->nullable();
            $table->text('deskripsi')->nullable();
            
            $table->timestamps();

            $table->foreign('id_antrian_satker_layanan')
                ->references('id')
                ->on('m_antrian_satker_layanan')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('id_satker')
                ->references('id')
                ->on('m_satker')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('id_layanan')
                ->references('id')
                ->on('m_layanan')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('d_antrian_satker');
        Schema::dropIfExists('d_antrian_satker_view');
        Schema::dropIfExists('m_antrian_satker_layanan');
    }
};
