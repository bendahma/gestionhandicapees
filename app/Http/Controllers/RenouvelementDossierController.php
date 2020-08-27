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
        $hands = cache()->remember('HAND_RENOUVELLEMENT',60*60*24,function(){
            return Hand::with('renouvellementdossier')->get(['id','nameFr','dob']);
        }); 
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
        
        $renouvelle = new RenouvellementDossier();
        $commune = Commune::all();

        $hands = Hand::with('renouvellementdossier')
                    ->orderBy('codeCommune','ASC')
                    ->get();        

        $handsGrp = Hand::get()->groupBy('codeCommune');
        
        // $handRen = Hand::whereHas('renouvellementdossier',function($query){
        //     $query->where('dossierRenouvelle',1);
        // })->orderBy('codeCommune','ASC')->get()->groupBy('codeCommune');
        $handRen = Hand::whereHas('renouvellementdossier',function($query){
            $query->where('dossierRenouvelle','=',true);
        })->get();
        
        dd($handRen);
        
        return view('admin.renouvellement.stat')
                    ->with('hands', $hands)
                    ->with('handsGrp', $handsGrp)
                    ->with('communes',$commune)
                    ->with('HandRen',$handRen)
                    ->with('renouvelle', $renouvelle->GetNbrRenouvelle());
    }
    
    public function Init(){

        $renouvelle = DB::table('renouvellement_dossiers')->where('dossierRenouvelle', '=', true)->update(array('dossierRenouvelle' => false,'DateRenouvellement'=>NULL));

        session()->flash('success', 'L\'operation de renouvellemenr des dossiers été renouvelle pour l\'annee '. date('Y'));

        return redirect()->back();
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
        Artisan::call('cache:clear');
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
}
