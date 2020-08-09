<?php

namespace App\Imports;

use App\PaieInformation;
use Maatwebsite\Excel\Concerns\ToModel;

class PaieBeneficierImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

        if(!isset($row[0])){
            return NULL;
        }

        $paieinfo = PaieInformation::where('CCP',$row[0])->first();
        $paieinfo->update(['Beneficier'=>1]);
        dump($paieinfo->CCP . '  ' . $paieinfo->Beneficier);
        return $paieinfo;
        
        //
    }
}
