<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDPenilaianTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('d_penilaian', function (Blueprint $table) {
            $table->id();
            $table->string('nama_konsumen', 40);
            $table->bigInteger('kode_layanan');
            $table->char('rating_layanan', 1);
            $table->string('email_konsumen', 40)->unique()->nullable();
            $table->string('no_wa_telepon', 15)->nullable();
            $table->bigInteger('kode_petugas')->nullable();
            $table->char('rating_petugas', 1)->nullable();
            $table->json('kode_saran')->nullable();
            $table->text('saran_pengaduan')->nullable();
            $table->dateTime('tanggal_notifikasi')->nullable();
            $table->dateTime('tanggal_kategorisasi')->nullable();
            $table->dateTime('tanggal_tl_pj_layanan')->nullable();
            $table->text('text_pj_layanan')->nullable();
            $table->dateTime('tanggal_tl_pj_pengaduan')->nullable();
            $table->text('text_pj_pengaduan')->nullable();
            $table->tinyInteger('selesai');
            $table->dateTime('tanggal_selesai')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('d_penilaian');
    }
}
