<?php

use Illuminate\Database\Seeder;
class TraitementRappelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            DB::table('traitement_rappel')->insert([
                    'AnneeRappel' => '2020',
                    'montantRappel' => '852000',
                    'montantAssurance' => '0',
                    'nombreMois' => '142',
                    'nombrePersonne' => '142',
                    'moisRappel' => '07',
                    'anneesRappel' => '2020',
                    'dateDebutRappel' => '2020-10-01',
                    'dateFinRappel' => '2020-11-30',
            ]);
            DB::table('traitement_rappel')->insert([
                    'AnneeRappel' => '2020',
                    'montantRappel' => '270000',
                    'montantAssurance' => '0',
                    'nombreMois' => '45',
                    'nombrePersonne' => '44',
                    'moisRappel' => '09',
                    'anneesRappel' => '2020',
                    'dateDebutRappel' => '2020-10-01',
                    'dateFinRappel' => '2020-11-30',
            ]);
                DB::table('traitement_rappel')->insert([
                    'AnneeRappel' => '2020',
                    'montantRappel' => '5798000',
                    'montantAssurance' => '674000',
                    'nombreMois' => '749',
                    'nombrePersonne' => '247',
                    'moisRappel' => '09',
                    'anneesRappel' => '2020',
                    'dateDebutRappel' => '2018-01-01',
                    'dateFinRappel' => '2020-07-31',
            ]);
    }
}
