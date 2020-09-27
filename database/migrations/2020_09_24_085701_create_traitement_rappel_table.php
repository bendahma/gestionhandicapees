<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTraitementRappelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('traitement_rappel', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('AnneeRappel')->nullable();
            $table->bigInteger('montantRappel')->nullable();
            $table->bigInteger('montantAssurance')->nullable();
            $table->Integer('nombreMois')->nullable();
            $table->Integer('nombrePersonne')->nullable();
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
        Schema::dropIfExists('traitement_rappel');
    }
}
