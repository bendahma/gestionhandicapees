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
        'resteBudgetMondatement',
        'resteBudgetAssurance',
        'budgetSupplimentaireMondatement',
        'budgetSupplimentaireAssurance',
        'totalBudgetSupplimentaireMondatement',
        'totalBudgetSupplimentaireAssurance',
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
        $budget->update([
            'resteBudgetMondatement' => $budget->budgetMondatement - $montantMondatementConsomme ,
            'resteBudgetAssurance' => $budget->budgetAssurance - $montantAssuranceConsomme,
        ]);

        $NouveauConsommationBudgetMondatement = $budget->budgetMondatement - $montantMondatementConsommeActuellement;

        $NouveauConsommationBudgetAssurance = $budget->budgetAssurance - $montantAssuranceConsommeActuellement;

        return [
            'ancienConsommationBudgetPaie' => $budget->resteBudgetMondatement,
            'ancienConsommationBudgetAssurance'=>$budget->resteBudgetAssurance,
            'nouveauConsommationBudgetPaie' => $NouveauConsommationBudgetMondatement,
            'nouveauConsommationBudgetAssurance' => $NouveauConsommationBudgetAssurance
        ];
    }

    public function syncBudget($annee){
        $budget = Budget::where('annee',$annee)->first();
        $newResteMondatement = $budget->resteBudgetMondatement + $budget->budgetSupplimentaireMondatement;
        $newResteAssurance = $budget->resteBudgetAssurance + $budget->budgetSupplimentaireAssurance;
        $budget->update([
            'resteBudgetMondatement' => $newResteMondatement,
            'resteBudgetAssurance' => $newResteAssurance ,
            'totalBudgetSupplimentaireMondatement' => $budget->totalBudgetSupplimentaireMondatement + $budget->budgetSupplimentaireMondatement,
            'totalBudgetSupplimentaireAssurance' => $budget->totalBudgetSupplimentaireAssurance + $budget->budgetSupplimentaireAssurance,
            'budgetSupplimentaireMondatement' => 0,
            'budgetSupplimentaireAssurance' => 0
        ]);
    }
}
