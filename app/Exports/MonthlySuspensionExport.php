<?php

namespace App\Exports;
use Illuminate\Http\Request;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;


use App\Hand;
use App\Commune;

class MonthlySuspensionExport implements FromCollection,WithMapping, WithHeadings, ShouldAutoSize,WithColumnFormatting
{
    use Exportable;

    public function __construct(Request $request)
    {
        $this->dateDebut = $request->dateDebut;
        $this->dateFin = $request->dateFin;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $handsSuspended = Hand::onlyTrashed()->whereHas('status',function($s){
            $s->whereBetween('dateSupprission' , [$this->dateDebut,$this->dateFin]);
        })->get();

        return $handsSuspended;
    }
    public function map($hand): array
    {   
        $commune = Commune::where('codeCommune',$hand->codeCommune)->first();     

        return [
            '',
            $commune->nomCommuneFr,
            $hand->nameFr,
            $hand->dob,
            $hand->address,
            $hand->paieinformation->CCP,
            $hand->status->dateSupprission,
            $hand->status->motifAr,
            $hand->status->autreMotif,
            $hand->status->ObsSuspension,
        ];
    }

    public function columnFormats(): array
    {
        return [
            'D' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'G' => NumberFormat::FORMAT_DATE_DDMMYYYY,
        ];
    }

    public function headings(): array
    {

        return [
            ['REPUBLIQUE  ALGERIENNE  DEMOCRATIQUE  ET  POPULAIRE'],
            ['WILAYA  D\'AIN  TEMOUCHENT'],
            ['DIRECTION DE L\'ACTION  SOCIALE'],
            ['LISTE DES HANDICAPES SUSPENDU ET ARRETE'],
            [''],
            [''],
            ['N° ORD',
            'Commune',
            'Nom & Prenom',
            'Date de Naissance',
            'Adresse',
            'CCP',
            'Date suspension',
            'Motif',
            'AUTRE',
            'OBS',
            ]
        ];
    }

    

}
