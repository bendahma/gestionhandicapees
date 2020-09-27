<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use App\PaieInformation;
use App\Hand;
use App\HandPaieStatus;
use App\HandSuspentionHistory;

class SuspendHandImport implements ToModel
{
    /**
    * @param Collection $collection
    */
    public function model(array $row)
    {
        if(!isset($row[0])){
            return NULL;
        }
        $history = new HandSuspentionHistory();

        $paieinfo = PaieInformation::where('CCP',$row[0])->first();
        $hand = Hand::find($paieinfo->hand_id);
        $status = HandPaieStatus::where('hand_id', $hand->id)->first();
        $status->update([
            'status'=>"Arrete",
            'motifAr'=>"أسباب أخرى",
            'autreMotif'=> "تحويل ملف الى البلدية",
            'dateSupprission'=>"2020-09-01",
        ]);
        
        // Paiement History Table    
        $history->create([
            'status'=>"Arrete",
            'motif'=>"تحويل ملف الى البلدية",
            'dateSupprission'=>"2020-09-01",
            'hand_id'=>$hand->id,
        ]);
        
        // Soft Delete Hand
        $hand->delete();

        return $hand;

    }
}
