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
            $table->unsignedBigInteger('resteBudgetMondatement')->nullable();
            $table->unsignedBigInteger('resteBudgetAssurance')->nullable();
            $table->unsignedBigInteger('budgetSupplimentaireMondatement')->default(0)->nullable();
            $table->unsignedBigInteger('budgetSupplimentaireAssurance')->default(0)->nullable();
            $table->unsignedBigInteger('totalBudgetSupplimentaireMondatement')->default(0)->nullable();
            $table->unsignedBigInteger('totalBudgetSupplimentaireAssurance')->default(0)->nullable();
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
