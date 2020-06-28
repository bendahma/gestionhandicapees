<?php

namespace App;

use App\Paie;

use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    protected $fillable = [
        'annee',
        'budgetMondatement',
        'budgetAssurance',
        'budgetSupplimentaireMondatement',
        'budgetSupplimentaireAssurance',
    ];

    public function CreateNewYearBudget($annee){
        $budgetAnnuel = Budget::where('annee',$annee)->first();
        if($budgetAnnuel == NULL){
            $budgetAnnuel = Budget::create([
                'annee' => date('Y'),
                'budgetMondatement' => 0,
                'budgetAssurance' =>0,
                'budgetSupplimebtaireMondatement'=>0,
                'budgetSupplimentaireAssurance' =>0,
            ]);
        }

        return $budgetAnnuel;
    }

    public function Consommation($annee){
        $AncienConsommationBudgetMondatement = 0;
        $montantMondatementConsomme = 0;
        $NouveauConsommationBudgetMondatement = 0;
        $montantMondatementConsommeActuellement = 0;
        $AncienConsommationBudgetAssurance = 0;
        $montantAssuranceConsomme = 0;
        $NouveauConsommationBudgetAssurance = 0;
        $montantAssuranceConsommeActuellement = 0;


        $paies = Paie::where('anneesPaiement',$annee)->get();
        $budget = Budget::where('annee',$annee)->first();

        foreach ($paies as $p) {
            if($p->moisPaiement < date('m')){
                $montantMondatementConsomme += $p->montantPaiement;
                $montantAssuranceConsomme += $p->montantAssurance;
            }
            $montantMondatementConsommeActuellement += $p->montantPaiement;
            $montantAssuranceConsommeActuellement += $p->montantAssurance;
        }
        $AncienConsommationBudgetMondatement = ($budget->budgetMondatement + $budget->budgetSupplimentaireMondatement) - $montantMondatementConsomme;
        $AncienConsommationBudgetAssurance = ($budget->budgetAssurance + $budget->budgetSupplimentaireAssurance) -  $montantAssuranceConsomme;
        $NouveauConsommationBudgetMondatement = ($budget->budgetMondatement + $budget->budgetSupplimentaireMondatement) - $montantMondatementConsommeActuellement;
        $NouveauConsommationBudgetAssurance = ($budget->budgetAssurance + $budget->budgetSupplimentaireAssurance) - $montantAssuranceConsommeActuellement;

        return [
            'ancienConsommationBudgetPaie' => $AncienConsommationBudgetMondatement,
            'ancienConsommationBudgetAssurance'=> $AncienConsommationBudgetAssurance,
            'nouveauConsommationBudgetPaie' => $NouveauConsommationBudgetMondatement,
            'nouveauConsommationBudgetAssurance' => $NouveauConsommationBudgetAssurance
        ];
    }

}
