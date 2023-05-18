<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMSatkerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_satker', function (Blueprint $table) {
            $table->id();
            $table->char('kode_satker', 4)->unique();
            $table->string('nama', 100);
            $table->char('level', 1);
            $table->string('alamat');
            $table->string('web', 50)->nullable();
            $table->string('telepon', 12)->nullable();
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
        Schema::dropIfExists('m_satker');
    }
}
