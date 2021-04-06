<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use App\PaieInformation;
use App\Hand;
use App\Rappel;

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
            dump($row[0]);
        } catch (\Throwable $th) {
            dd($th);
        }
        
    }
}
