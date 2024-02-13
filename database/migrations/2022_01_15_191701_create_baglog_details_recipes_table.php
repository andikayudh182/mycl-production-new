<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBaglogDetailsRecipesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('baglog_details_recipes', function (Blueprint $table) {
            $table->id();
            $table->string('NoRecipe');
            $table->date('TanggalKeluar');
            $table->integer('TotalBags');
            $table->integer('WeightperBag');
            $table->integer('JenisAutoclave');
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
        Schema::dropIfExists('baglog_details_recipes');
    }
}
