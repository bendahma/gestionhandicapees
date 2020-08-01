<?php

namespace App\Exports;

use App\Hand;
use App\Commune;



use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use DB;
class HandsPaiementExport implements FromCollection, WithMapping, WithHeadings, ShouldAutoSize
{

   

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $hands = Hand::orderBy('codeCommune','asc')->get();
        return $hands;
    }

    public function map($hand): array
    {   
        $commune = Commune::where('codeCommune',$hand->codeCommune)->first();     

        return [
            '',
            $hand->numeroactenaissance,
            $hand->nameFr,
            $hand->sex,
            $hand->dob,
            $hand->lieuxNaissanceFr,
            $hand->address,
            $commune->nomCommuneFr,
            $hand->paieinformation->CCP,
            $hand->paieinformation->RIP,
            $hand->paieinformation->datePremierPension,
            $hand->paieinformation->dateDecisionPension,
            $hand->cartenational->NumeroNational,
            $hand->cartenational->dateCarteIdentite,
            $hand->cartenational->communeCarteNationalFr,
            $hand->cartenational->communeCarteNationalAr,
            $hand->securitesociale->NSS,
            $hand->securitesociale->DateDebutAssurance,
            $hand->prenomPereFr,
            $hand->nomMereFr,
            $hand->prenomMereFr,
            $hand->situationFamilialeFr,
            $hand->nbrenfant,
            $hand->nomAr,
            $hand->prenomAr,
            $hand->lieuxNaissanceAr,
            $hand->addressAr,
            $commune->nomCommuneAr,
            $hand->prenomPereAr,
            $hand->nomMereAr,
            $hand->prenomMereAr,
            $hand->obs,
            
        ];
    }

    public function headings(): array
    {

        return [
            ['REPUBLIQUE  ALGERIENNE  DEMOCRATIQUE  ET  POPULAIRE'],
            ['WILAYA  D\'AIN  TEMOUCHENT'],
            ['DIRECTION DE L\'ACTION  SOCIALE'],
            ['LISTE DE L\'ALLOCATION DES HANDICAPES A 100%'],
            [''],
            [''],
            ['N° ORD',
            'N° Acte Naissance',
            'Nom & Prenom',
            'Sex',
            'Date de Naissance',
            'Lieux de Naissance',
            'Adresse',
            'Commune',
            'CCP',
            'RIP',
            'Date Premier Pension',
            'Date Decision Pension',
            'N° Carte National',
            'Date carte national',
            'Commune carte national',
            'بلدية إصدار بطاقة التعريف الوطنية',
            'N° Securite Sociale',
            'Date affiliation SS',
            'Prenom Pere',
            'Nom Mere',
            'Prenom Mere',
            'Situation',
            'Nombre enfant',
            'اللقب',
            'الإسم',
            'مكان الميلاد',
            'العنوان',
            'البلدية',
            'إسم الأب',
            'لقب الأم',
            'Obs'
            ]
        ];
    }

}
