<?php

namespace App\Exports;

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

use App\Hand;
use App\PaieInformation;
use App\CartHand;
use App\CarteNational;
use App\SecuriteSociale;

class AllHandExport implements FromCollection, WithMapping, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Hand::withTrashed()->get();
    }
    public function map($hand): array
    {   

        return [
            $hand->id,
            $hand->numeroactenaissance ,
            $hand->nameFr ,
            $hand->nomAr ,
            $hand->prenomAr ,
            $hand->sex ,
            $hand->dob ,
            $hand->lieuxNaissanceFr ,
            $hand->lieuxNaissanceAr ,
            $hand->address ,
            $hand->addressAr ,
            $hand->codeCommune ,
            $hand->prenomPereFr ,
            $hand->nomMereFr ,
            $hand->prenomMereFr ,
            $hand->prenomPereAr ,
            $hand->nomMereAr ,
            $hand->prenomMereAr ,
            $hand->situationFamilialeFr ,
            $hand->situationFamilialeAr ,
            $hand->nbrenfant ,
            $hand->obs ,
            $hand->cartehand->numeroCart ,
            $hand->cartehand->natureHandFr ,
            $hand->cartehand->natureHandAr ,
            $hand->cartehand->dateCarte ,
            $hand->cartenational->NumeroNational ,
            $hand->cartenational->dateCarteIdentite ,
            $hand->cartenational->communeCarteNationalFr ,
            $hand->cartenational->communeCarteNationalAr ,
            $hand->paieinformation->CCP ,
            $hand->paieinformation->RIP ,
            $hand->paieinformation->datePremierPension ,
            $hand->securitesociale->NSS ,
            $hand->securitesociale->DateDebutAssurance ,
            
        ];
    }

    public function headings(): array
    {
        return [
            ['REPUBLIQUE  ALGERIENNE  DEMOCRATIQUE  ET  POPULAIRE'],
            ['WILAYA  D\'AIN  TEMOUCHENT'],
            ['DIRECTION DE L\'ACTION  SOCIALE'],
            ['BASE DES DONNEES DES HANDICAPES A 100% MONDATE ET ARRETE'],
            [
                'id',
                'numeroactenaissance',
                'nameFr',
                'nomAr',
                'prenomAr',
                'sex',
                'dob',
                'lieuxNaissanceFr',
                'lieuxNaissanceAr',
                'address',
                'addressAr',
                'codeCommune',
                'prenomPereFr',
                'nomMereFr',
                'prenomMereFr',
                'prenomPereAr',
                'nomMereAr',
                'prenomMereAr',
                'situationFamilialeFr',
                'situationFamilialeAr',
                'nbrenfant',
                'obs',
                'numeroCart',
                'natureHandFr',
                'natureHandAr',
                'dateCarte',
                'NumeroNational',
                'dateCarteIdentite',
                'communeCarteNationalFr',
                'communeCarteNationalAr',
                'CCP',
                'RIP',
                'datePremierPension',
                'NSS',
                'DateDebutAssurance',
            ]
        ];
    }
}
