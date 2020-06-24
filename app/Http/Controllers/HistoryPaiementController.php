<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Hand;
use App\CartHand;
use App\PaieInformation;
use App\HandPaieStatus;
use App\Paie;

class HistoryPaiementController extends Controller
{

    public function index(){
        return view('admin.historique.index')
                ->with('hands',Hand::withTrashed()->get())
                ->with('cards',CartHand::all())
                ->with('paieinformation',PaieInformation::all());
    }

    public function MoisPaiements($id){
        
        $hand = Hand::withTrashed()->where('id',$id)->first();

        $paies = Hand::withTrashed()->where('id',$id)->with('paies:moisPaiement,anneesPaiement')->get();

        $anneesArr = array();

        $i=0;
        foreach ($paies as $paie) {
                foreach($paie->paies as $p ){
                    $anneePaie = array_add($array, $i, $p->anneesPaiement);

                    dump($p->moisPaiement);
                };
        }

        return view('admin.historique.paiement')
                ->with('hand',$hand);
    }

    public function HistoreSuspension(Hand $hand){
        //
    }

    public function PaieYearHistory(){
        
    }
}
