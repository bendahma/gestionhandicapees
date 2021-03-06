<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\MsnfcfImport;
use Maatwebsite\Excel\Facades\Excel;

use App\Hand;
use App\CartHand;
use App\PaieInformation;
use App\CarteNational;
use App\SecuriteSociale;
use App\HandPaieStatus;
use App\Rappel;
use App\HandSuspentionHistory;
use App\Commune;
use App\RenouvellementDossier;
use DB;

use DateTime;
use Artisan;

class HandsInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function create()
    {
        return view('admin.handsInfo.add')
                        ->with('communes',Commune::all());
    }

    public function store(Request $request)
    {
        
        $hand = new Hand();
        $cartHand = new CartHand();
        $paieInfo = new PaieInformation();
        $national = new CarteNational();
        $ss = new SecuriteSociale();
        $status = new HandPaieStatus();
        $dossierAnnuel = new RenouvellementDossier();

        $hand->numeroactenaissance = $request->numeroactenaissance;
        $hand->nameFr = $request->nameFr;
        $hand->nomAr = $request->nomAr;
        $hand->prenomAr = $request->prenomAr;
        $hand->sex = $request->sex;
        $hand->dob = $request->dob;
        $hand->lieuxNaissanceFr = $request->lieuxNaissanceFr;
        $hand->lieuxNaissanceAr = $request->lieuxNaissanceAr;
        $hand->address = $request->address;
        $hand->addressAr = $request->addressAr;
        $hand->codeCommune = $request->codeCommune;
        $hand->prenomPereFr = $request->prenomPereFr;
        $hand->nomMereFr = $request->nomMereFr;
        $hand->prenomMereFr = $request->prenomMereFr;
        $hand->prenomPereAr = $request->prenomPereAr;
        $hand->nomMereAr = $request->nomMereAr;
        $hand->prenomMereAr = $request->prenomMereAr;
        $hand->situationFamilialeFr = $request->situationFamilialeFr;
        $hand->situationFamilialeAr = $request->situationFamilialeAr;
        $hand->nbrenfant = $request->nbrenfant;
        $hand->obs = $request->obs;
        $hand->phone = $request->phone;
        $hand->save();
        
        $cartHand->numeroCart=$request->numeroCart;
        $cartHand->natureHandFr=$request->natureHandFr;
        $cartHand->natureHandAr=$request->natureHandAr;
        $cartHand->pourcentage=$request->pourcentage;
        $cartHand->dateCarte=$request->dateCarte;
        $cartHand->dateCommissionPension=$request->dateCommissionPension;
        $hand->cartehand()->save($cartHand);

        $paieInfo->CCP = $request->CCP;
        $paieInfo->RIP = $request->RIP;
        $paieInfo->datePremierPension = $request->datePremierPension;
        $paieInfo->dateDebutPension = $request->dateDebutPension;
        $paieInfo->dateDecisionPension = $request->dateDecisionPension;
        $hand->paieinformation()->save($paieInfo);

        $national->NumeroNational=$request->NumeroNational;
        $national->dateCarteIdentite=$request->dateCarteIdentite;
        $national->communeCarteNationalFr=$request->communeCarteNationalFr;
        $national->communeCarteNationalAr=$request->communeCarteNationalAr;
        $hand->cartenational()->save($national);

        $ss->NSS = $request->NSS;
        $ss->DateDebutAssurance = $request->DateDebutAssurance;
        $hand->securitesociale()->save($ss);
        
        $statusPaiement = $request->statusPaiement;
        $status->status = $statusPaiement;
        if($statusPaiement == 'En attente'){
            $status->raisonEnAttente = $request->raisonEnAttente;
            $status->EnAttentedateComissionPension = $request->EnAttentedateComissionPension;
        }
        $hand->status()->save($status);
        
        if($statusPaiement == 'En cours'){
            $dossierAnnuel->dossierRenouvelle = true;
            $dossierAnnuel->DateRenouvellement = date('Y-m').'-01';
            $hand->renouvellementdossier()->save($dossierAnnuel);
        }
        

        session()->flash('success', "L'handicapée a été ajouter avec success");

        return redirect(route('dashboard'));
    }

    public function show($id)
    {
        $hand = Hand::withTrashed()->where('id',$id)->first();  
        $commune = Commune::where('codeCommune',$hand->codeCommune)->first();
        return view('admin.handsInfo.show')
                ->with("hand",$hand)
                ->with('carts',CartHand::all())
                ->with('cartNational',CarteNational::all())
                ->with('paieinformations',PaieInformation::all())
                ->with('commune',$commune);
    }

    public function edit($id)
    {
        $hand = Hand::withTrashed()->where('id',$id)->first();
        return view('admin.handsInfo.add')
                ->with("hand",$hand)
                ->with('carts',CartHand::all())
                ->with('cartNational',CarteNational::all())
                ->with('paieinformations',PaieInformation::all())
                ->with('communes',Commune::all());

    }

    public function update(Request $request, $id)
    {
        $hand = Hand::withTrashed()->where('id',$id)->first();

        $cartHand = CartHand::where('hand_id', $hand->id)->first();
        $paieInfo = PaieInformation::where('hand_id', $hand->id)->first();
        $national = CarteNational::where('hand_id', $hand->id)->first();
        $ss = SecuriteSociale::where('hand_id', $hand->id)->first();
        $status = HandPaieStatus::where('hand_id', $hand->id)->first();
        
        $hand->update([
            'numeroactenaissance' => $request->numeroactenaissance,
            'nameFr' => $request->nameFr,
            'nomAr' => $request->nomAr,
            'prenomAr' => $request->prenomAr,
            'sex' => $request->sex,
            'dob' => $request->dob,
            'lieuxNaissanceFr' => $request->lieuxNaissanceFr,
            'lieuxNaissanceAr' => $request->lieuxNaissanceAr,
            'address' => $request->address,
            'addressAr' => $request->addressAr,
            'codeCommune' => $request->codeCommune,
            'prenomPereFr' => $request->prenomPereFr,
            'nomMereFr' => $request->nomMereFr,
            'prenomMereFr' => $request->prenomMereFr,
            'prenomPereAr' => $request->prenomPereAr,
            'nomMereAr' => $request->nomMereAr,
            'prenomMereAr' => $request->prenomMereAr,
            'situationFamilialeFr' => $request->situationFamilialeFr,
            'situationFamilialeAr' => $request->situationFamilialeAr,
            'nbrenfant' => $request->nbrenfant,
            'obs' => $request->obs,
            'phone' => $request->phone,
        ]);

        $cartHand->update([
            'numeroCart'=>$request->numeroCart,
            'natureHandFr'=>$request->natureHandFr,
            'natureHandAr'=>$request->natureHandAr,
            'pourcentage'=>$request->pourcentage,
            'dateCarte'=>$request->dateCarte,
            'dateCommissionPension'=>$request->dateCommissionPension,
        ]);

        $paieInfo->update([
            'CCP' => $request->CCP,
            'RIP' => $request->RIP,
            'datePremierPension' => $request->datePremierPension,
            'dateDebutPension' => $request->dateDebutPension,
            'dateDecisionPension' => $request->dateDecisionPension,
        ]);

        $national->update([
            'NumeroNational'=>$request->NumeroNational,
            'dateCarteIdentite'=>$request->dateCarteIdentite,
            'communeCarteNationalFr'=>$request->communeCarteNationalFr,
            'communeCarteNationalAr'=>$request->communeCarteNationalAr,
        ]);

        $ss->update([
            'NSS' => $request->NSS,
            'DateDebutAssurance' => $request->DateDebutAssurance
        ]);

        if($request->statusPaiement == 'En cours'){
            $status->update([
                'status' => $request->statusPaiement,
                'dateSupprission' => NULL,
                'justification' => NULL,
                'declarepar' => NULL,
                'motifAr' => NULL,
                'autreMotif' => NULL,
                'ObsSuspension' => NULL,
            ]);
        }else if($request->statusPaiement == 'En attente'){
            $status->update([
                'status' => $request->statusPaiement,
                'raisonEnAttente' => $request->raisonEnAttente,
                'EnAttentedateComissionPension' => $request->EnAttentedateComissionPension,
            ]);
        }

        

        session()->flash('success', "Les informations ont été mise a jours avec success");
        
        $incommingURL = $request->incomingRequest;
        
        return redirect($incommingURL);
    }

    public function destroy(Hand $hand,Request $request)
    {
        $status = HandPaieStatus::where('hand_id', $hand->id)->first();
        $history = new HandSuspentionHistory();
        // Paiement Status table
        $status->update([
            'status'=>$request->status,
            'motifAr'=>$request->motifAr,
            'autreMotif'=> $request->autreSupMotif,
            'ObsSuspension'=> $request->ObsSuspension,
            'dateSupprission'=>$request->dateSupprission,
            'justification'=>$request->justification,
            'declarepar' =>$request->declarepar
        ]);
        
        // Paiement History Table    
        $history->create([
            'status'=>$request->status,
            'motif'=>$request->motifAr,
            'dateSupprission'=>$request->dateSupprission,
            'hand_id'=>$hand->id
        ]);
        
        // Soft Delete Hand
        $hand->delete();

        session()->flash('danger', "L'handicapée à été supprime avec success");

        // return redirect(route('hand.suspendu',$hand->id));
        // return redirect(route('dashboard'));
        return redirect()->back();


    }

    public function restore($id,Request $request){
        $hand = Hand::withTrashed()->where('id',$id)->first();
        $rappel = new Rappel();
        $status = HandPaieStatus::where('hand_id',$id)->first();
        $hand->restore(); 

        $history = HandSuspentionHistory::where('hand_id',$hand->id)->latest('id')->first();
        
        if($history == NULL){
            $hist = new HandSuspentionHistory();
            $hist->create([
                'status' => $status->status,
                'dateSupprission' =>$status->dateSupprission,
                'motif' => $status->motifAr,
                'hand_id'=>$id
            ]);
        }
        

        if($request->status == "en cours"){
            $status->update([
                'status'=>$request->status,
                'motifAr'=>NULL,
                'dateSupprission'=>NULL,
                'justification'=>NULL,
                'declarepar'=>NULL,
                'raisonEnAttente'=>NULL,
                'EnAttentedateComissionPension'=>NULL
            ]);

            if($request->meriteRappel == 'oui'){
                $dateDebut = $request->dateDebut;
                $dateFin = $request->dateFin;
                $dateTimeDebut = new DateTime($dateDebut);
                $dateTimeFin = new DateTime($dateFin);
                $nbrMois= ($dateTimeDebut->diff($dateTimeFin)->m) + ($dateTimeDebut->diff($dateTimeFin)->y*12) + 1; 
                $montant = 0;
                $dateSeprator = '2019-09-30';
                $dateSeprator2 = '2019-10-01';
                $dateTimeSeperator = new DateTime($dateSeprator);
                $dateTimeSeperatorF = new DateTime($dateSeprator2);
                if($dateFin < $dateSeprator){
                    $montant = $nbrMois * 4000;
                }else if($dateDebut > $dateSeprator){
                    $montant = $nbrMois * 10000;
                }else{
                    $firstDif = ($dateTimeDebut->diff($dateTimeSeperator)->m) + ($dateTimeDebut->diff($dateTimeSeperator)->y*12) + 1; 
                    $secondDif = ($dateTimeSeperatorF->diff($dateTimeFin)->m) + ($dateTimeSeperatorF->diff($dateTimeFin)->y*12) + 1; 
                    $montant = ($firstDif * 4000) + ($secondDif * 10000);
                }
                
    
                // add rappel to database
                $rappel->DateDebut= $dateDebut;
                $rappel->DateFin= $dateFin;
                $rappel->nombreMois= $nbrMois;
                $rappel->montantRappel = $montant;
                $rappel->Rapple_Obs = $request->rappelObs;
                $rappel->save();
                $hand->rappels()->attach($rappel);
            }

            $history = HandSuspentionHistory::where('hand_id',$hand->id)->latest('id')->first();
            $history->update([
                'dateRemi' => $request->dateRemi
            ]);
            session()->flash('success', 'La situation du ' . $hand->nameFr . ' à été régle. ');
        }else if($request->status == 'En attente'){
            $status->update([
                'status'=>$request->status,
                'motifAr'=>NULL,
                'dateSupprission'=>NULL,
                'justification'=>NULL,
                'declarepar'=>NULL,
                'raisonEnAttente'=> $request->raisonEnAttente,
                'EnAttentedateComissionPension'=>isset($request->EnAttentedateComissionPension) ? $request->EnAttentedateComissionPension : NULL
            ]);
            session()->flash('warning', 'La situation du ' . $hand->nameFr . ' à été mette en Attente. ');
        }
        
        Artisan::call('cache:clear');

        return redirect()->back();
    }

    public function editHandSuspensionInfo($id){
        $status = HandPaieStatus::where('hand_id',$id)->first();
        return view('admin.handsInfo.editSuspension')
                        ->with('status',$status);
    }

    public function updateHandSuspensionInfo(Request $request){
        //
    }

    

    public function Msnfcf(Request $request){
        Excel::import(new MsnfcfImport, $request->file('msnfcf'));
        session()->flash('success','Rappel saisie avec success');
        return redirect()->back();
    }

    public function MsnfcfReinit(){
        DB::table('hands')->update(array('msnfcf' => 0));
        return back()->with('success','MSNFCF reinitialized successfully') ;
    }

    public function cleanData(){
        $results = DB::select( DB::raw("SELECT * FROM paie_information WHERE RIP LIKE '*%' ") );
        foreach ($results as $r) {
            $i = PaieInformation::where('RIP',$r->RIP)->first();
            $i->RIP = str_replace('*', '', $r->RIP);
            $i->save();
        }
        dd('Operation Completed Successfully');
    }


    public function checkRipCCP(){

        // $a = 'How are you?';

        // if (strpos($a, 'are') !== false) {
        //     echo 'true';
        // }

        // $arr = explode("/", $string, 2);
        // $first = $arr[0];   

        $results = PaieInformation::all();
        foreach ($results as $r) {
            $ccpc = explode("C", $$r->CCP, 2);
            $ccp = $ccpc[0];   
            if (strpos($r->RIP, $ccp) !== false) {
                dump($r->RIP . '   ' . $ccp);
            }
        }
        dd('Operation Completed Successfully');
    }

}
