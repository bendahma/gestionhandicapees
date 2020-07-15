<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Hand;
use App\CartHand;
use App\PaieInformation;
use App\RenouvellementDossier;
use DB;

class RenouvelementDossierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hands = Hand::with('cartehand')->with('renouvellementdossier')->with('paieinformation')->withTrashed()->get();
        
        return view('admin.renouvellement.index')->with('hands', $hands);
    
    }

    public function DossierRemi(Request $request, Hand $hand){

        $renv = RenouvellementDossier::where('hand_id', $hand->id)->firstOrFail();

        $renv->update([
            'dossierRenouvelle'=>true,
            'DateRenouvellement'=>$request->dateRenouvelloment,
            'AnneeRenouvelement'=>date('Y')
        ]);

        return redirect()->back();
    }

    public function Statistique(){

        $hands = Hand::with('renouvellementdossier')->orderBy('codeCommune','ASC')->get();
        $renouvelle = new RenouvellementDossier();

        return view('admin.renouvellement.stat')
                    ->with('hands', $hands)
                    ->with('renouvelle', $renouvelle->GetNbrRenouvelle());
    }
    
    public function Init(){

        $renouvelle = DB::table('renouvellement_dossiers')->where('dossierRenouvelle', '=', true)->update(array('dossierRenouvelle' => false,'DateRenouvellement'=>NULL));


        session()->flash('success', 'L\'operation de renouvellemenr des dossiers été renouvelle pour l\'annee '. date('Y'));

        return redirect()->back();
    }
}
