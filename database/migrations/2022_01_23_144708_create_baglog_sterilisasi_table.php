<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBaglogSterilisasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('baglog_sterilisasi', function (Blueprint $table) {
            $table->id();
            $table->date('TanggalSterilisasi');
            $table->integer('NoBatch');
            $table->integer('JenisAutoclave');
            $table->string('NoRecipe');
            $table->integer('Jumlah');
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
        Schema::dropIfExists('baglog_sterilisasi');
    }
}
