<?php

namespace App\Exports;

use App\Hand;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

Use \Maatwebsite\Excel\Sheet;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

use App\PaieInformation;
use App\CartHand;
use App\CarteNational;
use App\SecuriteSociale;
class HandNonRenouvelle implements FromCollection, WithMapping, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $handNonRen = Hand::whereHas('renouvellementdossier',function($query){
            $query->where('dossierRenouvelle' ,0);
        })->whereHas('status',function($query){
            $query->where('status','En cours');
        })->get();
        
        return $handNonRen;
    }

    public function map($hand): array
    {   

        return [
            $hand->id,
            $hand->nameFr ,
            $hand->dob ,
            $hand->address ,
            $hand->addressAr ,
            $hand->paieinformation->CCP ,
            $hand->status->status,
            $hand->paieinformation->datePremierPension,
            $hand->paieinformation->dateDebutPension,
        ];
    }

    public function headings(): array
    {
        return [
            ['REPUBLIQUE  ALGERIENNE  DEMOCRATIQUE  ET  POPULAIRE'],
            ['WILAYA  D\'AIN  TEMOUCHENT'],
            ['DIRECTION DE L\'ACTION  SOCIALE'],

            [
                'id',
                'nameFr',
                'dob',
                'Address',
                'AddressAr',
                'CCP',
                'status',
                'Date 1er pension',
                'Date Debut pension',
            ]
        ];
    }
}
