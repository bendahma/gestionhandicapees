<?php

use Illuminate\Database\Seeder;
use App\MoisAnnee;

class MoisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('mois_annees')->insert(
            [
                'moisAr' => 'جانفي',
                'moisFr' => 'Janvier',
            ]
        );
        DB::table('mois_annees')->insert(
            [
                'moisAr' => 'فيفري',
                'moisFr' => 'Fevrier',
            ]
        );
        DB::table('mois_annees')->insert(
            [
                'moisAr' => 'مارس',
                'moisFr' => 'Mars',
            ]
        );
        DB::table('mois_annees')->insert(
            [
                'moisAr' => 'أفريل',
                'moisFr' => 'Avril',
            ]
        );
        DB::table('mois_annees')->insert(
            [
                'moisAr' => 'ماي',
                'moisFr' => 'Mai',
            ]
        );
        DB::table('mois_annees')->insert(
            [
                'moisAr' => 'جوان',
                'moisFr' => 'Juin',
            ]
        );
        DB::table('mois_annees')->insert(
            [
                'moisAr' => 'جويلية',
                'moisFr' => 'Juilet',
            ]
        );
        DB::table('mois_annees')->insert(
            [
                'moisAr' => 'أوت',
                'moisFr' => 'Aout',
            ]
        );
        DB::table('mois_annees')->insert(
            [
                'moisAr' => 'سبتمبر',
                'moisFr' => 'Septembre',
            ]
        );
        DB::table('mois_annees')->insert(
            [
                'moisAr' => 'أكتوبر',
                'moisFr' => 'Octobre',
            ]
        );
        DB::table('mois_annees')->insert(
            [
                'moisAr' => 'نوفمبر',
                'moisFr' => 'Novembre',
            ]
        );
        DB::table('mois_annees')->insert(
            [
                'moisAr' => 'ديسمبر',
                'moisFr' => 'Decembre',
            ]
        );
    }
}
