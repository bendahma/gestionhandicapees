<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

use App\Exports\RappelsExport;

use App\Hand;
use App\CartHand;
use App\PaieInformation;
use App\CarteNational;
use App\SecuriteSociale;
use App\HandPaieStatus;
use App\Rappel;
use App\HandSuspentionHistory;

use DateTime;

class RappelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        $RappelHands = DB::table('hands')
                        ->join('paie_information','paie_information.hand_id','hands.id')
                        ->join('hand_rappel','hand_rappel.hand_id','hands.id')
                        ->join('rappels','rappels.id','hand_rappel.rappel_id')
                        ->select('hands.nameFr', 'hands.dob','paie_information.CCP','rappels.dateDebut', 'rappels.dateFin','rappels.nombreMois','rappels.RappelFait','hand_rappel.hand_id','hand_rappel.rappel_id')
                        ->get();
        return view('admin.rappel.index')
                ->with('rappels',$RappelHands);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function findInfo(Rappel $rappel,Hand $hand)
    {
        return view('admin.rappel.add')->with('hand',$hand)
                                       ->with('rappel',$rappel)
                                       ->with('paie',PaieInformation::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rappel $rappel)
    {

        $dateDebut = $request->dateDebut;
        $dateFin = $request->dateFin;
        $d1 = new DateTime($dateDebut);
        $d2 = new DateTime($dateFin);
        $nbrMois= ($d1->diff($d2)->m) + ($d1->diff($d2)->y*12) + 1; 
        $montant = 0;
        $dateSeprator = '2019-09-30';
        $dateSeprator2 = '2019-10-01';
        $dateTimeSeperator = new DateTime($dateSeprator);
        $dateTimeSeperatorF = new DateTime($dateSeprator2);
        if($dateFin < $dateSeprator){
            $montant = $nbrMois * 4000;
        }else if($dateDebut > $dateSeprator){
            $montant = $nbrMois * 10000;
        }else{
            $firstDif = ($dateTimeDebut->diff($dateTimeSeperator)->m) + ($dateTimeDebut->diff($dateTimeSeperator)->y*12) + 1; 
            $secondDif = ($dateTimeSeperatorF->diff($dateTimeFin)->m) + ($dateTimeSeperatorF->diff($dateTimeFin)->y*12) + 1; 
            $montant = ($firstDif * 4000) + ($secondDif * 10000);
        }
        $rappel->update([
            'DateDebut'=>$request->dateDebut,
            'DateFin'=>$request->dateFin,
            'nombreMois' =>$nbrMois,
            'montant' => $montant
        ]);

        session()->flash('success','Le rappel a été modifier avec success');

        return redirect(route('rappel.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function export() {
        $filename = 'RappelsEnCours' .date('YmdHis'). '.xlsx';
        ob_end_clean();
        ob_start();
        return Excel::download(new RappelsExport, $filename);
    }

    public function ConfirmRappel(Rappel $rappel){

        $rappel->update([
            'RappelFait'=>1
        ]);

        session()->flash('success','Rappel a été confirme');

        return redirect(route('rappel.index'));

    }
}
