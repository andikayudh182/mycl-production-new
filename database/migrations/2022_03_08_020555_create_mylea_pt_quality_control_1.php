<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMyleaPtQualityControl1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mylea_pt_quality_control_1', function (Blueprint $table) {
            $table->id();
            $table->string('KodeProduksi');
            $table->date('ArrivalDate');
            $table->string('JenisMylea');
            $table->integer('GradeA');
            $table->integer('GradeE');
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
        Schema::dropIfExists('mylea_pt_quality_control_1');
    }
}
