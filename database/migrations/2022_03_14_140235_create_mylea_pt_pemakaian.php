<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMyleaPtPemakaian extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mylea_pt_pemakaian', function (Blueprint $table) {
            $table->id();
            $table->integer('id_details');
            $table->date('Tanggal');
            $table->integer('Jumlah');
            $table->text('Notes');
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
        Schema::dropIfExists('mylea_pt_pemakaian');
    }
}
