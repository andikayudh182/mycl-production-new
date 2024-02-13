<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMyleaPtMpt2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mylea_pt_mpt2', function (Blueprint $table) {
            $table->id();
            $table->string('KodeProduksi');
            $table->string('Grade');
            $table->integer('StatusPengeringan')->nullable();
            $table->date('TanggalPengeringan2')->nullable();
            $table->integer('StatusReinforce')->nullable();
            $table->date('TanggalReinforce')->nullable();
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
        Schema::dropIfExists('mylea_pt_mpt2');
    }
}
