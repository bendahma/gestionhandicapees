<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RenouvellementDossier extends Model
{
    protected $fillable = ['dossierRenouvelle','DateRenouvellement','AnneeRenouvelement','hand_id'];

    public function hands(){
        return $this->belongsTo(Hand::class);
    }
    
    public function GetNbrRenouvelle(){
        $renv = RenouvellementDossier::where('dossierRenouvelle',true)->get();
        return $renv->count();
    }

    public function Init(){
        //
    }
}
