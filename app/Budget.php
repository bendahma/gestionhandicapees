<?php

namespace App;

use App\Paie;
use App\Rappel;

use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    protected $fillable = [
        'annee',
        'budgetMondatement',
        'budgetAssurance',
        'budgetSupplimentaireMondatement',
        'budgetSupplimentaireAssurance',
        'desengagementMondatement',
        'desengagementAssurance'
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
                'desengagementMondatement' => 0,
                'desengagementAssurance' => 0
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
        $montantRappelPaie = 0;
        $montantRappelAssurance = 0;
        $montantdesengagementpaie = 0;
        $montantdesengagementassurance = 0;
        $paies = Paie::where('anneesPaiement',$annee)->get();
        $rappel = Rappel::where('AnneeRappel',date('Y'))->where('RappelFait',1)->get();
        $budget = Budget::where('annee',$annee)->first();     

        foreach ($paies as $p) {
            if($p->moisPaiement < date('m')){
                $montantMondatementConsomme += $p->montantPaiement;
                $montantAssuranceConsomme += $p->montantAssurance;
            }
            $montantMondatementConsommeActuellement += $p->montantPaiement;
            $montantAssuranceConsommeActuellement += $p->montantAssurance;

        }
        
        foreach($rappel as $r){
            $montantRappelPaie += $r->montantRappel;
            $montantRappelAssurance += $r->montantAssurance;
        }

<<<<<<< HEAD
        $AncienConsommationBudgetMondatement = ($budget->budgetMondatement + $budget->budgetSupplimentaireMondatement ) - ($montantMondatementConsomme + $montantRappelPaie);
        $AncienConsommationBudgetAssurance = ($budget->budgetAssurance + $budget->budgetSupplimentaireAssurance ) -  ($montantAssuranceConsomme + $montantRappelAssurance);
        $NouveauConsommationBudgetMondatement = ($budget->budgetMondatement + $budget->budgetSupplimentaireMondatement ) - ($montantMondatementConsommeActuellement + $montantRappelPaie);
        $NouveauConsommationBudgetAssurance = ($budget->budgetAssurance + $budget->budgetSupplimentaireAssurance ) - ($montantAssuranceConsommeActuellement+$montantRappelAssurance);
=======
        $AncienConsommationBudgetMondatement = ($budget->budgetMondatement + $budget->desengagementMondatement + $budget->budgetSupplimentaireMondatement + $budget->desengagementMondatement) - ($montantMondatementConsomme + $montantRappelPaie);
        $AncienConsommationBudgetAssurance = ($budget->budgetAssurance + $budget->desengagementAssurance + $budget->budgetSupplimentaireAssurance + $budget->desengagementAssurance) -  ($montantAssuranceConsomme + $montantRappelAssurance);
        $NouveauConsommationBudgetMondatement = ($budget->budgetMondatement + $budget->desengagementMondatement + $budget->budgetSupplimentaireMondatement + $budget->desengagementMondatement) - ($montantMondatementConsommeActuellement + $montantRappelPaie);
        $NouveauConsommationBudgetAssurance = ($budget->budgetAssurance + $budget->desengagementAssurance + $budget->budgetSupplimentaireAssurance + $budget->desengagementAssurance) - ($montantAssuranceConsommeActuellement+$montantRappelAssurance);
>>>>>>> 48fa22b71077ab005431f699802612de1c29fe81

        return [
            'ancienConsommationBudgetPaie' => $AncienConsommationBudgetMondatement,
            'ancienConsommationBudgetAssurance'=> $AncienConsommationBudgetAssurance,
            'nouveauConsommationBudgetPaie' => $NouveauConsommationBudgetMondatement,
            'nouveauConsommationBudgetAssurance' => $NouveauConsommationBudgetAssurance
        ];
    }

}
