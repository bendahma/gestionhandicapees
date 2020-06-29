<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Hand;
use App\CartHand;
use App\PaieInformation;
use App\HandPaieStatus;

class listHandController extends Controller
{
    public $hands;

    public function __construct() {
    
        $this->hands = new Hand;
    }

    public function suspendu(){

         $handSusp = $this->hands->HandSuspendu();

        return view('dashboard')
                ->with('hands', $handSusp)
                ->with('carts',CartHand::all())
                ->with('paieinformations',PaieInformation::all());
    }

    public function arrete(){

        $handsList = $this->hands->HandArrete();

        return view('dashboard')
                ->with('hands', $handsList)
                ->with('carts',CartHand::all())
                ->with('paieinformations',PaieInformation::all());
    }

    public function enAttente(){

        $handsList = $this->hands->HandEnAttente();

        return view('dashboard')
                ->with('hands', $handsList)
                ->with('carts',CartHand::all())
                ->with('paieinformations',PaieInformation::all());
    }

    public function encours(){

        $handsList = $this->hands->HandMondate();

        return view('dashboard')
                ->with('hands', $handsList)
                ->with('carts',CartHand::all())
                ->with('paieinformations',PaieInformation::all());
    }

    public function Filtre(){
        return view('admin.statistics.listFiltre');
    }

    public function FiltreListeHand(Request $request){
        dump($request->all());
        $communes = $request->input('communes');
        foreach($communes as $commune){
            dump($commune);
        }
    }
}
