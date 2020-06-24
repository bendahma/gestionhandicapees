<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Paie;
use App\MoisAnnee;
use DB;
class StaticticsController extends Controller
{
    public function StatistiqueMensuelle(Request $request){

        $StatHand = DB::table('hands')
                ->join('hand_paie_statuses','hand_paie_statuses.hand_id','hands.id')
                ->whereBetween('hand_paie_statuses.dateSupprission' , [$request->dateDebutStat,$request->dateFinStat])
                ->select('hands.id', 'hand_paie_statuses.motifAr', 'hand_paie_statuses.dateSupprission')->get();
        
        $dcdCount = 0;
        $ReversionCNRCount = 0;
        $MOUDJAHIDINECount =0;
        $ASSAINISSEMENTCount =0;
        $CNRCount =0;
        $TravailHandCount =0;
        $PRISONCount =0;
        $RegistreCommerceCount =0;
        $ANGEMCount =0;
        $TourismeAgCount =0;
        $DESISTEMENTCount =0;
        $CHANGEMENT_WILAYACount =0;
        $AUTRECount =0;
        
        foreach($StatHand as $sh){
            $dcdCount =  $sh->motifAr== 'DCD' ? $dcdCount+=1 : $dcdCount;
            $ReversionCNRCount =  $sh->motifAr== 'ReversionCNR' ? $ReversionCNRCount+=1 : $ReversionCNRCount;
            $MOUDJAHIDINECount =  $sh->motifAr== 'MOUDJAHIDINE' ? $MOUDJAHIDINECount+=1 : $MOUDJAHIDINECount;
            $ASSAINISSEMENTCount =  $sh->motifAr== 'ASSAINISSEMENT' ? $ASSAINISSEMENTCount+=1 : $ASSAINISSEMENTCount;
            $CNRCount =  $sh->motifAr== 'CNR' ? $CNRCount+=1 : $CNRCount;
            $TravailHandCount =  $sh->motifAr== 'TravailHand' ? $TravailHandCount+=1 : $TravailHandCount;
            $PRISONCount =  $sh->motifAr== 'PRISON' ? $PRISONCount+=1 : $PRISONCount;
            $RegistreCommerceCount =  $sh->motifAr== 'RegistreCommerce' ? $RegistreCommerceCount+=1 : $RegistreCommerceCount;
            $ANGEMCount =  $sh->motifAr== 'ANGEM' ? $ANGEMCount+=1 : $ANGEMCount;
            $TourismeAgCount =  $sh->motifAr== 'TourismeAg' ? $TourismeAgCount+=1 : $TourismeAgCount;
            $DESISTEMENTCount =  $sh->motifAr== 'DESISTEMENT' ? $DESISTEMENTCount+=1 : $DESISTEMENTCount;
            $CHANGEMENT_WILAYACount =  $sh->motifAr== 'CHANGEMENT_WILAYA' ? $CHANGEMENT_WILAYACount+=1 : $CHANGEMENT_WILAYACount;
            $AUTRECount =  $sh->motifAr== 'AUTRE' ? $AUTRECount+=1 : $AUTRECount;
        }

        $allDeleted = $dcdCount + $ReversionCNRCount + $MOUDJAHIDINECount + $ASSAINISSEMENTCount + $CNRCount + $TravailHandCount + $PRISONCount + $RegistreCommerceCount + $TourismeAgCount +$ANGEMCount + $DESISTEMENTCount + $CHANGEMENT_WILAYACount + $AUTRECount;

        $paieInfo = Paie::where('moisPaiement',$request->moisPaie)->where('anneesPaiement',$request->AnneePaie)->first();
        $mois = MoisAnnee::find($request->moisPaie);
        $montant = $paieInfo->montantPaiement;
        $nbrHand = $montant / 10000;
        $moisAr = $mois->moisAr;



        $template = new \PhpOffice\PhpWord\TemplateProcessor(dirname(dirname(__DIR__)) . '\Templates\Staticticsmonthly.docx');
        $output = "Statistique.docx";
        $template->setValue('montant', number_format($montant,2,"."," "));
        $template->setValue('dateMondate', $request->dateMondate);
        $template->setValue('nbrHand', $nbrHand);
        $template->setValue('moisAr', $moisAr);
        $template->setValue('annee', date('Y'));
        

        $template->setValue('dc', $dcdCount);
        $template->setValue('rc', $ReversionCNRCount);
        $template->setValue('md', $MOUDJAHIDINECount);
        $template->setValue('as', $ASSAINISSEMENTCount);
        $template->setValue('cr', $CNRCount);
        $template->setValue('tv', $TravailHandCount);
        $template->setValue('pr', $PRISONCount);
        $template->setValue('rr', $RegistreCommerceCount);
        $template->setValue('ag', $ANGEMCount);
        $template->setValue('ta', $TourismeAgCount);
        $template->setValue('di', $DESISTEMENTCount);
        $template->setValue('cw', $CHANGEMENT_WILAYACount);
        $template->setValue('at', $AUTRECount);
        $template->setValue('all', $allDeleted);
        ob_end_clean();
        ob_start();
        $template->saveAs(storage_path($output));
        return response()->download(storage_path($output));
    }
}
