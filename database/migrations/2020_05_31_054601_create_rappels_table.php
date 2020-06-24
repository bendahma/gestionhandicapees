<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRappelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rappels', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('DateRappel')->nullable();
            $table->date('DatePaiementRappel')->nullable();
            $table->date('DateDebut')->nullable();
            $table->date('DateFin')->nullable();
            $table->bigInteger('montant')->nullable();
            $table->Integer('nombreMois')->nullable();
            $table->boolean('RappelFait')->default(false);
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
        Schema::dropIfExists('rappels');
    }
}
