<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCfTresorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cf_tresors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('numEngagementPaie')->nullable();
            $table->integer('numEngagementAssurance')->nullable();
            $table->date('dateEngagement')->nullable();
            $table->integer('numMondatePaiement')->nullable();
            $table->integer('numMondateAssurance')->nullable();
            $table->date('dateMondate')->nullable();
            $table->string('operation')->nullable();
            $table->unsignedBigInteger('paie_id')->nullable();
            $table->foreign('paie_id')->references('id')->on('paies')->onDelete('cascade');
            $table->unsignedBigInteger('rappel_id')->nullable();
            $table->foreign('rappel_id')->references('id')->on('rappels')->onDelete('cascade');
            
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
        Schema::dropIfExists('cf_tresors');
    }
}
