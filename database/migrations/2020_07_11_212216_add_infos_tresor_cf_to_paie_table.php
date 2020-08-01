<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddInfosTresorCfToPaieTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('paies', function (Blueprint $table) {
            $table->date('dateEngagementPaie')->nullable();
            $table->date('dateMondatePaie')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('paies', function (Blueprint $table) {
            //
        });
    }
}
