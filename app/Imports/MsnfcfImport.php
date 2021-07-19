<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use App\Hand;
use App\PaieInformation;
class MsnfcfImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $h = PaieInformation::where('CCP',$row[0])->first();
        $hand = Hand::withTrashed()->where('id',$h->hand_id)->first();
        $hand->msnfcf=1;
        $hand->save();
    }
}
