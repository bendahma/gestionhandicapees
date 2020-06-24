<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHandSuspentionHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hand_suspention_histories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('status', ['Suspendu', 'Arrete'])->nullable();
            $table->unsignedBigInteger('suspension_id')->nullable();
            $table->date('dateSupprission')->nullable();
            $table->date('dateRemi')->nullable();
            $table->string('motif')->nullable();
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
        Schema::dropIfExists('hand_suspention_histories');
    }
}
