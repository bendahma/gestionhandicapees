<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHandPaieStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hand_paie_statuses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('status', ['En cours','Suspendu', 'Arrete'])->nullable();
            $table->string('motifAr')->nullable();
            $table->date('dateSupprission')->nullable();
            $table->string('justification')->nullable();
            $table->string('declarepar')->nullable();
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
        Schema::dropIfExists('hand_paie_statuses');
    }
}
