<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaieInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paie_information', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('CCP')->unique()->nullable();
            $table->string('RIP')->unique()->nullable();
            $table->date('datePremierPension')->nullable();
            $table->date('dateDecisionPension')->nullable();
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
        Schema::dropIfExists('paie_information');
    }
}
