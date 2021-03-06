<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

use App\Exports\RappelsExport;
use App\Imports\ListRappelFait;

use App\Hand;
use App\CartHand;
use App\PaieInformation;
use App\CarteNational;
use App\SecuriteSociale;
use App\HandPaieStatus;
use App\Rappel;
use App\HandSuspentionHistory;

use DateTime;
use Carbon\Carbon;

class RappelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(){
        $montantPaieTotal = 0;
        $montantAssuranceTotal = 0;
        $nbrRappel = 0;
        $nbrMoisTotal = 0;
        $nbrPersonneTotal = 0;


        $from = date('01/01/Y');
        $to = date('12/31/Y');

        $rappels = Rappel::whereBetween('DatePaiementRappel',[new Carbon($from),new Carbon($to)])->where('RappelFait',1)->get();

        // Les Rappel Fait
        foreach($rappels as $r){
            $nbrRappel += 1;
            $montantPaieTotal += $r->montantRappel;
            $montantAssuranceTotal += $r->montantAssurance;
            $nbrMoisTotal += $r->nombreMois;
            $nbrPersonneTotal +=$r->nombrePersonne; 
        }

        return view('admin.rappel.index')
                    ->with('nbrRappel',$nbrRappel)
                    ->with('nbrMois',$nbrMoisTotal)
                    ->with('nbrPersonne',$nbrPersonneTotal)
                    ->with('MontantRappel',$montantPaieTotal)
                    ->with('MontantAssurance',$montantAssuranceTotal);
    }

    public function listePaiementRappel(){        
        $RappelHandsInstance = DB::table('hands')
                                    ->join('paie_information','paie_information.hand_id','hands.id')
                                    ->join('hand_rappel','hand_rappel.hand_id','hands.id')
                                    ->join('rappels','rappels.id','hand_rappel.rappel_id')
                                    ->select('hands.nameFr', 'hands.dob','paie_information.CCP','rappels.dateDebut', 'rappels.dateFin','rappels.nombreMois','rappels.RappelFait','hand_rappel.hand_id','hand_rappel.rappel_id')
                                    ->orderBy('rappels.dateFin','desc')
                                    ->get();
        // dd($RappelHandsInstance);
        return view('admin.rappel.list')
                ->with('rappels',$RappelHandsInstance);
    }

    public function create()
    {
        return view('admin.rappel.create');
    }

    public function Add(){
        $hands = Hand::with(['paieinformation:hand_id,CCP','status:hand_id,status'])->get(['id','nameFr','dob']);
        return view('admin.rappel.add')->with('hands',$hands);
    }

    public function store(Request $request)
    {
        $hand = Hand::where('id',$request->hand_id)->first();
        $rappel = new Rappel();

        $dateDebut = $request->dateDebut;
        $dateFin = $request->dateFin;
        $d1 = new DateTime($dateDebut);
        $d2 = new DateTime($dateFin);
        $nbrMois= ($d1->diff($d2)->m) + ($d1->diff($d2)->y*12) + 1; 
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
            $firstDif = ($d1->diff($dateTimeSeperator)->m) + ($d1->diff($dateTimeSeperator)->y*12) + 1; 
            $secondDif = ($dateTimeSeperatorF->diff($d2)->m) + ($dateTimeSeperatorF->diff($d2)->y*12) + 1; 
            $montant = ($firstDif * 4000) + ($secondDif * 10000);
        }

       
            $rappel->DateDebut = $dateDebut;
            $rappel->DateFin = $dateFin;
            $rappel->montantRappel = $montant;
            $rappel->nombreMois = $nbrMois;
            $rappel->save();
       
        $hand->rappels()->attach($rappel);

        session()->flash('success','Le Rappel à été sasie avec success');

        return back();
    }

    public function Saisie(Request $request){
        
        DB::table('traitement_rappel')->insert([
            'montantRappel' =>  $request->montantPaiement,
            'montantAssurance' => $request->montantAssurance,
            'nombreMois' => $request->nbrMois,
            'nombrePersonne' => $request->nbrPersonne,
            'moisRappel' => $request->moisRappel,
            'anneesRappel' => $request->anneeRappel,
            'dateDebutRappel' => $request->dateDebutRappel,
            'dateFinRappel' => $request->dateFinRappel,
        ]);

        session()->flash('success','Rappel Added Successfully');
        return redirect(route('rappel.index'));
    }

    public function show($id)
    {
        //
    }

    public function findInfo(Rappel $rappel,Hand $hand)
    {
        return view('admin.rappel.edit')->with('hand',$hand)
                                       ->with('rappel',$rappel)
                                       ->with('paie',PaieInformation::all());
    }

    public function updateRappel(Request $request,Rappel $rappel)
    {
        $dateDebut = $request->dateDebut;
        $dateFin = $request->dateFin;
        $d1 = new DateTime($dateDebut);
        $d2 = new DateTime($dateFin);
        $nbrMois= ($d1->diff($d2)->m) + ($d1->diff($d2)->y*12) + 1; 
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
            $firstDif = ($d1->diff($dateTimeSeperator)->m) + ($d1->diff($dateTimeSeperator)->y*12) + 1; 
            $secondDif = ($dateTimeSeperatorF->diff($d2)->m) + ($dateTimeSeperatorF->diff($d2)->y*12) + 1; 
            $montant = ($firstDif * 4000) + ($secondDif * 10000);
        }
        $rappel->update([
            'DateDebut'=>$request->dateDebut,
            'DateFin'=>$request->dateFin,
            'nombreMois' =>$nbrMois,
            'montant' => $montant
        ]);

        session()->flash('success','Le rappel a été modifier avec success');

        return redirect()->route('rappel.list');
    }

    public function destroy(Rappel $rappel)
    {
        $rappel->delete();
        session()->flash('success','Rappel deleted successfully');
        return redirect()->back();
    }

    public function export() {
        $filename = 'RappelsEnCours' .date('YmdHis'). '.xlsx';
        ob_end_clean();
        ob_start();
        return Excel::download(new RappelsExport, $filename);
    }

    public function ConfirmRappel(Rappel $rappel){

        $rappel->update([
            'RappelFait'=>1
        ]);

        session()->flash('success','Rappel a été confirme');

        return redirect()->back();

    }


    public function rappelFait(Request $request){

        Excel::import(new ListRappelFait, $request->file('listRappelHand'));
        
        session()->flash('success','Rappel saisie avec success');
        return redirect()->back();
    }

    public function Documents(){
       return view('admin.rappel.documents');
    }

    public function Download(Request $request){

      switch ($request->has('document')) {
         case 'decision':
            dd($request->all());
            break;
         
         default:
            # code...
            break;
      }
       
    }
}
