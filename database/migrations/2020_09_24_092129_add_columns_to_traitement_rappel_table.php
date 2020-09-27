<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToTraitementRappelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('traitement_rappel', function (Blueprint $table) {
            $table->string('moisRappel')->nullable();
            $table->string('anneesRappel')->nullable();
            $table->date('dateDebutRappel')->nullable();
            $table->date('dateFinRappel')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('traitement_rappel', function (Blueprint $table) {
            //
        });
    }
}
