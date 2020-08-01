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
            'budgetMondatement'=>566430000,
            'budgetAssurance'=>54813700,
            'budgetSupplimentaireMondatement'=>0,
            'budgetSupplimentaireAssurance'=>0,
        ]);
    }
}
