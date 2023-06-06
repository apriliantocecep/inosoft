<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKendaraansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kendaraans', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('tahun_keluaran');
            $table->string('warna');
            $table->integer('harga');
            $table->string('mesin');
            $table->string('tipe_suspensi');
            $table->string('tipe_transmisi');
            $table->string('kapasitas_penumpang');
            $table->string('tipe');
            $table->string('jenis')->default('motor');
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
        Schema::dropIfExists('kendaraans');
    }
}
