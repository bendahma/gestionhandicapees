<?php

namespace App\Exports;

use App\Rappel;
use Maatwebsite\Excel\Concerns\FromCollection;
use DB;

use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

Use \Maatwebsite\Excel\Sheet;
use App\Commune;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class RappelsExport implements FromCollection, WithMapping, WithHeadings
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
                    ->select('hands.*','paie_information.*','rappels.*')
                    ->where('rappels.RappelFait','=','0')
                    ->get();
        return $RappelHands;
    }

    public function map($hand): array
    {   
        $commune = Commune::where('codeCommune',$hand->codeCommune)->first();     

        return [
            '',
            $commune->nomCommuneFr,
            $hand->nameFr,
            $hand->sex,
            $hand->dob,
            $hand->CCP,
            $hand->DateDebut,
            $hand->DateFin,
            $hand->nombreMois,
            '10000',
            $hand->montantRappel,
            $hand->RIP,
        ];
    }

    public function headings(): array
    {
        

        return [
            ['REPUBLIQUE  ALGERIENNE  DEMOCRATIQUE  ET  POPULAIRE'],
            ['WILAYA  D\'AIN  TEMOUCHENT'],
            ['DIRECTION DE L\'ACTION  SOCIALE'],
           
           
            ['N° ORD',
            'COMMUNE',
            'NOM & PRENOM',
            'SEX',
            'DATE DE NAISSANCE',
            'CCP',
            'Date Debut',
            'Date Fin',
            'Montant Mensuelle',
            'Montant Globale',
            'RIP']
        ];
    }

}
