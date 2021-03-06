<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Hand;
use App\CartHand;
use App\PaieInformation;
use App\CarteNational;
use App\SecuriteSociale;
use App\HandPaieStatus;
use App\HandSuspentionHistory;
use App\Commune;
class DecisionController extends Controller
{

    public $hands;

    public function __construct() {
    
        $this->hands = new Hand;
    }

    public function index($listType){

        if($listType == 'paiement' || $listType == 'reglement'){
            $handList = cache()->remember('HAND_MONDATE',60*60*12,function(){
                return $this->hands->HandMondate();
            });

        } else if($listType == 'suspension'){
            $handList = cache()->remember('HAND_SUSPENDU',60*60*12,function(){
                return $this->hands->HandSuspenduArrete();
            });

        } else if($listType == 'arrete'){
            $handList = cache()->remember('HAND_ENATTENTE',60*60*12,function(){
                return $this->hands->HandSuspenduArrete();
            });
        }

        return view('admin.papiers.decision')->with('hands',$handList)
                                             ->with('papier',$listType);
    }

    public function Download($id,$papier){
        $templateDecisionPaie = new \PhpOffice\PhpWord\TemplateProcessor(dirname(dirname(__DIR__)) . '\Templates\DecisionNouveauMondate.docx');
        $templateDecisionRegleQuatreMille = new \PhpOffice\PhpWord\TemplateProcessor(dirname(dirname(__DIR__)) . '\Templates\DecisionRegle4000.docx');
        $templateDecisionRegleDixMille = new \PhpOffice\PhpWord\TemplateProcessor(dirname(dirname(__DIR__)) . '\Templates\DecisionRegle10000.docx');
        $templateDecisionSuspenduDixMille = new \PhpOffice\PhpWord\TemplateProcessor(dirname(dirname(__DIR__)) . '\Templates\DecisionSuspension10000.docx');
        $templateDecisionSuspenduQuatreMille = new \PhpOffice\PhpWord\TemplateProcessor(dirname(dirname(__DIR__)) . '\Templates\DecisionSuspension4000.docx');
        $templateDecisionArreteDixMille = new \PhpOffice\PhpWord\TemplateProcessor(dirname(dirname(__DIR__)) . '\Templates\DecisionArrete10000.docx');
        $templateDecisionArreteQuatreMille = new \PhpOffice\PhpWord\TemplateProcessor(dirname(dirname(__DIR__)) . '\Templates\DecisionArrete4000.docx');

        $hand = Hand::withTrashed()->where('id',$id)->first();
        $status = new HandPaieStatus();
        $card = new CartHand();
        $handInfo = $hand->CheckBasicInfoExsistsForDecision($hand);
        $PaieStatus = $status->CheckPaieStatusInfoExists($hand->id);

        if(!$handInfo){
            session()->flash('error','Erreur, il faut remplir les informations du handicapée avant Télécharger la décision');
            return redirect(route('hands.edit', $hand));
        }

        $commune = Commune::where('codeCommune',$hand->codeCommune)->first();

        if($papier == 'paiement'){
            $status = $hand->status->status;
            if($status != 'En cours'){
                session()->flash('error','Vous ne pouver pas Télecharger la decision du paiement, L\'handicapée n\'est pas mondate.');
                return redirect()->back();
            }
            $template = $templateDecisionPaie ;
            $template->setValue('nomAr',$hand->nomAr);
            $template->setValue('prenomAr',$hand->prenomAr);
            $template->setValue('dob',$hand->dob);
            $template->setValue('communeNaiAr',$hand->lieuxNaissanceAr);
            $template->setValue('addressAr',$hand->addressAr);
            $template->setValue('communeAr',$commune->nomCommuneAr);
            $template->setValue('natureAr',$hand->cartehand->natureHandAr);
            $template->setValue('dateDecision',$hand->cartehand->dateCarte);
            $template->setValue('nCart',$hand->cartehand->numeroCart);
            $template->setValue('dateCart',$hand->cartehand->dateCarte);
            $template->setValue('datedebut',$hand->paieinformation->dateDebutPension);
            $template->setValue('dateCommission',$hand->cartehand->dateCommissionPension);

            $output = "Décision Paiement " . $hand->nameFr .".docx";
        }
        else if($papier == 'reglement'){
            $status = $hand->status->status;

            $history = HandSuspentionHistory::where('hand_id',$hand->id)->latest('id')->first();

            if($status != 'En cours'){
                session()->flash('error','Vous ne pouver pas Télecharger la decision du paiement, L\'handicapée n\'est pas mondate.');
                return redirect()->back();
            }

            $template = $history->dateSupprission < '2019-10-01' ? $templateDecisionRegleQuatreMille : $templateDecisionRegleDixMille;
            $template->setValue('nomAr',$hand->nomAr);
            $template->setValue('prenomAr',$hand->prenomAr);
            $template->setValue('dob',$hand->dob);
            $template->setValue('addressAr',$hand->addressAr);
            $template->setValue('communeAr',$commune->nomCommuneAr);
            $template->setValue('dateSupp',$history->dateSupprission);
            $template->setValue('dateRemi',$history->dateRemi);
            
            $output = "Décision Régle " . $hand->nameFr .".docx";

        }
        else if($papier == 'suspension'){
            $status = $hand->status->status;
            if($status == 'En cours'){
                session()->flash('error','Vous ne pouver pas Télecharger la decision du suspendion, L\'handicapée est encore mondate.');
                return redirect()->back();
            }
            $template = $hand->status->dateSupprission < '2019-10-01' ? $templateDecisionSuspenduQuatreMille : $templateDecisionSuspenduDixMille;

            $template->setValue('nomAr',$hand->nomAr);
            $template->setValue('prenomAr',$hand->prenomAr);
            $template->setValue('dob',$hand->dob);
            $template->setValue('addressAr',$hand->addressAr);
            $template->setValue('communeAr',$commune->nomCommuneAr);
            $template->setValue('dateSusp',$hand->status->dateSupprission);
            $template->setValue('motifSusp',$hand->status->getMotifAr($hand->status->motifAr));
            $output = "Décision Suspension " . $hand->nameFr .".docx";
        }
        else if($papier == 'arrete'){
            $status = $hand->status->status;
            if($status == 'En cours'){
                session()->flash('error','Vous ne pouver pas Télecharger la decision d\'arrete, L\'handicapée est mondate.');
                return redirect()->back();
            }
            $template = $hand->status->dateSupprission < '2019-10-01' ? $templateDecisionArreteQuatreMille : $templateDecisionArreteDixMille;

            $template->setValue('nomAr',$hand->nomAr);
            $template->setValue('prenomAr',$hand->prenomAr);
            $template->setValue('dob',$hand->dob);
            $template->setValue('communeNaisAR',$hand->lieuxNaissanceAr);
            $template->setValue('dateSusp',$hand->status->dateSupprission);
            $template->setValue('motif',$hand->status->getMotifAr($hand->status->motifAr));
            $output = "Décision Arrete " . $hand->nameFr .".docx";

        }
        ob_end_clean();
        ob_start();
        $template->saveAs(storage_path($output));
        return response()->download(storage_path($output))->deleteFileAfterSend(true);
    }

    public function RenouvellementDossier($id){
        $templateDecisionRegleDixMille = new \PhpOffice\PhpWord\TemplateProcessor(dirname(dirname(__DIR__)) . '\Templates\DecisionRegle10000Renouvellementٌ.docx');
        $hand = Hand::withTrashed()->where('id',$id)->first();
        $status = new HandPaieStatus();
        $card = new CartHand();
        $handInfo = $hand->CheckBasicInfoExsistsForDecision($hand);
        $PaieStatus = $status->CheckPaieStatusInfoExists($hand->id);

        if(!$handInfo){
            session()->flash('error','Erreur, il faut remplir les informations du handicapée avant Télécharger la décision');
            return redirect(route('hands.edit', $hand));
        }

        $commune = Commune::where('codeCommune',$hand->codeCommune)->first();
        
        $status = $hand->status->status;

        $history = HandSuspentionHistory::where('hand_id',$hand->id)->latest('id')->first();

        if($status != 'En cours'){
            session()->flash('error','Vous ne pouver pas Télecharger la decision du paiement, L\'handicapée n\'est pas mondate.');
            return redirect()->back();
        }

        $template = $templateDecisionRegleDixMille;
        $template->setValue('nomAr',$hand->nomAr);
        $template->setValue('prenomAr',$hand->prenomAr);
        $template->setValue('dob',$hand->dob);
        $template->setValue('addressAr',$hand->addressAr);
        $template->setValue('communeAr',$commune->nomCommuneAr);
        $template->setValue('nature',$hand->cartehand->natureHandAr);
        $template->setValue('numero',$hand->cartehand->numeroCart);
        $template->setValue('dateCart',$hand->cartehand->dateCarte);
        $template->setValue('dateSupp',$history->dateSupprission);
        $template->setValue('dateRemi',$history->dateRemi);
        
        $output = "Décision Régle " . $hand->nameFr .".docx";
        ob_end_clean();
        ob_start();
        $template->saveAs(storage_path($output));
        return response()->download(storage_path($output))->deleteFileAfterSend(true);
    }
}
