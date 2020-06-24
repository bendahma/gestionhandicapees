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
        $hands = Hand::all();

        return view('admin.renouvellement.index')
                ->with('hands', $hands)
                ->with('carts', CartHand::all())
                ->with('carts', CartHand::all())
                ->with('renouvellement', RenouvellementDossier::all())
                ->with('paieinformations', PaieInformation::all());
    
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Hand $hand)
    {

        
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

        $hands = Hand::all();
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
