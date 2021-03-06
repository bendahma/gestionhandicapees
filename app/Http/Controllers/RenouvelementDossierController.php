<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Facades\Excel;
use App\Hand;
use App\CartHand;
use App\PaieInformation;
use App\RenouvellementDossier;
use App\Commune;
use App\HandSuspentionHistory;
use App\Imports\DossierAnnuelRenouvelleImport;
use App\Exports\HandNonRenouvelle;
use DB;
use Artisan;
class RenouvelementDossierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hands = Hand::whereHas('renouvellementdossier',function($q){
                $q->where('dossierRenouvelle',0);
            })->with('renouvellementdossier')->get();
        return view('admin.renouvellement.index')->with('hands', $hands);
    }

    public function DossierRemi(Request $request, $id){

        $renv = RenouvellementDossier::where('hand_id', $id)->first();
        $renv->dossierRenouvelle = true;
        $renv->DateRenouvellement = $request->dateRenouvelloment;
        $renv->AnneeRenouvelement = date('Y');
        $renv->save();

        
        session()->flash('success','l\'operation terminé avec success');
        return redirect(route('renouvellement.index'));
    }

    public function Statistique(){
        
        $renouvelle = new RenouvellementDossier();
        $commune = Commune::all();

         $hands = Hand::all();

        $handsGrp = Hand::get()->groupBy('codeCommune');
        
        $handRen = Hand::whereHas('renouvellementdossier',function($query){
            $query->where('dossierRenouvelle',1);
        })->orderBy('codeCommune','ASC')->get()->groupBy('codeCommune');
           
        // dd($handRen);
        return view('admin.renouvellement.stat')
                    ->with('hands', $hands)
                    ->with('handsGrp', $handsGrp)
                    ->with('communes',$commune)
                    ->with('HandRen',$handRen)
                    ->with('renouvelle', $renouvelle->GetNbrRenouvelle())
                    ->with('nonRenouvelle', $renouvelle->GetNbrnonRenouvelle());
    }
    
    public function Init(){

        $renouvelle = DB::table('renouvellement_dossiers')->where('dossierRenouvelle', '=', true)->update(array('dossierRenouvelle' => false,'DateRenouvellement'=>NULL));

        session()->flash('success', 'L\'operation de renouvellemenr des dossiers été renouvelle pour l\'annee '. date('Y'));

        return redirect()->back();
    }


    public function suspenduTousNonRenouvelle(){

        $history = new HandSuspentionHistory();

        $handNonRen = Hand::whereHas('renouvellementdossier',function($query){
                $query->where('dossierRenouvelle' ,0);
                })->whereHas('status',function($query){
                                $query->where('status','En cours');
                })->get();

        $dateSupprission = date('Y-m').'-01' ;
        
        foreach ($handNonRen as $hand) {

            $hand->status->update([
                'status' => 'Suspendu',
                'dateSupprission' => $dateSupprission,
                'motifAr' => 'DOSSIER ANNUEL'
            ]); 
            
            $history->create([
                'status'=>'Suspendu',
                'motif'=>'DOSSIER ANNUEL',
                'dateSupprission'=>$dateSupprission,
                'hand_id'=>$hand->id
            ]);
 
            $hand->delete();

        }

        session()->flash('success','Tous les handicapées non renouvelle leur dossier annuel sont suspendu avec success');
        
        return redirect(route('renouvellement.statistique'));
    }

    public function suspenduNonRenouvelle(Request $request){

        $history = new HandSuspentionHistory();


        $handNonRen = Hand::whereHas('renouvellementdossier',function($query){
            $query->where('dossierRenouvelle' ,0);
        })->whereHas('status',function($query){
            $query->where('status','En cours');
        })->where('codeCommune',$request->codeCommune)->get();

        foreach ($handNonRen as $hand) {

            $hand->status->update([
                'status' => 'Suspendu',
                'dateSupprission' => $request->dateSuspension,
                'motifAr' => 'DOSSIER ANNUEL'
            ]); 
            
            $history->create([
                'status'=>'Suspendu',
                'motif'=>'DOSSIER ANNUEL',
                'dateSupprission'=>$request->dateSuspension,
                'hand_id'=>$hand->id
            ]);
 
            $hand->delete();

        }

        session()->flash('success','Les Handicapées Non Renouvelle Son Dossier Annuel Ont été Suspendu Avec Success');
        
        return redirect(route('renouvellement.statistique'));
                
    }

    public function ListNonRenouvelle($code){
        $handNonRen = Hand::whereHas('renouvellementdossier',function($query){
            $query->where('dossierRenouvelle' ,0);
        })->whereHas('status',function($query){
            $query->where('status','En cours');
        })->where('codeCommune',$code)->get();

        $commune = Commune::where('codeCommune',$code)->first();

        return view('admin.renouvellement.list')
                        ->with('handNonRen', $handNonRen)
                        ->with('commune', $commune);
    }

    public function export() {
        $filename = 'Lists des non renouvelle' .date('YmdHis'). '.xlsx';
        ob_end_clean();
        ob_start();
        return Excel::download(new HandNonRenouvelle, $filename);
    }

    public function renouvelleDossierFromFile(Request $request){
        
        Excel::import(new DossierAnnuelRenouvelleImport, $request->file('dossierAnnuelRenouvelle'));
        
        session()->flash('success','Données import avec success');
        
        return redirect()->back();
    }

    public function ListNonRenouvelleToutes(){
        $hands = DB::table('hands')
                ->join('hand_paie_statuses','hand_paie_statuses.hand_id','hands.id')
                ->join('renouvellement_dossiers','renouvellement_dossiers.hand_id','hands.id')
                ->select('hands.*','renouvellement_dossiers.*' ) 
                ->where('hand_paie_statuses.status','=','En cours')
                ->where('renouvellement_dossiers.dossierRenouvelle','=','1')
                ->get();

        return view('admin.renouvellement.renouvelle')
                ->with('hands',$hands);
    }
}
