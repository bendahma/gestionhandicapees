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

class DecisionController extends Controller
{

    public $hands;

    public function __construct() {
    
        $this->hands = new Hand;
    }

    public function index($listType){

        if($listType == 'paiement' || $listType == 'reglement'){
            $handList = $this->hands->HandMondate();
        } else if($listType == 'suspension'){
            $handList = $this->hands->HandSuspendu();
        } else if($listType == 'arrete'){
            $handList = $this->hands->HandArrete();
        }

        return view('admin.papiers.decision')->with('hands',$handList)
                                                    ->with('carts',CartHand::all())
                                                    ->with('paieinformations',PaieInformation::all())
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
        $handInfo = $hand->CheckBasicInfoExsists($hand);
        $PaieStatus = $status->CheckPaieStatusInfoExists($hand->id);
        $cardInfoExists =  $card->CheckCardInfoExists($hand->id);

        if(!$handInfo || !$cardInfoExists){
            session()->flash('error','Erreur, il faut remplir les informations du handicapée avant Télécharger la décision');
            return redirect(route('hands.edit', $hand));
        }

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
            $template->setValue('communeAr',$hand->communeAr);
            $template->setValue('natureAr',$hand->cartehand->natureHandAr);
            $template->setValue('dateDecision',$hand->paieinformation->datePremierPension);


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
            $template->setValue('communeAr',$hand->communeAr);
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
            $template->setValue('communeAr',$hand->communeAr);
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
        return response()->download(storage_path($output));
    }
}
