<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Hand;
use App\CartHand;
use App\PaieInformation;
use App\CarteNational;
use App\SecuriteSociale;
use App\HandPaieStatus;
use App\Rappel;
use App\HandSuspentionHistory;
use App\Commune;
use DateTime;

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
        return view('admin.handsInfo.add')->with('communes',Commune::all());
    }

    public function store(Request $request)
    {
        //dd($hand);
        //dd($request->all());
        $hand = new Hand();

        $cartHand = new CartHand();
        $paieInfo = new PaieInformation();
        $national = new CarteNational();
        $ss = new SecuriteSociale();
        $status = new HandPaieStatus();
        
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
        $hand->commune = $request->commune;
        $hand->communeAr = $request->communeAr;
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
        $hand->save();
        
        $cartHand->numeroCart=$request->numeroCart;
        $cartHand->natureHandFr=$request->natureHandFr;
        $cartHand->natureHandAr=$request->natureHandAr;
        $cartHand->pourcentage=$request->pourcentage;
        $cartHand->dateCarte=$request->dateCarte;
        $hand->cartehand()->save($cartHand);

        $paieInfo->CCP = $request->CCP;
        $paieInfo->RIP = $request->RIP;
        $paieInfo->datePremierPension = $request->datePremierPension;
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
        //dd($hand);
        //dd($request->all());
        $hand = Hand::withTrashed()->where('id',$id)->first();

        $cartHand = CartHand::where('hand_id', $hand->id)->first();
        $paieInfo = PaieInformation::where('hand_id', $hand->id)->first();
        $national = CarteNational::where('hand_id', $hand->id)->first();
        $ss = SecuriteSociale::where('hand_id', $hand->id)->first();
        
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
            'codeCommune' => $request->commune,
            'communeAr' => $request->communeAr,
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
        ]);

        $cartHand->update([
            'numeroCart'=>$request->numeroCart,
            'natureHandFr'=>$request->natureHandFr,
            'natureHandAr'=>$request->natureHandAr,
            'pourcentage'=>$request->pourcentage,
            'dateCarte'=>$request->dateCarte
        ]);

        $paieInfo->update([
            'CCP' => $request->CCP,
            'RIP' => $request->RIP,
            'datePremierPension' => $request->datePremierPension,
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

        session()->flash('success', "Les informations ont été mise a jours avec success");

        return redirect('dashboard');
    }

    public function destroy(Hand $hand,Request $request)
    {
        $status = HandPaieStatus::where('hand_id', $hand->id)->first();
        $history = new HandSuspentionHistory();
        // Paiement Status table
        $status->update([
            'status'=>$request->status,
            'motifAr'=>$request->motifAr,
            'dateSupprission'=>$request->dateSupprission,
            'justification'=>$request->justification,
            'declarepar' =>$request->declarepar
        ]);
        // Paiement History Table    
        $history->create([
            'status'=>$request->status,
            'motif'=>$request->motif,
            'dateSupprission'=>$request->dateSupprission,
            'hand_id'=>$hand->id
        ]);
        
        // Soft Delete Hand
        $hand->delete();

        session()->flash('danger', "L'handicapée à été supprime avec success");

        return redirect(route('dashboard'));

    }

    public function restore($id,Request $request){
        $hand = Hand::withTrashed()->where('id',$id)->first();
        $rappel = new Rappel();
        $status = HandPaieStatus::where('hand_id',$hand->id);
        $hand->restore(); 

        
        

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
        
        return redirect()->back();
    }
}
