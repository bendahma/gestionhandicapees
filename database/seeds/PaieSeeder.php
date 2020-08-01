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
             'moisPaiement'=>'01',
             'anneesPaiement'=>2020,
             'montantPaiement'=>43200000,
             'montantAssurance'=>3888000
        ]);
        DB::table('paies')->insert([
            'moisPaiement'=>'02',
            'anneesPaiement'=>2020,
            'montantPaiement'=>43190000,
            'montantAssurance'=>3887100
        ]);
        DB::table('paies')->insert([
            'moisPaiement'=>'03',
            'anneesPaiement'=>2020,
            'montantPaiement'=>43190000,
            'montantAssurance'=>3887100
        ]);
        DB::table('paies')->insert([
            'moisPaiement'=>'04',
            'anneesPaiement'=>2020,
            'montantPaiement'=>43190000,
            'montantAssurance'=>3887100
        ]);
        DB::table('paies')->insert([
            'moisPaiement'=>'05',
            'anneesPaiement'=>2020,
            'montantPaiement'=>41920000,
            'montantAssurance'=>3772800
        ]);
        DB::table('paies')->insert([
            'moisPaiement'=>'06',
            'anneesPaiement'=>2020,
            'montantPaiement'=>41660000,
            'montantAssurance'=>3749400
        ]);
    }
}
