<?php

use Illuminate\Database\Seeder;

class PaieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('paies')->insert([
        //     'moisPaiement'=>2,
        //     'anneesPaiement'=>2020,
        //     'montantPaiement'=>10000000,
        //     'montantAssurance'=>1000000
        // ]);
        DB::table('paies')->insert([
            'moisPaiement'=>3,
            'anneesPaiement'=>2020,
            'montantPaiement'=>10000000,
            'montantAssurance'=>1000000
        ]);
        DB::table('paies')->insert([
            'moisPaiement'=>4,
            'anneesPaiement'=>2020,
            'montantPaiement'=>10000000,
            'montantAssurance'=>1000000
        ]);
    }
}
