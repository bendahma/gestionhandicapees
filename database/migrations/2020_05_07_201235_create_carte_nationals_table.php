<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarteNationalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carte_nationals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('NumeroNational')->nullable();
            $table->date('dateCarteIdentite')->nullable();
            $table->string('communeCarteNationalFr')->nullable();
            $table->string('communeCarteNationalAr')->nullable();
            $table->string('wilayaCarteNational')->nullable();
            $table->unsignedBigInteger('hand_id');
            $table->timestamps();
            $table->foreign('hand_id')->references('id')->on('hands')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carte_nationals');
    }
}
