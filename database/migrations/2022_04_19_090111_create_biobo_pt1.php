<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBioboPt1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('biobo_pt1', function (Blueprint $table) {
            $table->id();
            $table->string('NoBatch');
            $table->date('Tanggal');
            $table->integer('U10x15');
            $table->integer('U10x20');
            $table->integer('U30x30');
            $table->date('TanggalDrying')->nullable();
            $table->integer('PDrying10x15')->nullable();
            $table->integer('PDrying10x20')->nullable();
            $table->integer('PDrying30x30')->nullable();
            $table->date('TanggalPressing')->nullable();
            $table->integer('PPressing10x15')->nullable();
            $table->integer('PPressing10x20')->nullable();
            $table->integer('PPressing30x30')->nullable();
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
        Schema::dropIfExists('biobo_pt1');
    }
}
