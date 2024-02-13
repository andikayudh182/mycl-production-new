<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBioboPt2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('biobo_pt2', function (Blueprint $table) {
            $table->id();
            $table->string('NoBatch');
            $table->date('Tanggal')->nullable();
            $table->integer('U10x15');
            $table->integer('U10x20');
            $table->integer('U30x30');
            $table->date('TanggalSanding')->nullable();
            $table->integer('PSanding10x15')->nullable();
            $table->integer('PSanding10x20')->nullable();
            $table->integer('PSanding30x30')->nullable();
            $table->date('TanggalCutting')->nullable();
            $table->integer('PCutting10x15')->nullable();
            $table->integer('PCutting10x20')->nullable();
            $table->integer('PCutting30x30')->nullable();
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
        Schema::dropIfExists('biobo_pt2');
    }
}
