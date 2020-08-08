<?php

namespace App\Http\Controllers;

use App\CfTresor;
use App\Paie;
use App\Rappel;
use Illuminate\Http\Request;

class CfTresorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cftresor = CfTresor::all();
        return view('admin.cftresor.index');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $type = $request->type;
        if($type = 'paie'){
            $paie = Paie::where('moisPaiement',$request->moisPaiement)->where('anneesPaiement',$request->anneePaiement)->first();
            $paie->cftresors()->create([
                'numEngagementPaie' => $request->NumEngagementPaie,
                'numEngagementAssurance' => $request->NumEngagementAssurance,
                'dateEngagement' => $request->dateEngagement,
                'numMondatePaiement' => $request->NumMondatePaie,
                'numMondateAssurance' => $request->NumMondateAssurance,
                'dateMondate' => $request->dateMondate,
                'operation' => $request->operation,
            ]);
        }else{
            $rappel = NULL;
        }

        
        

        session()->flash('success','Les Données Des Mondates Et Engagements Enregistre Avec Success.');

        return redirect(route('cftresor.index'));
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CfTresor  $cfTresor
     * @return \Illuminate\Http\Response
     */
    public function show(CfTresor $cfTresor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CfTresor  $cfTresor
     * @return \Illuminate\Http\Response
     */
    public function edit(CfTresor $cfTresor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CfTresor  $cfTresor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CfTresor $cfTresor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CfTresor  $cfTresor
     * @return \Illuminate\Http\Response
     */
    public function destroy(CfTresor $cfTresor)
    {
        //
    }
}
