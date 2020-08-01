<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRenouvellementDossiersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('renouvellement_dossiers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('dossierRenouvelle')->default(false);
            $table->date('DateRenouvellement')->nullable();
            $table->string('AnneeRenouvelement')->nullable();
            $table->unsignedBigInteger('hand_id');
            $table->foreign('hand_id')->references('id')->on('hands')->onDelete('cascade');
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
        Schema::dropIfExists('renouvellement_dossiers');
    }
}
