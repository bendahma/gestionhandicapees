<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Hand;
use App\CartHand;
use App\PaieInformation;
use App\HandPaieStatus;
use App\MoisAnnee;
use App\Commune;

use DataTables;
use Debugbar;
use Auth;
class MainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        return view('index');
    }


    public function dashboard()
    {
        $hands = Hand::with(['paieinformation:hand_id,CCP','status:hand_id,status'])->withTrashed()->get(['id','nameFr','dob']);
        
        

        return view('dashboard')
                    ->with('hands',$hands);       
    }

    public function suspendu($id){
        $hand = Hand::with(['status','renouvellementdossier'])->withTrashed()->where('id',$id)->first();
        $commune = Commune::where('codeCommune',$hand->codeCommune)->first();
        return view('admin.handsInfo.suspendu')
                                ->with("hand",$hand)
                                ->with("commune",$commune);

    }

    public function Notification($id,$papier){
        $template = $papier == 'suspension' ? new \PhpOffice\PhpWord\TemplateProcessor(dirname(dirname(__DIR__)) . '\Templates\notificationSuspensionTemp.docx ') 
                                            : new \PhpOffice\PhpWord\TemplateProcessor(dirname(dirname(__DIR__)) . '\Templates\notificationSuspension.docx ');
    

        $hand = Hand::withTrashed()->where('id',$id)->first();
        $status = new HandPaieStatus();
        $card = new CartHand();
        $handInfo = $hand->CheckBasicInfoExsistsForDecision($hand);
        $PaieStatus = $status->CheckPaieStatusInfoExists($hand->id);

        

        $commune = Commune::where('codeCommune',$hand->codeCommune)->first();

       
       
        
        $template->setValue('nom',$hand->nomAr);
        $template->setValue('prenom',$hand->prenomAr);
        $template->setValue('dob',$hand->dob);
        $template->setValue('address',$hand->addressAr);
        $template->setValue('commune',$commune->nomCommuneAr);
        $template->setValue('datesupp',$hand->status->dateSupprission);
        if($hand->status->status = 'AUTRE'){
            $template->setValue('motifAr',$hand->status->autreMotif);

        }else{
            $template->setValue('motifAr',$hand->status->getMotifAr($hand->status->motifAr));
        }
        $output = "Notification pension " . $hand->nameFr .".docx";

        ob_end_clean();
        ob_start();
        $template->saveAs(storage_path($output));
        return response()->download(storage_path($output))->deleteFileAfterSend(true);
    }
}
