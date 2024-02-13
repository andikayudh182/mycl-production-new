<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMyleaPtMpt1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mylea_pt_mpt1', function (Blueprint $table) {
            $table->id();
            $table->string('KodeProduksi');
            $table->integer('StatusWashing')->nullable();
            $table->date('TanggalWashing')->nullable();
            $table->integer('StatusPengerikan')->nullable();
            $table->date('TanggalPengerikan')->nullable();
            $table->integer('StatusScoring')->nullable();
            $table->date('TanggalScoring')->nullable();
            $table->integer('StatusPengeringan1')->nullable();
            $table->date('TanggalPengeringan1')->nullable();
            $table->integer('StatusPEG')->nullable();
            $table->date('TanggalPEG')->nullable();
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
        Schema::dropIfExists('mylea_pt_mpt1');
    }
}
