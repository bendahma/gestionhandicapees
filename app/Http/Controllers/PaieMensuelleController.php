<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

use App\Exports\HandExport;
use Maatwebsite\Excel\Facades\Excel;
use DB;


use App\Hand;
use App\Paie;
use App\HandPaieStatus;
use App\Hand_Paie;
use App\MoisAnnee;
use App\Budget;

require_once('ChiffresEnLettres.php');

class PaieMensuelleController extends Controller
{


    public function index() {
        // Getting the lists of hands - En cours : Suspendu : Arrete
        $hands = Hand::whereHas('status',function($s){
            $s->where('status', 'en cours');
        })->get();

        $handsSuspendu = Hand::onlyTrashed()->whereHas('status',function($s){
            $s->where('status', 'suspendu');
        })->get();

        $handsArrete = Hand::onlyTrashed()->whereHas('status',function($s){
            $s->where('status', 'Arrete');
        })->get();

        // Calculating
        $countHand = $hands->count();
        $montantPaie = $countHand * 10000;
        $montantAssurance = $countHand * 1000;
        $CheckBudget = Budget::where('annee', date('Y'))->first();
        $paieExist = Paie::where('anneesPaiement',date('Y'))->where('moisPaiement', date('m'))->first();
        
        if($CheckBudget == NULL){            
            $budget = Budget::create([
                'annee' => date('Y'),
                'budgetMondatement' => 0,
                'budgetAssurance' =>0,
                'budgetMondatementConsomme' =>0,
                'budgetAssuranceConsomme' =>0,
            ]);
        }else {
            $budget=Budget::where('annee', date('Y'))->first();
        }
        if(!$paieExist){
            //Create Paiement 
            $currentPaie = Paie::create([
                'moisPaiement'=>date('m'),
                'anneesPaiement'=>date('Y'),
                'montantPaiement'=>0,
                'montantAssurance'=>0
            ]);

            // Calculate the budget consumption for current year without current month
            $BudgetConsumption = DB::table('paies')
                    ->select('anneesPaiement', DB::raw('sum(montantPaiement) as totalMontantPaie'),DB::raw('sum(montantAssurance) as totalMontantAssurance'))
                    ->groupBy('anneesPaiement')
                    ->having('anneesPaiement', '=', date('Y'))
                    ->first();

            $currentPaie->update([
                'montantPaiement'=> $montantPaie,
                'montantAssurance'=> $montantAssurance
            ]);

            // Update Budget table
            $budget->update([
                'budgetMondatementConsomme' => $BudgetConsumption->totalMontantPaie,
                'budgetAssuranceConsomme' => $BudgetConsumption->totalMontantAssurance
            ]);   
            
        }

        if($paieExist){
            $paieExist->hands()->detach($handsSuspendu);
            $paieExist->hands()->detach($handsArrete);
            if (!$paieExist->hands->contains($paieExist->id)) {
                $paieExist->hands()->attach($hands);
            }
        }
        
        
        return view('admin.paie.resume')
                    ->with('CurrentPaie',$paieExist)
                    ->with('count',$countHand);
        
    }

    public function export() {
        $filename = 'EtatPaiementHands' .date('YmdHis'). '.xlsx';
        ob_end_clean();
        ob_start();
        return Excel::download(new HandExport, $filename);
    }

    public function Cnas($papier){   
        if($papier == 'BORDEREAU'){
            $template = new \PhpOffice\PhpWord\TemplateProcessor(dirname(dirname(__DIR__)) . '\Templates\CnasBord.docx');
            $output = 'BordereauCnas.docx';
        }else if($papier == 'COTISATION'){
            $template = new \PhpOffice\PhpWord\TemplateProcessor(dirname(dirname(__DIR__)) . '\Templates\CotisationCnas.docx');
            $output = 'CotisationCnas.docx';
        }else if($papier == 'AVIS'){
            $template = new \PhpOffice\PhpWord\TemplateProcessor(dirname(dirname(__DIR__)) . '\Templates\AVISDEVIREMENTCNAS.doc');
            $output = 'AvisVirement.docx';
        }
        else{
            return redirect()->back();
        }
        
        $nbrHand= Hand::whereHas('status',function($s){
            $s->where('status', 'en cours');
        })->get();
        $annee = date('Y');
        $moisN = date('m');
        $mois = MoisAnnee::find($moisN);
        $nbrHandCount = $nbrHand->count();
        $VSAC = $nbrHandCount * 20000;
        $MSAC = ($VSAC * 5)/100;
        $ChiffreEnLettre = new ChiffreEnLettres();
        $ChiffreEnLettreOutput= $ChiffreEnLettre->Conversion($MSAC);
        $template->setValue('nbrHand', $nbrHandCount);
        $template->setValue('VSAC', number_format($VSAC,2,',',' '));
        $template->setValue('MSAC',  number_format($MSAC,2,',',' '));
        $template->setValue('annee',  $annee);
        $template->setValue('mois',  $mois->moisFr);
        $template->setValue('montantLettre',  strtoupper($ChiffreEnLettreOutput));
        ob_end_clean();
        ob_start();
        $template->saveAs(storage_path($output));
        return response()->download(storage_path($output));
    }

    public function decision(){
        $template = new \PhpOffice\PhpWord\TemplateProcessor(dirname(dirname(__DIR__)) . '\Templates\DECISION.docx');
        $output = 'Decision.docx';
        $nbrHand= Hand::whereHas('status',function($s){
            $s->where('status', 'en cours');
        })->get();
        $annee = date('Y');
        $mois = MoisAnnee::find(date('m'));
        $nbrHandCount = $nbrHand->count();
        $montantChiffre = $nbrHandCount * 10000;
        // dd($montantChiffre);
        $montantLettreAr = new ChiffreEnLettresArb($montantChiffre,"male");
        $c = $montantLettreAr->convert_number();
        $template->setValue('montantChiffreAr', number_format($montantChiffre,2,',',' '));
        $template->setValue('montantLettreAr', $c);
        $template->setValue('annee',  $annee);
        $template->setValue('moisAr',  $mois->moisAr);
        ob_end_clean();
        ob_start();
        $template->saveAs(storage_path($output));
        return response()->download(storage_path($output));
    }

    public function Journal(){      
        $template = new \PhpOffice\PhpWord\TemplateProcessor(dirname(dirname(__DIR__)) . '\Templates\JOURNAL.docx');
        $output = 'JOURNAL.docx';
        $nbrHand= Hand::whereHas('status',function($s){
            $s->where('status', 'en cours');
        })->get();
        $an = date('Y');
        $nbrHandCount = $nbrHand->count();
        $montantPaie = $nbrHandCount * 10000;
        $montantCnas = $nbrHandCount * 1000;
        $template->setValue('montantPaie', number_format($montantPaie,2,',',' '));
        $template->setValue('montantCnas', number_format($montantCnas,2,',',' '));
        $template->setValue('an', $an);
        ob_end_clean();
        ob_start();
        $template->saveAs(storage_path($output));
        return response()->download(storage_path($output));
    }

    public function BordereauCf(){        
        $template = new \PhpOffice\PhpWord\TemplateProcessor(dirname(dirname(__DIR__)) . '\Templates\BORDEREAUCF.docx');
        $annee = date('Y');
        $mois = MoisAnnee::find(date('m'));
        $template->setValue('annee', $annee);
        $template->setValue('mois', $mois->moisAr);
        ob_end_clean();
        ob_start();
        $template->saveAs(storage_path('Bordereau CF.docx'));
        return response()->download(storage_path('Bordereau CF.docx'));
    }

    public function BordereauCD(){  
        
        $nbrHand= Hand::whereHas('status',function($s){
            $s->where('status', 'en cours');
        })->get();

        $montantPaie= $nbrHand->count()*10000;
        
        $template = new \PhpOffice\PhpWord\TemplateProcessor(dirname(dirname(__DIR__)) . '\Templates\BordereauCD.docx');
        $annee = date('Y');
        $mois = MoisAnnee::find(date('m'));
        $template->setValue('annee', $annee);
        $template->setValue('mois', $mois->moisAr);
        $template->setValue('montant', number_format($montantPaie,2,',',' '));
        ob_end_clean();
        ob_start();
        $template->saveAs(storage_path('BordereauCD.docx'));
        return response()->download(storage_path('BordereauCD.docx'));
    }

    public function Repartition(){
        
        $template = new \PhpOffice\PhpWord\TemplateProcessor(dirname(dirname(__DIR__)) . '\Templates\Repartition.docx');
        
        $hands = DB::table('hands')
                    ->join('hand_paie_statuses', function ($join) {
                        $join->on('hands.id', '=', 'hand_paie_statuses.hand_id')
                        ->where('hand_paie_statuses.status', '=', 'en cours');
                })->select('commune', DB::raw('count(*) as total'))
                ->groupBy('commune')
                ->having('total', '>=', '0')
                ->get();

        // $t =0;
        // foreach ($hands as $h) {
        //     dump($h->commune . "  " . $h->total);
        //     $t+=$h->total;
        // }
        // dd($t);

        $nbrt =0;
        foreach ($hands as $h) {
            $nbrt+=$h->total;
        }
       
        foreach ($hands as $hand){
            switch($hand->commune){
                case " EL AMRIA":
                    $ELAMRIA = $hand->total;
                case "A-TEMOU":
                    $AT = $hand->total;
                case "AGHLLAL":
                    $AGHLLAL = $hand->total;
                case "AIN KIHAL":
                    $AINKIHAL = $hand->total;
                case "AIN LABAA":
                    $AINLABAA = $hand->total;
                case "AIN TOLBA":
                    $AINTOLBA = $hand->total;
                case "AOUGBELLIL":
                    $AOUGBELLIL = $hand->total;
                case "BENI SAF":
                    $BENISAF = $hand->total;
                case "BOUZEDJAR":
                    $BOUZEDJAR = $hand->total;
                case "CHAABAT":
                    $CHAABAT = $hand->total;
                case "CHENTOUF":
                    $CHENTOUF = $hand->total;
                case "El MALEH":
                    $ElMALEH = $hand->total;
                case "EMIR-AEK":
                    $EMIRAEK = $hand->total;
                case "H-El-Ghella":
                    $HElGhella = $hand->total;
                case "HASSASNA":
                    $HASSASNA = $hand->total;
                case "HBH":
                    $HBH = $hand->total;
                case "M'SAID":
                    $MSAID = $hand->total;
                case "O-Berkeche":
                    $OBerkeche = $hand->total;
                case "O-Boudjema":
                    $OBoudjema = $hand->total;
                case "O-SEBBAH":
                    $OSEBBAH = $hand->total;
                case "Ouled- kihal":
                    $Ouledkihal = $hand->total;
                case "OULHAÇA":
                    $OULHACA = $hand->total;
                case "S-Boumediene":
                    $SBoumediene = $hand->total;
                case "SIDI BEN ADDA":
                    $SIDIBENADDA = $hand->total;
                case "SIDI Ouriache":
                    $SIDIOuriache = $hand->total;
                case "SIDI SAFI":
                    $SIDISAFI = $hand->total;
                case "TAMEZOURA":
                    $TAMEZOURA = $hand->total;
                case "TERGA":
                    $TERGA = $hand->total;
            }
        }

        $montantChiffre = $nbrt*10000;
        $annee = date('Y');
        $mois = MoisAnnee::find(date('m'));
        
        $montantLettre = new ChiffreEnLettresArb($montantChiffre,"male");
        $montantLettreAr = $montantLettre->convert_number();

        $template->setValue('annee', $annee);
        $template->setValue('mois', $mois->moisAr);
        
        $template->setValue('AT', $AT);
        $template->setValue('ADDA', $SIDIBENADDA);
        $template->setValue('MALEH', $ElMALEH);
        $template->setValue('CHABAT', $CHAABAT);
        $template->setValue('TERGA', $TERGA);
        $template->setValue('OKIHEL', $Ouledkihal);
        $template->setValue('AMRIA', $ELAMRIA);
        $template->setValue('HASSI', $HElGhella);
        $template->setValue('BOUDJ', $OBoudjema);
        $template->setValue('BOUZED', $BOUZEDJAR);
        $template->setValue('MSAID', $MSAID);
        $template->setValue('HBH', $HBH);
        $template->setValue('CHENT', $CHENTOUF);
        $template->setValue('HSASNA', $HASSASNA);
        $template->setValue('BERKEC', $OBerkeche);
        $template->setValue('AREBA', $AINLABAA);
        $template->setValue('BOUMD', $SBoumediene);
        $template->setValue('SEBAH', $OSEBBAH);
        $template->setValue('TEMEZ', $TAMEZOURA);
        $template->setValue('AKIHEL', $AINKIHAL);
        $template->setValue('TOLBA', $AINTOLBA);
        $template->setValue('AGHLAL', $AGHLLAL);
        $template->setValue('OUBEL', $AOUGBELLIL);
        $template->setValue('BSAF', $BENISAF);
        $template->setValue('SSAF', $SIDISAFI);
        $template->setValue('EMIR', $EMIRAEK);
        $template->setValue('OULHACA', $OULHACA);
        $template->setValue('OURIACH', $SIDIOuriache);

        $template->setValue('ATMNT', number_format($AT * 10000,'2',',',' '));
        $template->setValue('ADDAMNT', number_format($SIDIBENADDA * 10000,'2',',',' '));
        $template->setValue('MALEHMNT', number_format($ElMALEH* 10000,'2',',',' '));
        $template->setValue('CHABATMNT', number_format($CHAABAT* 10000,'2',',',' '));
        $template->setValue('TERGAMNT', number_format($TERGA* 10000,'2',',',' '));
        $template->setValue('OKIHELMNT', number_format($Ouledkihal* 10000,'2',',',' '));
        $template->setValue('AMRIAMNT', number_format($ELAMRIA* 10000,'2',',',' '));
        $template->setValue('HASSIMNT', number_format($HElGhella* 10000,'2',',',' '));
        $template->setValue('BOUDJMNT', number_format($OBoudjema* 10000,'2',',',' '));
        $template->setValue('BOUZEDMNT', number_format($BOUZEDJAR* 10000,'2',',',' '));
        $template->setValue('MSAIDMNT', number_format($MSAID* 10000,'2',',',' '));
        $template->setValue('HBHMNT', number_format($HBH* 10000,'2',',',' '));
        $template->setValue('CHENTMNT', number_format($CHENTOUF* 10000,'2',',',' '));
        $template->setValue('HSASNAMNT', number_format($HASSASNA* 10000,'2',',',' '));
        $template->setValue('BERKECMNT', number_format($OBerkeche* 10000,'2',',',' '));
        $template->setValue('AREBAMNT', number_format($AINLABAA* 10000,'2',',',' '));
        $template->setValue('BOUMDMNT', number_format($SBoumediene* 10000,'2',',',' '));
        $template->setValue('SEBAHMNT', number_format($OSEBBAH* 10000,'2',',',' '));
        $template->setValue('TEMEZMNT', number_format($TAMEZOURA* 10000,'2',',',' '));
        $template->setValue('AKIHELMNT', number_format($AINKIHAL* 10000,'2',',',' '));
        $template->setValue('TOLBAMNT', number_format($AINTOLBA* 10000,'2',',',' '));
        $template->setValue('AGHLALMNT', number_format($AGHLLAL* 10000,'2',',',' '));
        $template->setValue('OUBELMNT', number_format($AOUGBELLIL* 10000,'2',',',' '));
        $template->setValue('BSAFMNT', number_format($BENISAF* 10000,'2',',',' '));
        $template->setValue('SSAFMNT', number_format($SIDISAFI* 10000,'2',',',' '));
        $template->setValue('EMIRMNT', number_format($EMIRAEK* 10000,'2',',',' '));
        $template->setValue('OULHACAMNT', number_format($OULHACA* 10000,'2',',',' '));
        $template->setValue('OURIACHMNT', number_format($SIDIOuriache* 10000,'2',',',' '));

        $template->setValue('DATEM', number_format(($AT + $SIDIBENADDA) * 10000,'2',',',' '));
        $template->setValue('DAMALEH', number_format(($ElMALEH + $CHAABAT+$Ouledkihal +$TERGA )* 10000,'2',',',' '));
        $template->setValue('DAAMRIA', number_format(($ELAMRIA +$HElGhella +$OBoudjema +$BOUZEDJAR + $MSAID)* 10000,'2',',',' '));
        $template->setValue('DAHBH', number_format(($HBH +$CHENTOUF +$HASSASNA +$OBerkeche)* 10000,'2',',',' '));
        $template->setValue('DAAREBA', number_format(($AINLABAA +$SBoumediene +$OSEBBAH +$TAMEZOURA)* 10000,'2',',',' '));
        $template->setValue('DAAINKIHEL', number_format(($AINKIHAL + $AINTOLBA+$AGHLLAL +$AOUGBELLIL)* 10000,'2',',',' '));
        $template->setValue('DABENISAF', number_format(($BENISAF +$SIDISAFI +$EMIRAEK)* 10000,'2',',',' '));
        $template->setValue('DAOULHACA', number_format(($OULHACA+ $SIDIOuriache)* 10000,'2',',',' '));

        $template->setValue('SOMCOMUN', ($AT + $SIDIBENADDA + $ElMALEH + $CHAABAT+$Ouledkihal +$TERGA + $ELAMRIA +$HElGhella +$OBoudjema +$BOUZEDJAR + $MSAID+$HBH +$CHENTOUF +$HASSASNA +$OBerkeche+$AINLABAA +$SBoumediene +$OSEBBAH +$TAMEZOURA+$AINKIHAL + $AINTOLBA+$AGHLLAL +$AOUGBELLIL));
        $template->setValue('MNCOMUN', number_format(($AT + $SIDIBENADDA + $ElMALEH + $CHAABAT+$Ouledkihal +$TERGA + $ELAMRIA +$HElGhella +$OBoudjema +$BOUZEDJAR + $MSAID+$HBH +$CHENTOUF +$HASSASNA +$OBerkeche+$AINLABAA +$SBoumediene +$OSEBBAH +$TAMEZOURA+$AINKIHAL + $AINTOLBA+$AGHLLAL +$AOUGBELLIL) * 10000 ,'2',',',' '));
        $template->setValue('SOMCOMDX', ($BENISAF +$SIDISAFI +$EMIRAEK + $OULHACA+ $SIDIOuriache));
        $template->setValue('MNCOMDX', number_format(($BENISAF +$SIDISAFI +$EMIRAEK + $OULHACA+ $SIDIOuriache) * 10000 ,'2',',',' '));
        $template->setValue('nbrhandtotal', ($AT + $SIDIBENADDA + $ElMALEH + $CHAABAT+$Ouledkihal +$TERGA + $ELAMRIA +$HElGhella +$OBoudjema +$BOUZEDJAR + $MSAID+$HBH +$CHENTOUF +$HASSASNA +$OBerkeche+$AINLABAA +$SBoumediene +$OSEBBAH +$TAMEZOURA+$AINKIHAL + $AINTOLBA+$AGHLLAL +$AOUGBELLIL) + ($BENISAF +$SIDISAFI +$EMIRAEK + $OULHACA+ $SIDIOuriache));
        $template->setValue('mnthandtotal', number_format((($AT + $SIDIBENADDA + $ElMALEH + $CHAABAT+$Ouledkihal +$TERGA + $ELAMRIA +$HElGhella +$OBoudjema +$BOUZEDJAR + $MSAID+$HBH +$CHENTOUF +$HASSASNA +$OBerkeche+$AINLABAA +$SBoumediene +$OSEBBAH +$TAMEZOURA+$AINKIHAL + $AINTOLBA+$AGHLLAL +$AOUGBELLIL) + ($BENISAF +$SIDISAFI +$EMIRAEK + $OULHACA+ $SIDIOuriache)) * 10000 ,'2',',',' '));
        
        
        $template->setValue('montantAr', $montantLettreAr);

        ob_end_clean();
        ob_start();
        $template->saveAs(storage_path('Repartition.docx'));
        return response()->download(storage_path('Repartition.docx'));
        
    }

    public function Engagement($papier){

        $template = ($papier == 'Paiement') ? new \PhpOffice\PhpWord\TemplateProcessor(dirname(dirname(__DIR__)) . '\Templates\ENGAGEMENTPaie.docx')
                                            : new \PhpOffice\PhpWord\TemplateProcessor(dirname(dirname(__DIR__)) . '\Templates\ENGAGEMENTCnas.docx');
        $filename = ($papier == 'Paiement') ? 'Engagement 46-15'
                                            : 'Engagement 33-13';
        
        $paie = Paie::where('anneesPaiement',date('Y'))->where('moisPaiement', date('m'))->first();
        $budget = Budget::where('annee',date('Y'))->first();

        
        $moisN = date('m');
        $mois = MoisAnnee::find($moisN);
        $moisAr = $mois->moisAr;

        $montantLettre = new ChiffreEnLettresArb($paie->montantPaiement,"male");
        $montantLettreAr = $montantLettre->convert_number();

        $montantLettreCnas = new ChiffreEnLettresArb($paie->montantAssurance,"male");
        $montantLettreCNasAr = $montantLettreCnas->convert_number();


        $template->setValue('annee', date('Y'));
        $template->setValue('mois', $moisAr);
        //46-15
        $template->setValue('montanP', number_format($paie->montantPaiement,0,',',' '));
        $template->setValue('consom', number_format(($budget->budgetMondatement - $budget->budgetMondatementConsomme),0,',',' '));
        $template->setValue('reste', number_format(($budget->budgetMondatement - ($budget->budgetMondatementConsomme + $paie->montantPaiement)),0,',',' '));
        $template->setValue('montantLettre', $montantLettreAr);
        //33-13
        $template->setValue('montanCnas', number_format($paie->montantAssurance,0,',',' '));
        $template->setValue('consomCnas', number_format(($budget->budgetAssurance - $budget->budgetAssuranceConsomme),0,',',' '));
        $template->setValue('resteCnas', number_format(($budget->budgetAssurance - ($budget->budgetAssuranceConsomme + $paie->montantAssurance)),0,',',' '));
        $template->setValue('montantLettreCNas', $montantLettreCNasAr);
        ob_end_clean();
        ob_start();
        $template->saveAs(storage_path($filename. " ".$mois->moisFr." ".date('Y').".docx"));
        return response()->download(storage_path($filename. " ".$mois->moisFr. " ".date('Y').".docx"));
        
    }

    public function Mondate($papier){

        $template = ($papier == 'Paiement') ? new \PhpOffice\PhpWord\TemplateProcessor(dirname(dirname(__DIR__)) . '\Templates\MANDATEPaiement.docx')
                                            : new \PhpOffice\PhpWord\TemplateProcessor(dirname(dirname(__DIR__)) . '\Templates\MANDATECnas.docx');
        $filename = ($papier == 'Paiement') ? 'Mondate 46-15'
                                            : 'Mondate 33-13';
        
        $paie = Paie::where('anneesPaiement',date('Y'))->where('moisPaiement', date('m'))->first();
        $budget = Budget::where('annee',date('Y'))->first();

        
        $moisN = date('m');
        $mois = MoisAnnee::find($moisN);
        $moisAr = $mois->moisFr;

        $ChiffreEnLettrePaie = new ChiffreEnLettres();
        $ChiffreEnLettrePaieFr = $ChiffreEnLettrePaie->Conversion($paie->montantPaiement);
        
        $ChiffreEnLettreCnas = new ChiffreEnLettres();
        $ChiffreEnLettreCnasFr = $ChiffreEnLettreCnas->Conversion($paie->montantAssurance);

        


        $template->setValue('annee', date('Y'));
        $template->setValue('mois', strtoupper($moisAr));
        //46-15
        $template->setValue('montantP', number_format($paie->montantPaiement,2,',',' '));
        $template->setValue('ChiffreEnLettreFr', strtoupper($ChiffreEnLettrePaieFr));
        //33-13
        $template->setValue('montantCnas', number_format($paie->montantAssurance,2,',',' '));
        $template->setValue('ChiffreEnLettreCnasFr', strtoupper($ChiffreEnLettreCnasFr));
        ob_end_clean();
        ob_start();
        $template->saveAs(storage_path($filename. " ".$mois->moisFr." ".date('Y').".docx"));
        return response()->download(storage_path($filename. " ".$mois->moisFr. " ".date('Y').".docx"));
        
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}