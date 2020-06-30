<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;

use App\Hand;
use App\CartHand;
use App\PaieInformation;
use App\HandPaieStatus;
use DB;
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
        // Communes

        if($request->communes == NULL || $request->communes[0] == 'allCommune'){
                $communechoice = false;
                $communes='';
        }

        $communechoice = true;
        $communes = collect($request->communes);
                        
        
        // NATURE
        if($request->natures == NULL || $request->natures[0] == 'allNature'){
            $naturechoice = false;
                $nature='';
        }

        $naturechoice = true;
        $nature = collect($request->natures);
        
        // SEX
        
        dump($communechoice);
        dump($communes);
        dump($naturechoice);
        dump($nature);
    }
}
