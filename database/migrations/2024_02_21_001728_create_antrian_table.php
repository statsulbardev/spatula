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
        Schema::table('m_satker', function (Blueprint $table) {
            $table->unique(['kode_satker']);
        });
        Schema::table('m_layanan', function (Blueprint $table) {
            $table->unique(['kode_layanan']);
        });

        Schema::create('m_antrian_satker_layanan', function (Blueprint $table) {
            $table->char('kode_satker',4);
            $table->char('kode_layanan',2);
            $table->char('loket',1)->default('A');
            $table->char('is_active',1)->default('0'); // 0: non active 1: active
            $table->timestamps();

            $table->primary(['kode_satker', 'kode_layanan']);

            $table->foreign('kode_satker')
                ->references('kode_satker')
                ->on('m_satker')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('kode_layanan')
                ->references('kode_layanan')
                ->on('m_layanan')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        Schema::create('d_antrian_satker_config_view', function (Blueprint $table) {
            $table->char('kode_satker',4);
            $table->string('config_key', 50); //running text, 
            $table->tinyInteger('config_index');
            $table->string('config_value', 1024);
            $table->timestamps();

            $table->primary(['kode_satker', 'config_key', 'config_index']);

            $table->foreign('kode_satker')
                ->references('kode_satker')
                ->on('m_satker')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        Schema::create('d_antrian_satker', function (Blueprint $table) {
            $table->string('id', 36)->primary();
            $table->char('kode_satker',4);
            $table->char('kode_layanan',2);
            $table->string('konsumen_nama', 255);
            $table->string('konsumen_tahun_lahir', 4);
            $table->date('tanggal');
            $table->string('status', 1)->default('0');
            $table->string('antrian', 3);
            $table->string('konsumen_email', 255)->nullable();
            $table->string('konsumen_no_wa_telepon', 15)->nullable();
            $table->text('deskripsi')->nullable();
            $table->string('sudah_nilai', 1)->default('0');
            
            $table->index(['kode_satker']);
            $table->index(['kode_layanan']);

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('kode_satker')
                ->references('kode_satker')
                ->on('m_satker')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('kode_layanan')
                ->references('kode_layanan')
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
        Schema::dropIfExists('d_antrian_satker_config_view');
        Schema::dropIfExists('m_antrian_satker_layanan');
    }
};
