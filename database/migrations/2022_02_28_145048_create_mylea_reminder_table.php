<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMyleaReminderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mylea_reminder', function (Blueprint $table) {
            $table->id();
            $table->string('KodeProduksi');
            $table->date('Elus1');
            $table->date('Elus2');
            $table->date('Elus3');
            $table->date('TanggalPanen');
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
        Schema::dropIfExists('mylea_reminder');
    }
}
