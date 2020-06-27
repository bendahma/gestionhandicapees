<?php

use Illuminate\Database\Seeder;

class BudgetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('budgets')->insert([
            'annee'=>2020,
            'budgetMondatement'=>533650000,
            'budgetAssurance'=>53210100,
            'resteBudgetMondatement' => 0,
            'resteBudgetAssurance' => 0,
            'budgetSupplimentaireMondatement'=>0,
            'budgetSupplimentaireAssurance'=>0,
            'totalBudgetSupplimentaireMondatement'=>0,
            'totalBudgetSupplimentaireAssurance'=>0
        ]);
    }
}
