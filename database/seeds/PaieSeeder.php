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
         DB::table('paies')->insert([
             'moisPaiement'=>1,
             'anneesPaiement'=>2020,
             'montantPaiement'=>43200000,
             'montantAssurance'=>3888000
        ]);
        DB::table('paies')->insert([
            'moisPaiement'=>2,
            'anneesPaiement'=>2020,
            'montantPaiement'=>43190000,
            'montantAssurance'=>3887100
        ]);
        DB::table('paies')->insert([
            'moisPaiement'=>3,
            'anneesPaiement'=>2020,
            'montantPaiement'=>43190000,
            'montantAssurance'=>3887100
        ]);
        DB::table('paies')->insert([
            'moisPaiement'=>4,
            'anneesPaiement'=>2020,
            'montantPaiement'=>43190000,
            'montantAssurance'=>3887100
        ]);
        DB::table('paies')->insert([
            'moisPaiement'=>5,
            'anneesPaiement'=>2020,
            'montantPaiement'=>41920000,
            'montantAssurance'=>3772800
        ]);
        DB::table('paies')->insert([
            'moisPaiement'=>6,
            'anneesPaiement'=>2020,
            'montantPaiement'=>41660000,
            'montantAssurance'=>3749400
        ]);
    }
}
