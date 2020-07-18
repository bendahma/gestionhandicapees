<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Hand;
use App\CartHand;
use App\PaieInformation;
use App\HandPaieStatus;
use App\Paie;
use App\Commune;

class HistoryPaiementController extends Controller
{

    public function index(){

        $hands = Hand::with('paieinformation:CCP,hand_id')->withTrashed()->get(['id','nameFr','dob']);
        //dd($hands->toArray());
        return view('admin.historique.index')->with('hands',$hands);

    }

    public function HistoriquePaie($id){
        
        $hand = Hand::with(['paieinformation:CCP,hand_id','paies'])->withTrashed()->where('id',$id)->first(['id','nameFr','dob']);
        $commune = Commune::where('codeCommune',$hand->codeCommune)->first();
        $anneesArr = array();
        $moisArr = array();

        $i=0;
        foreach($hand->paies as $p ){
            // dd($p);
           $anneesArr = array_add($anneesArr, $i, $p->anneesPaiement);
           $moisArr = array_add($moisArr, $i, $p->moisPaiement);
           $i++;
        };
        
        return view('admin.historique.paiement')
                ->with('hand',$hand)
                ->with('commune',$commune)
                ->with('anneesPaiement',$anneesArr)
                ->with('moisPaiement',$moisArr);
    }

    public function HistoreSuspension(Hand $hand){
        //
    }

    public function PaieYearHistory(){
        
    }
}
