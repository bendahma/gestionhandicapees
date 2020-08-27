<?php

namespace App\Exports;

use App\Rappel;
use Maatwebsite\Excel\Concerns\FromCollection;
use DB;
class RappelsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $RappelHands = DB::table('hands')
                    ->join('paie_information','paie_information.hand_id','hands.id')
                    ->join('hand_rappel','hand_rappel.hand_id','hands.id')
                    ->join('rappels','rappels.id','hand_rappel.rappel_id')
                    ->select('hands.nameFr', 'hands.dob','paie_information.CCP','paie_information.RIP','rappels.dateDebut', 'rappels.dateFin','rappels.nombreMois','rappels.montantRappel','rappels.montantAssurance')
                    ->where('rappels.RappelFait','=','0')
                    ->get();
        return $RappelHands;
    }
}
