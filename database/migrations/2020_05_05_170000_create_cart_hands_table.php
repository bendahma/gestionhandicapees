<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCartHandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart_hands', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('numeroCart')->nullable();
            $table->string('natureHandFr')->nullable();
            $table->string('natureHandAr')->nullable();
            $table->integer('pourcentage')->nullable();
            $table->date('dateCarte')->nullable();
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
        Schema::dropIfExists('cart_hands');
    }
}
