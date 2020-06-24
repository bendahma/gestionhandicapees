<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBudgetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('budgets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('annee');
            $table->unsignedBigInteger('budgetMondatement')->nullable();
            $table->unsignedBigInteger('budgetAssurance')->nullable();
            $table->unsignedBigInteger('budgetMondatementConsomme')->nullable();
            $table->unsignedBigInteger('budgetAssuranceConsomme')->nullable();
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
        Schema::dropIfExists('budgets');
    }
}
