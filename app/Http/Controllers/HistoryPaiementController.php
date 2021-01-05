<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Arr;

use App\Hand;
use App\CartHand;
use App\PaieInformation;
use App\HandPaieStatus;
use App\Paie;
use App\Commune;
use App\HandSuspentionHistory;

class HistoryPaiementController extends Controller
{

    public function index(){

        $hands = Hand::with('paieinformation:CCP,hand_id')->withTrashed()->get(['id','nameFr','dob']);

        return view('admin.historique.index')->with('hands',$hands);

    }

    public function HistoriquePaie($id){
        
        $hand = Hand::with(['paieinformation:CCP,hand_id','paies'=>function($q){
            $q->orderBy('anneesPaiement','DESC')->orderBy('moisPaiement');
        }])->withTrashed()->where('id',$id)->first(['id','nameFr','dob','codeCommune']);
        $commune = Commune::where('codeCommune',$hand->codeCommune)->first();
        $anneesArr = array();
        $moisArr = array();

        $i=0;
        foreach($hand->paies as $p ){
           $anneesArr = Arr::add($anneesArr, $i, $p->anneesPaiement);
           $moisArr = Arr::add($moisArr, $i, $p->moisPaiement);
           $i++;
        };
        
        return view('admin.historique.paiement')
                ->with('hand',$hand)
                ->with('commune',$commune)
                ->with('anneesPaiement',$anneesArr)
                ->with('moisPaiement',$moisArr);
    }

    public function HistoriqueSuspension($id){
        $hand = Hand::with(['paieinformation:CCP,hand_id','handSuspentionHistories'=>function($q){
            $q->orderBy('dateSupprission','DESC');
        }])->withTrashed()->where('id',$id)->first(['id','nameFr','dob','codeCommune']);
        $commune = Commune::where('codeCommune',$hand->codeCommune)->first();
        
        return view('admin.historique.suspension')
                ->with('hand',$hand)
                ->with('commune',$commune);
    }

    public function DeleteHistoriqueSuspension(HandSuspentionHistory $history){
        $history->delete();
        session()->flash('success','Paiement suspension history has been deleted successfully');
        return redirect()->back();
    }

    public function PaieYearHistory(){
        
    }
}
