<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class RenouvellementDossier extends Model
{
    protected $fillable = ['dossierRenouvelle','DateRenouvellement','AnneeRenouvelement','hand_id'];

    public function hands(){
        return $this->belongsTo(Hand::class);
    }
    
    public function GetNbrRenouvelle(){
        $hands = DB::table('hands')
                ->join('hand_paie_statuses','hand_paie_statuses.hand_id','hands.id')
                ->join('renouvellement_dossiers','renouvellement_dossiers.hand_id','hands.id')
                ->select('hands.*','renouvellement_dossiers.*' ) 
                ->where('hand_paie_statuses.status','=','En cours')
                ->where('renouvellement_dossiers.dossierRenouvelle','=','1')
                ->get();
        return $hands->count();
    }

    public function GetNbrNonRenouvelle(){
        $hands = DB::table('hands')
                ->join('hand_paie_statuses','hand_paie_statuses.hand_id','hands.id')
                ->join('renouvellement_dossiers','renouvellement_dossiers.hand_id','hands.id')
                ->select('hands.*','renouvellement_dossiers.*' ) 
                ->where('hand_paie_statuses.status','=','En cours')
                ->where('renouvellement_dossiers.dossierRenouvelle','=','0')
                ->get();
        return $hands->count();
    }

    public function Init(){
        //
    }
}
