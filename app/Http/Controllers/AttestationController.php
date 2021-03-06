<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Hand;
use App\CartHand;
use App\PaieInformation;
use App\CarteNational;
use App\SecuriteSociale;
use App\HandPaieStatus;
use App\Commune;

use Auth;

class AttestationController extends Controller
{
    
    public function index($listType){

        if($listType == 'paiement'){

            $hands = cache()->remember('ATTESTATION_PAIEMENT',60*60*24,function(){
                return Hand::all();
            });

        }else if($listType == 'perde'){

            $hands = cache()->remember('ATTESTATION_PAIEMENT',60*60*24,function(){
                return Hand::all();
            });

        } else if($listType == 'desistement'){
            $hands = cache()->remember('ATTESTATION_DESISTEMENT',60*60*24,function(){
                return Hand::onlyTrashed()->get();
            });
        }

        return view('admin.papiers.attestation')->with('hands',$hands)
                                                ->with('type',$listType);
    }

    public function Download($id,$papier){
        $templateAttPaie = new \PhpOffice\PhpWord\TemplateProcessor(dirname(dirname(__DIR__)) . '\Templates\AttestationPaiement.docx');
        $templateAttPerde = new \PhpOffice\PhpWord\TemplateProcessor(dirname(dirname(__DIR__)) . '\Templates\AttestationPerde.docx');
        $templateDesistement = new \PhpOffice\PhpWord\TemplateProcessor(dirname(dirname(__DIR__)) . '\Templates\DesistementPaie.docx');

        $hand = Hand::withTrashed()->where('id',$id)->first();
        $card =new CartHand();
        $CarteNational = new CarteNational();
        $status = new HandPaieStatus();
        $handInfo = $hand->CheckBasicInfoExsists($hand);
        $CardHandInfo =$card->CheckCardInfoExists($hand->id);
        $CardNationalInfo =$CarteNational->CheckCarteNationalInfoExists($hand->id);
        $PaieStatus = $status->CheckPaieStatusInfoExists($hand->id);

        if(!$handInfo && !$CardHandInfo && !$CardNationalInfo){
            session()->flash('error','Erreur, il faut remplir les informations du handicapée avant Télécharger l\'attestation');
            return redirect(route('hands.edit', $hand));
        }

        $commune = Commune::where('codeCommune',$hand->codeCommune)->first();


        if($papier == 'paiement') {
            $status = $hand->status->status;

            if($status != 'En cours'){
                session()->flash('error','Vous ne pouver pas Télecharger l\'attestation du paiement, L\'handicapée n\'est pas mondate.');
                return redirect()->back();
            }

            $template = $templateAttPaie ;
            $template->setValue('dateAj',date('Y/m/d'));
            $template->setValue('annee',date('Y'));
            $template->setValue('nomAr',$hand->nomAr);
            $template->setValue('prenomAr',$hand->prenomAr);
            $template->setValue('dob',$hand->dob);
            $template->setValue('communeNaissanceAr',$hand->lieuxNaissanceAr);
            $template->setValue('adresseAr',$hand->addressAr);
            $template->setValue('commueAr',$commune->nomCommuneAr);
            $template->setValue('NCarteNational',$hand->cartenational->NumeroNational);
            $template->setValue('dateCartNation',$hand->cartenational->dateCarteIdentite);
            $template->setValue('comCartNat',$hand->cartenational->communeCarteNationalAr);
            $template->setValue('natureAr',$hand->cartehand->natureHandAr);
            $template->setValue('usernameAr',Auth::user()->nameAr);
            $output = "Attestation Paiement " . $hand->nameFr .".docx";
        }else if($papier == 'perde') {
            $template = $templateAttPerde ;
            $template->setValue('dateAj',date('Y/m/d'));
            $template->setValue('annee',date('Y'));
            $template->setValue('nomAr',$hand->nomAr);
            $template->setValue('prenomAr',$hand->prenomAr);
            $template->setValue('dob',$hand->dob);
            $template->setValue('communeNaissanceAr',$hand->lieuxNaissanceAr);
            $template->setValue('adresseAr',$hand->addressAr);
            $template->setValue('commueAr',$commune->nomCommuneAr);
           
            $template->setValue('natureAr',$hand->cartehand->natureHandAr);
            $template->setValue('usernameAr',Auth::user()->nameAr);
            $output = "Attestation Perde " . $hand->nameFr .".docx";
        }
        
        else if($papier == 'desistement'){
            $status = $hand->status->status;
            if($status == 'En cours'){
                session()->flash('error','L\'Handicapée est en cours de paiement,Suspendu le avant Téléchargé l\'attestation du désistement');
                return redirect('dashboard');
            }

            // if(!$PaieStatus){
            //     session()->flash('error','Les informations du suspension n\'ont pas completes');
            //     return redirect('dashboard');
            // }
           
            $template = $templateDesistement ;

            $template->setValue('dateAj',date('Y/m/d'));
            $template->setValue('annee',date('Y'));
            $template->setValue('nomAr',$hand->nomAr);
            $template->setValue('prenomAr',$hand->prenomAr);
            $template->setValue('dob',$hand->dob);
            $template->setValue('communeNaissAr',$hand->lieuxNaissanceAr);
            $template->setValue('addressAr',$hand->addressAr);
            $template->setValue('communeAr',$commune->nomCommuneAr);
            $template->setValue('dateDessis',$hand->status->dateSupprission);
            $template->setValue('motifDessi',$hand->status->motifAr);
            $template->setValue('usernameAr',Auth::user()->name);
            $output = "Désistement Paie " . $hand->nameFr .".docx";
            
        }
        
        ob_end_clean();
        ob_start();
        $template->saveAs(storage_path($output));
        return response()->download(storage_path($output))->deleteFileAfterSend(true);
    }
}
