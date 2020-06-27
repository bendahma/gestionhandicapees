<?php

namespace App\Imports;

use App\Hand;
use App\CartHand;
use App\PaieInformation;
use App\CarteNational;
use App\SecuriteSociale;
use App\HandPaieStatus;

use Maatwebsite\Excel\Concerns\ToModel;

class HandsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

        // ini_set('memory_limit', '-1');
        // ini_set('max_execution_time', 300); // 5 minutes

        $hand = new Hand();
        $cardHand = new CartHand();
        $compte = new PaieInformation();
        $national = new CarteNational();
        $securiteSociale = new SecuriteSociale();
        $status = new HandPaieStatus();
        
        if(!isset($row[0]) && !isset($row[1]) && !isset($row[2]) && !isset($row[3]) && !isset($row[4]) && !isset($row[5]) ){
            return NULL;
        }
        

        $hand->commune =  isset($row[0]) ? $row[0] : NULL;
        $hand->nameFr = isset($row[1]) ? $row[1] : NULL;
        $hand->sex =  isset($row[2]) ? $row[2] : NULL;
        $hand->dob =  isset($row[3]) ? \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[3]) : '';
        $hand->address = isset($row[10]) ? $row[10] : NULL;
        $hand->deleted_at = (isset($row[11]) && ($row[11] == 'suspendu' || $row[11] == 'Arrete')) ? date("Y-m-d H:i:s") : NULL;
            
        $hand->save();
        
        // ----------------------------------------------------------------------------------------------------
        // Paiement Information
        
        $compte->CCP = isset($row[4]) ? $row[4] : NULL;
        $compte->RIP = isset($row[5]) ? $row[5] : NULL;
        $compte->datePremierPension = isset($row[8]) ? \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[8]) : NULL;
        $hand->paieinformation()->save($compte);
        
        // -----------------------------------------------------------------------------------------------------
        // Cart information 
        $cardHand->natureHandFr =  isset($row[6]) ? $row[6] : NULL;
        $cardHand->dateCarte = isset($row[7]) ? \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[7]) : NULL;
        $cardHand->pourcentage = 100;
        $hand->cartehand()->save($cardHand);
        
        // -------------------------------------------------------------------------------------------------------
        $national->NumeroNational =0;
        $hand->cartenational()->save($national);
        
        // -------------------------------------------------------------------------------------------------------
        // securite sociale information 
        $securiteSociale->NSS = isset($row[9]) ? $row[9] : NULL;
        $hand->securitesociale()->save($securiteSociale);

        // --------------------------------------------------------------------------------------------------------
        $status->status = isset($row[11]) ? $row[11] : NULL;
        $status->dateSupprission = isset($row[12]) ? \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[12]) : NULL;
        $status->motifAr = isset($row[13]) ? $row[13] : NULL;
        
        $hand->status()->save($status);
        
        return $hand; 
    }
}
