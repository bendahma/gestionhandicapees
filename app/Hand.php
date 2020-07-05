<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


use App\CartHand;
use App\HandPaieStatus;
use App\Paie;
use App\CarteNational;
use App\PaieInformation;
use App\SecuriteSociale;
use App\Rappel;
use App\HandSuspentionHistory;
use App\RenouvellementDossier;
use App\Commune;

class Hand extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'numeroactenaissance', 'nameFr', 'nomAr',
        'prenomAr','sex','dob',
        'lieuxNaissanceFr','lieuxNaissanceAr',
        'address','addressAr','commune_id','prenomMereFr','prenomPereAr',
        'prenomPereFr','nomMereFr',
        'nomMereAr','prenomMereAr','situationFamilialeFr','situationFamilialeAr',
        'nbrenfant','obs'
    ];

    // Relationships

    public function cartehand()
    {
        return $this->hasOne(CartHand::class);
    }
    
    public function cartenational()
    {
        return $this->hasOne(CarteNational::class);
    }

    public function paieinformation(){
        return $this->hasOne(PaieInformation::class);
    }
    
    public function securitesociale(){
        return $this->hasOne(SecuriteSociale::class);
    }


    public function status(){
        return $this->hasOne(HandPaieStatus::class);
    }

    public function paies(){
		return $this->belongsToMany(Paie::class);
    }

    public function rappels(){
		return $this->belongsToMany(Rappel::class);
    }

    public function handSuspentionHistories(){
        return $this->hasMany(HandSuspentionHistory::class);
    }

    public function renouvellementdossier(){
        return $this->hasOne(RenouvellementDossier::class);
    }

    public function commune(){
        return $this->hasOne(Commune::class);
    }

    public function CheckBasicInfoExsists(Hand $hand){
        if($hand->numeroactenaissance == NULL &&  $hand->nomAr == NULL &&  $hand->prenomAr == NULL && $hand->lieuxNaissanceAr == NULL &&  
            $hand->addressAr == NULL &&  $hand->prenomPereFr == NULL &&  $hand->nomMereFr == NULL 
            &&  $hand->prenomMereFr == NULL &&  $hand->prenomPereAr == NULL &&  $hand->nomMereAr == NULL &&  $hand->prenomMereAr == NULL && 
             $hand->situationFamilialeFr == NULL &&  $hand->situationFamilialeAr == NULL  &&  $hand->nbrenfant == NULL){
                return false;
            }
        return true;
    }
 
    public function HandMondate(){
        $hands = Hand::whereHas('status',function($s){
            $s->where('status', 'en cours');
        })->get();
        return $hands;
    }

    public function HandSuspendu(){
        $hands = Hand::onlyTrashed()->whereHas('status',function($s){
            $s->where('status', 'suspendu');
        })->get();
        return $hands;
    }
    
    public function HandArrete(){
        $hands = Hand::onlyTrashed()->whereHas('status',function($s){
            $s->where('status', 'arrete');
        })->get();
        return $hands;
    }
    public function HandEnAttente(){
        $hands = Hand::onlyTrashed()->whereHas('status',function($s){
            $s->where('status', 'En attente');
        })->get();
        return $hands;
    }
}
