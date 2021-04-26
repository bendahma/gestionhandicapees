<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use App\PaieInformation;
use App\Hand;
use App\Rappel;
use DB;
class ListRappelFait  implements ToModel
{
    /**
    * @param Collection $collection
    */
    public function model(array $row)
    {
        if(!isset($row[0])){
            return NULL;
        }
        try {
            $paieinfo = PaieInformation::where('CCP',$row[0])->first();
            $hand_id = $paieinfo->hand_id;
            $nombreMois = $row[1];
           
            $rappelId = DB::table('rappels')
                        ->join('hand_rappel','hand_rappel.rappel_id','rappels.id')
                        ->join('hands','hand_rappel.hand_id','hands.id')
                        ->select('rappels.*')
                        ->where('hands.id',$hand_id)    
                        ->where('rappels.nombreMois',$nombreMois)    
                        ->first();
            $rappel = Rappel::find($rappelId->id);
            $rappel->update([
                'RappelFait'=>1
            ]);       
        } catch (\Throwable $th) {
            dump($row[0]);
        }
       return $rappel ;
    }
}
