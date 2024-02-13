<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBaglogBahanRecipesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('baglog_bahan_recipes', function (Blueprint $table) {
            $table->id();
            $table->string('NoRecipe');
            $table->integer('MCSKayu');
            $table->integer('NoKontSKayu');
            $table->integer('SKayu');
            $table->integer('MCHickory');
            $table->integer('NoKontHickory');
            $table->integer('Hickory');
            $table->integer('CaCO3');
            $table->integer('Pollard');
            $table->integer('Tapioka');
            $table->integer('Air');
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
        Schema::dropIfExists('baglog_bahan_recipes');
    }
}
