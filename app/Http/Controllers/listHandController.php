<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Exports\HandsPaiementExport;
use App\Exports\HandsPaiSuspenduExport;
use App\Exports\MonthlySuspensionExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Hand;
use App\CartHand;
use App\PaieInformation;
use App\HandPaieStatus;
use DB;
use Carbon\Carbon;

class listHandController extends Controller
{
    public $hands;

    public function __construct() {
    
        $this->hands = new Hand;
    }

    public function arrete(){

<<<<<<< HEAD
         $handSusp = $this->hands->HandSuspenduArrete();

        return view('admin.hands.lists.arrete')
                ->with('hands', $handSusp)
                ->with('carts',CartHand::all())
                ->with('paieinformations',PaieInformation::all());
=======
         $handSusp = cache()->remember('HAND_SUSPENDU',60*60*24,function(){
            return $this->hands->HandSuspenduArrete();
         });

        return view('admin.hands.lists.arrete')
                ->with('hands', $handSusp);
>>>>>>> ebcea4b0270816f32e0a24123fc7538b230a81b1
    }

    public function enAttente(){

<<<<<<< HEAD
        $handsList = $this->hands->HandEnAttente();

        return view('dashboard')
                ->with('hands', $handsList)
                ->with('carts',CartHand::all())
                ->with('paieinformations',PaieInformation::all());
=======
        $handsList = cache()->remember('HAND_SUSPENDU',60*60*24,function(){
            return $this->hands->HandEnAttente();
        });

        return view('admin.hands.lists.enattente')
                ->with('hands', $handsList);
>>>>>>> ebcea4b0270816f32e0a24123fc7538b230a81b1
    }

    public function encours(){

<<<<<<< HEAD
        $handsList = $this->hands->HandMondate();

        return view('admin.hands.lists.encours')
                ->with('hands', $handsList);
                // ->with('carts',CartHand::all())
                // ->with('paieinformations',PaieInformation::all());
=======
        $handsList = cache()->remember('HAND_SUSPENDU',60*60*24,function(){
            return $this->hands->HandMondate();
        });

        return view('admin.hands.lists.encours')
                ->with('hands', $handsList);
>>>>>>> ebcea4b0270816f32e0a24123fc7538b230a81b1
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

    public function exportHandsMondate(Request $request) 
    {
        return Excel::download(new HandsPaiementExport, 'HandsMondate.xlsx');
    }

    public function exportHandsSuspendu(){
        return Excel::download(new HandsPaiSuspenduExport, 'HandsSuspendu.xlsx');
    }

    public function suspensionHandRange(Request $request){

        return (new MonthlySuspensionExport($request))->download('Hand Suspendu.xlsx');

    }
}
