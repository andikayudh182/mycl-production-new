<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBaglogKartuKendaliTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('baglog_kartu_kendali', function (Blueprint $table) {
            $table->id();
            $table->string('KodeProduksi');
            $table->date('TanggalPembibitan');
            $table->date('TanggalCrushing');
            $table->date('TanggalHarvest');
            $table->integer('JumlahBaglog');
            $table->string('Lokasi');
            $table->integer('Status');
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
        Schema::dropIfExists('baglog_kartu_kendali');
    }
}
