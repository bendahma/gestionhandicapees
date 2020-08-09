<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSupprimeAutreMotif extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hand_paie_statuses', function (Blueprint $table) {
            $table->string('autreMotif')->nullable();
            $table->text('ObsSuspension')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hand_paie_statuses', function (Blueprint $table) {
            //
        });
    }
}
