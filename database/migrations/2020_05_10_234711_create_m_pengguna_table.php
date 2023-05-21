<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMPenggunaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_pengguna', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 50);
            $table->string('username', 20);
            $table->string('email', 30)->unique();
            $table->string('password');
            $table->string('bpsid', 9)->unique()->nullable();
            $table->string('foto')->nullable();
            $table->char('kode_satker_id')->unique();
            $table->bigInteger('role_id');
            $table->tinyInteger('is_petugas');
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
        Schema::dropIfExists('m_pengguna');
    }
}
