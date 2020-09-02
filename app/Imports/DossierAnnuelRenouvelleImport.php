<?php

namespace App\Imports;

use App\RenouvellementDossier;
use App\PaieInformation;
use Maatwebsite\Excel\Concerns\ToModel;

class DossierAnnuelRenouvelleImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

        if(!isset($row[0])){
            return null;
        }

        $paieinfo = PaieInformation::where('CCP',$row[0])->first();
        $dossierAnnuel = null;
        
        if($paieinfo != null){
            $dossierAnnuel = RenouvellementDossier::where('hand_id',$paieinfo->hand_id)->first();
            $dossierAnnuel->update(['dossierRenouvelle'=>1]);
            dump($row[0]);
        }

        return $dossierAnnuel;
    }
}
