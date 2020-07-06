<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hands', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('numeroactenaissance')->nullable();
            $table->string('nameFr')->nullable();
            $table->string('nomAr')->nullable();
            $table->string('prenomAr')->nullable();
            $table->string('sex')->nullable();
            $table->date('dob')->nullable();
            $table->string('lieuxNaissanceFr')->nullable();
            $table->string('lieuxNaissanceAr')->nullable();
            $table->text('address')->nullable();
            $table->text('addressAr')->nullable();
            $table->unsignedBigInteger('codeCommune');
            $table->string('prenomPereFr')->nullable();
            $table->string('nomMereFr')->nullable();
            $table->string('prenomMereFr')->nullable();
            $table->string('prenomPereAr')->nullable();
            $table->string('nomMereAr')->nullable();
            $table->string('prenomMereAr')->nullable();
            $table->string('situationFamilialeFr')->nullable();
            $table->string('situationFamilialeAr')->nullable();
            $table->string('nbrenfant')->nullable();
            $table->text('obs')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('hands');
    }
}
