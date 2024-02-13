<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMyleaPtMpt4 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mylea_pt_mpt4', function (Blueprint $table) {
            $table->id();
            $table->string('KodeProduksi');
            $table->string('Grade');
            $table->integer('StatusCutting')->nullable();
            $table->date('TanggalCutting')->nullable();
            $table->integer('StatusCoatingPigmen')->nullable();
            $table->date('TanggalCoatingPigmen')->nullable();
            $table->integer('StatusPengeringan4')->nullable();
            $table->date('TanggalPengeringan4')->nullable();
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
        Schema::dropIfExists('mylea_pt_mpt4');
    }
}
