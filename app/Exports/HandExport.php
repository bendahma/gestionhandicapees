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
use App\Commune;
use App\Paie;
use App\MoisAnnee;

use DB;

class HandExport implements FromCollection, WithMapping, WithHeadings, WithEvents,ShouldAutoSize,WithColumnFormatting
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function collection()
    {
        
        $hands = Hand::whereHas('status',function($s){
            $s->where('status', 'en cours');
        })->orderBy('codeCommune', 'asc')->get();
        return $hands;
    }

    public function map($hand,$i = 1): array
    {   
        $commune = Commune::where('codeCommune',$hand->codeCommune)->first();     

        return [
            $i+1,
            $commune->nomCommuneFr,
            $hand->nameFr,
            $hand->sex,
            $hand->dob,
            '10000',
            '1',
            '10000',
            $hand->paieinformation->CCP,
        ];
    }

    public function columnFormats(): array
    {
        return [
            'F' => NumberFormat::FORMAT_CURRENCY_EUR_SIMPLE,
            'H' => NumberFormat::FORMAT_CURRENCY_EUR_SIMPLE,
        ];
    }

    public function headings(): array
    {
        $mois = MoisAnnee::where('id',intval(date('m')))->first();

        return [
            ['REPUBLIQUE  ALGERIENNE  DEMOCRATIQUE  ET  POPULAIRE'],
            ['WILAYA  D\'AIN  TEMOUCHENT'],
            ['DIRECTION DE L\'ACTION  SOCIALE'],
            [' LISTE DE VIREMENT DE L\'ALLOCATION DES HANDICAPES A 100%'],
            ['( CHAPITRE  46 - 15  BUDGET  DE  L\'ETAT )'],
            [' WILAYA:  AIN TEMOUCHENT'],
            ['MOIS : ' . $mois->moisFr . ' ' .date('Y') .' '],
            ['N° ORD',
            'COMMUNE',
            'NOM & PRENOM',
            'SEX',
            'DATE DE NAISSANCE',
            'MONTANT MENSUEL',
            'NBR MOIS',
            'MONTANT GLOBAL',
            'CCP']
        ];
    }

    public function registerEvents(): array
    {

       return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange1 = 'A1:A1';
                $cellRange2 = 'A1:A1';
                $cellRange3 = 'A4:A4';
                $cellRange4 = 'A5:A5';
                $cellRange5 = 'A6:A6';
                
                $event->sheet->getDelegate()->getStyle($cellRange1)->getFont()->setSize(16);
                $event->sheet->getDelegate()->getStyle($cellRange2)->getFont()->setSize(12);
                $event->sheet->getDelegate()->getStyle($cellRange3)->getFont()->setSize(12);
                $event->sheet->getDelegate()->getStyle($cellRange4)->getFont()->setSize(10);
                $event->sheet->getDelegate()->getStyle($cellRange5)->getFont()->setSize(12);

                $headerArray = [
                    'font' => [
                        'bold' => true,
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
                    ],
                ];
                
                $styleArray = [
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['argb' => '00000000'],
                        ]
                    ],
                    
                ];

                $event->sheet->getDelegate()->getStyle('A1:A7')->applyFromArray($headerArray);
                $event->sheet->getDelegate()->getStyle('A1:A1')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP);
                $event->sheet->getDelegate()->getStyle('A8:I507')->applyFromArray($styleArray);
                $sommeRange = $event->sheet->getHighestRow()+1;
                $lettreRange = $sommeRange + 2;
                $directeurRange = $lettreRange + 2;
                $event->sheet->setCellValue('H'. $sommeRange, '=SUM(H9:H'.$event->sheet->getHighestRow().')');
                $event->sheet->setCellValue('A'. $lettreRange, 'ARRETE LE PRESENT ETAT A LA SOMME DE :  Dinars ');
                $event->sheet->setCellValue('H'. $directeurRange , 'LE DIRECTEUR');
            

            }
            
        ];
    }
}