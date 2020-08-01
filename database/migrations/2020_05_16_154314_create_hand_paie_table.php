<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHandPaieTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hand_paie', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedbigInteger('hand_id');
            $table->unsignedbigInteger('paie_id');
            $table->unique(['hand_id', 'paie_id']);
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
        Schema::dropIfExists('hand_paie');
    }
}
