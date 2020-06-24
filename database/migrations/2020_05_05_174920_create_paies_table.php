<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('moisPaiement');
            $table->string('anneesPaiement');
            $table->bigInteger('montantPaiement');
            $table->unique(['moisPaiement', 'anneesPaiement']);
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
        Schema::dropIfExists('paies');
    }
}
