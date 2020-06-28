<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Paie;
use DB;
class CdController extends Controller
{
    public function index(){
        return view('admin.CD.index');
    }

    public function CdClassique(Request $request){
        //
    }

    public function CdMondatement(Request $request){
        $HandPaie = DB::table('hands')
                    ->join('paie_information','paie_information.hand_id','hands.id')
                    ->join('hand_paie','hand_paie.hand_id','hands.id')
                    ->join('paies','paies.id','hand_paie.paie_id')
                    ->select('hands.nameFr','paie_information.RIP')
                    ->where('paies.moisPaiement','=',$request->moisPaiement)
                    ->where('paies.anneesPaiement','=',$request->anneePaiement)
                    ->get();
        dd($HandPaie);
    }

}
