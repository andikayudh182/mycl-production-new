<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMyleaPtMpt3 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mylea_pt_mpt3', function (Blueprint $table) {
            $table->id();
            $table->string('KodeProduksi');
            $table->string('Grade');
            $table->integer('StatusPengeringan3')->nullable();
            $table->date('TanggalPengeringan3')->nullable();
            $table->integer('StatusPressing')->nullable();
            $table->date('TanggalPressing')->nullable();
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
        Schema::dropIfExists('mylea_pt_mpt3');
    }
}
