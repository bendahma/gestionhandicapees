<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSecuriteSocialesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('securite_sociales', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->BigInteger('NSS')->nullable();
            $table->date('DateDebutAssurance')->nullable();
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
        Schema::dropIfExists('securite_sociales');
    }
}
