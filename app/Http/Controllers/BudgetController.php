<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

use App\Budget;
use App\Paie;

class BudgetController extends Controller
{
    public function index()
    {
        $budget = Budget::where('annee',date('Y'))->first();
        return view('admin.budget.index')->with('budget', $budget);
    }

    public function create()
    {
        return view('admin.budget.add');
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $annee)
    {
        $budget = Budget::where('annee',$annee)->first();
        $budget->update([
            'budgetMondatement'=> $request->budgetMondatement,
            'budgetAssurance' => $request->budgetAssurance
        ]);
        
        session()->flash('success','Le budget d\'année ' . $annee . ' à été ajouter avec success');
        
        return redirect(route('dashboard'));
        
    }

    public function destroy($id)
    {
        //
    }

    public function DownloadBudgetConsomptionPaie(){


        $template = new \PhpOffice\PhpWord\TemplateProcessor(dirname(dirname(__DIR__)) . '\Templates\BUDGETSTAT.docx');


        $annee = date('Y');
        $budget = Budget::where('annee',$annee)->first();
        $budgetPaiement = $budget->budgetMondatement;
        $budgetAssurance = $budget->budgetAssurance;

        $Pjanv = Paie::where('anneesPaiement',$annee)->where('moisPaiement','01')->first(); 
        $Pfevr = Paie::where('anneesPaiement',$annee)->where('moisPaiement','02')->first(); 
        $Pmars = Paie::where('anneesPaiement',$annee)->where('moisPaiement','03')->first(); 
        $Pavr  = Paie::where('anneesPaiement',$annee)->where('moisPaiement','04')->first(); 
        $Pmai  = Paie::where('anneesPaiement',$annee)->where('moisPaiement','05')->first(); 
        $Pjuin = Paie::where('anneesPaiement',$annee)->where('moisPaiement','06')->first(); 
        $Pjuil = Paie::where('anneesPaiement',$annee)->where('moisPaiement','07')->first(); 
        $Paout = Paie::where('anneesPaiement',$annee)->where('moisPaiement','08')->first(); 
        $Psept = Paie::where('anneesPaiement',$annee)->where('moisPaiement','09')->first(); 
        $Poct  = Paie::where('anneesPaiement',$annee)->where('moisPaiement','10')->first(); 
        $Pnov  = Paie::where('anneesPaiement',$annee)->where('moisPaiement','11')->first(); 
        $Pdec  = Paie::where('anneesPaiement',$annee)->where('moisPaiement','12')->first(); 

        $PaieJanv = $Pjanv != NULL ? $Pjanv->montantPaiement : 0;
        $PaieFev = $Pfevr != NULL ? $Pfevr->montantPaiement : 0;
        $PaieMars = $Pmars!= NULL ? $Pmars->montantPaiement : 0;
        $PaieAvr = $Pavr != NULL ? $Pavr->montantPaiement : 0;
        $PaieMai = $Pmai != NULL ? $Pmai->montantPaiement : 0;
        $PaieJuin = $Pjuin != NULL ? $Pjuin->montantPaiement : 0;
        $PaieJuil = $Pjuil != NULL ? $Pjuil->montantPaiement : 0;
        $PaieAout = $Paout != NULL ? $Paout->montantPaiement : 0;
        $PaieSept = $Psept != NULL ? $Psept->montantPaiement : 0;
        $PaieOct = $Poct != NULL ? $Poct->montantPaiement : 0;
        $PaieNov = $Pnov != NULL ? $Pnov->montantPaiement : 0;
        $PaieDec = $Pdec != NULL ? $Pdec->montantPaiement : 0;

        $NbrJan = $PaieJanv == 0 ? 0 : $PaieJanv/10000;
        $NbrFev = $PaieFev == 0 ? 0 : $PaieFev/10000;
        $NbrMars = $PaieMars == 0 ? 0 : $PaieMars/10000;
        $NbrAvr = $PaieAvr == 0 ? 0 : $PaieAvr/10000;
        $NbrMai = $PaieMai == 0 ? 0 : $PaieMai/10000;
        $NbrJuin = $PaieJuin == 0 ? 0 : $PaieJuin/10000;
        $NbrJuil = $PaieJuil == 0 ? 0 : $PaieJuil/10000;
        $NbrAout = $PaieAout == 0 ? 0 : $PaieAout/10000;
        $NbrSept = $PaieSept == 0 ? 0 : $PaieSept/10000;
        $NbrOct = $PaieOct == 0 ? 0 : $PaieOct/10000;
        $NbrNov = $PaieNov == 0 ? 0 : $PaieNov/10000;
        $NbrDec = $PaieDec == 0 ? 0 : $PaieDec/10000;



        // RAPPEL HAND NUMBERS
        $NbrRappelJan = 0;
        $NbrRappelFev = 0;
        $NbrRappelMars = 0;
        $NbrRappelAvr = 0;
        $NbrRappelMai = 0;
        $NbrRappelJuin = 0;
        $NbrRappelJuil = 0;
        $NbrRappelAout = 0;
        $NbrRappelSept = 0;
        $NbrRappelOct = 0;
        $NbrRappelNov = 0;
        $NbrRappelDec = 0;

        // MONTANT RAPPEL HAND
        $MontantRappelJanv = 0;
        $MontantRappelFev = 0;
        $MontantRappelMars = 0;
        $MontantRappelAvr = 0;
        $MontantRappelMai = 0;
        $MontantRappelJuin = 0;
        $MontantRappelJuil = 0;
        $MontantRappelAout = 0;
        $MontantRappelSept = 0;
        $MontantRappelOct = 0;
        $MontantRappelNov = 0;
        $MontantRappelDec = 0;

        // --------------------------------------------------------------------------------

        // TOTAL NUMBER PAIE + RAPPEL
        $totalNbrJanv = $NbrJan + $NbrRappelJan;
        $totalNbrFev = $NbrFev + $NbrRappelFev;
        $totalNbrMars = $NbrMars + $NbrRappelMars;
        $totalNbrAvril = $NbrAvr + $NbrRappelAvr;
        $totalNbrMai = $NbrMai + $NbrRappelMai;
        $totalNbrJuin = $NbrJuin + $NbrRappelJuin;
        $totalNbrJuil = $NbrJuil + $NbrRappelJuil;
        $totalNbrAout = $NbrAout + $NbrRappelAout;
        $totalNbrSept = $NbrSept + $NbrRappelSept;
        $totalNbrOct = $NbrOct + $NbrRappelOct;
        $totalNbrNov = $NbrNov + $NbrRappelNov;
        $totalNbrDec = $NbrDec + $NbrRappelDec;


        //-------------------------------------------------------------------------------

        $totalMontantJanv = $PaieJanv + $MontantRappelJanv;
        $totalMontantFev  = $PaieFev + $MontantRappelFev;
        $totalMontantMars = $PaieMars + $MontantRappelMars;
        $totalMontantAvril = $PaieAvr + $MontantRappelAvr;
        $totalMontantMai = $PaieMai + $MontantRappelMai;
        $totalMontantJuin = $PaieJuin + $MontantRappelJuin;
        $totalMontantJuil = $PaieJuil + $MontantRappelJuil;
        $totalMontantAout = $PaieAout + $MontantRappelAout;
        $totalMontantSept = $PaieSept + $MontantRappelSept;
        $totalMontantOct = $PaieOct + $MontantRappelOct;
        $totalMontantNov = $PaieNov + $MontantRappelNov;
        $totalMontantDec = $PaieDec + $MontantRappelDec;

        // -------------------------------------------------------------------------------

        $soldRest1 = $budgetPaiement - $totalMontantJanv;
        $soldRest2 =  $soldRest1 - $totalMontantFev;
        $soldRest3 =  $soldRest2 - $totalMontantMars;
        $soldRest4 =  $soldRest3 - $totalMontantAvril;
        $soldRest5 =  $soldRest4 - $totalMontantMai;
        $soldRest6 =  $soldRest5 - $totalMontantJuin;
        $soldRest7 =  $soldRest6 - $totalMontantJuil;
        $soldRest8 =  $soldRest7 - $totalMontantAout;
        $soldRest9 =  $soldRest8 - $totalMontantSept;
        $soldRest10 =  $soldRest9 - $totalMontantOct;
        $soldRest11 =  $soldRest10 - $totalMontantNov;
        $soldRest12 =  $soldRest11 - $totalMontantDec;

        // -------------------------------------------------------------------------------

        $template->setValue('budget', number_format($budgetPaiement,2,',',' '));

        //---------------------------------------------------------------------------------
        
        $template->setValue('nm1', $NbrJan);
        $template->setValue('nm2', $NbrFev);
        $template->setValue('nm3', $NbrMars);
        $template->setValue('nm4', $NbrAvr);
        $template->setValue('nm5', $NbrMai);
        $template->setValue('nm6', $NbrJuin);
        $template->setValue('nm7', $NbrJuil);
        $template->setValue('nm8', $NbrAout);
        $template->setValue('nm9', $NbrSept);
        $template->setValue('nm10', $NbrOct);
        $template->setValue('nm11', $NbrNov);
        $template->setValue('nm12', $NbrDec);

        // ------------------------------------------------------------------

        $template->setValue('pm1', number_format($PaieJanv,2,',',' '));
        $template->setValue('pm2', number_format($PaieFev,2,',',' '));
        $template->setValue('pm3', number_format($PaieMars,2,',',' '));
        $template->setValue('pm4', number_format($PaieAvr,2,',',' '));
        $template->setValue('pm5', number_format($PaieMai,2,',',' '));
        $template->setValue('pm6', number_format($PaieJuin,2,',',' '));
        $template->setValue('pm7', number_format($PaieJuil,2,',',' '));
        $template->setValue('pm8', number_format($PaieAout,2,',',' '));
        $template->setValue('pm9', number_format($PaieSept,2,',',' '));
        $template->setValue('pm10', number_format($PaieOct,2,',',' '));
        $template->setValue('pm11', number_format($PaieNov,2,',',' '));
        $template->setValue('pm12', number_format($PaieDec,2,',',' '));
       
        // --------------------------------------------------------------------
        $template->setValue('rn1', $NbrRappelJan);
        $template->setValue('rn2', $NbrRappelFev);
        $template->setValue('rn3', $NbrRappelMars);
        $template->setValue('rn4', $NbrRappelAvr);
        $template->setValue('rn5', $NbrRappelMai);
        $template->setValue('rn6', $NbrRappelJuin);
        $template->setValue('rn7', $NbrRappelJuil);
        $template->setValue('rn8', $NbrRappelAout);
        $template->setValue('rn9', $NbrRappelSept);
        $template->setValue('rn10', $NbrRappelOct);
        $template->setValue('rn11', $NbrRappelNov);
        $template->setValue('rn12', $NbrRappelDec);

        // --------------------------------------------------------------------
        $template->setValue('rm1', number_format($MontantRappelJanv,'2',',',' '));
        $template->setValue('rm2', number_format($MontantRappelFev,'2',',',' '));
        $template->setValue('rm3', number_format($MontantRappelMars,'2',',',' '));
        $template->setValue('rm4', number_format($MontantRappelAvr,'2',',',' '));
        $template->setValue('rm5', number_format($MontantRappelMai,'2',',',' '));
        $template->setValue('rm6', number_format($MontantRappelJuin,'2',',',' '));
        $template->setValue('rm7', number_format($MontantRappelJuil,'2',',',' '));
        $template->setValue('rm8', number_format($MontantRappelAout,'2',',',' '));
        $template->setValue('rm9', number_format($MontantRappelSept,'2',',',' '));
        $template->setValue('rm10', number_format($MontantRappelOct,'2',',',' '));
        $template->setValue('rm11', number_format($MontantRappelNov,'2',',',' '));
        $template->setValue('rm12', number_format($MontantRappelDec,'2',',',' '));


        // --------------------------------------------------------------------
        // SET NOMBRE TOTAL HAND (MONDATE + RAPPEL)
        $template->setValue('nt1', $totalNbrJanv);
        $template->setValue('nt2', $totalNbrFev);
        $template->setValue('nt3', $totalNbrMars);
        $template->setValue('nt4', $totalNbrAvril);
        $template->setValue('nt5', $totalNbrMai);
        $template->setValue('nt6', $totalNbrJuin);
        $template->setValue('nt7', $totalNbrJuil);
        $template->setValue('nt8', $totalNbrAout);
        $template->setValue('nt9', $totalNbrSept);
        $template->setValue('nt10', $totalNbrOct);
        $template->setValue('nt11', $totalNbrNov);
        $template->setValue('nt12', $totalNbrDec);
        
       //------------------------------------------------------------------------
        // SET NOMBRE TOTAL HAND (MONDATE + RAPPEL)
        $template->setValue('nt1', $totalNbrJanv);
        $template->setValue('nt2', $totalNbrFev);
        $template->setValue('nt3', $totalNbrMars);
        $template->setValue('nt4', $totalNbrAvril);
        $template->setValue('nt5', $totalNbrMai);
        $template->setValue('nt6', $totalNbrJuin);
        $template->setValue('nt7', $totalNbrJuil);
        $template->setValue('nt8', $totalNbrAout);
        $template->setValue('nt9', $totalNbrSept);
        $template->setValue('nt10', $totalNbrOct);
        $template->setValue('nt11', $totalNbrNov);
        $template->setValue('nt12', $totalNbrDec);

        // --------------------------------------------------------------------
        // SET THE TOTAL MONY CONSOMPTION (PAIE+RAEEP)
        $template->setValue('mt1', number_format($totalMontantJanv,2,',',' '));
        $template->setValue('mt2', number_format($totalMontantFev,2,',',' '));
        $template->setValue('mt3', number_format($totalMontantMars,2,',',' '));
        $template->setValue('mt4', number_format($totalMontantAvril,2,',',' '));
        $template->setValue('mt5', number_format($totalMontantMai,2,',',' '));
        $template->setValue('mt6', number_format($totalMontantJuin,2,',',' '));
        $template->setValue('mt7', number_format($totalMontantJuil,2,',',' '));
        $template->setValue('mt8', number_format($totalMontantAout,2,',',' '));
        $template->setValue('mt9', number_format($totalMontantSept,2,',',' '));
        $template->setValue('mt10', number_format($totalMontantOct,2,',',' '));
        $template->setValue('mt11', number_format($totalMontantNov,2,',',' '));
        $template->setValue('mt12', number_format($totalMontantDec,2,',',' '));

        // ---------------------------------------------------------------------
        $template->setValue('sr1', number_format($soldRest1,2,',',' '));
        $template->setValue('sr2', number_format($soldRest2,2,',',' '));
        $template->setValue('sr3', number_format($soldRest3,2,',',' '));
        $template->setValue('sr4', number_format($soldRest4,2,',',' '));
        $template->setValue('sr5', number_format($soldRest5,2,',',' '));
        $template->setValue('sr6', number_format($soldRest6,2,',',' '));
        $template->setValue('sr7', number_format($soldRest7,2,',',' '));
        $template->setValue('sr8', number_format($soldRest8,2,',',' '));
        $template->setValue('sr9', number_format($soldRest9,2,',',' '));
        $template->setValue('sr10', number_format($soldRest10,2,',',' '));
        $template->setValue('sr11', number_format($soldRest11,2,',',' '));
        $template->setValue('sr12', number_format($soldRest12,2,',',' '));

        ob_end_clean();
        ob_start();
        $template->saveAs(storage_path('StatBudget.docx'));
        return response()->download(storage_path('StatBudget.docx'));

    }

    public function DownloadBudgetConsomptionCnas(){


        $template = new \PhpOffice\PhpWord\TemplateProcessor(dirname(dirname(__DIR__)) . '\Templates\BUDGETSTATCNAS.docx');


        $annee = date('Y');
        $budget = Budget::where('annee',$annee)->first();
        $budgetAssurance = $budget->budgetAssurance;

        $Pjanv = Paie::where('anneesPaiement',$annee)->where('moisPaiement','01')->first(); 
        $Pfevr = Paie::where('anneesPaiement',$annee)->where('moisPaiement','02')->first(); 
        $Pmars = Paie::where('anneesPaiement',$annee)->where('moisPaiement','03')->first(); 
        $Pavr  = Paie::where('anneesPaiement',$annee)->where('moisPaiement','04')->first(); 
        $Pmai  = Paie::where('anneesPaiement',$annee)->where('moisPaiement','05')->first(); 
        $Pjuin = Paie::where('anneesPaiement',$annee)->where('moisPaiement','06')->first(); 
        $Pjuil = Paie::where('anneesPaiement',$annee)->where('moisPaiement','07')->first(); 
        $Paout = Paie::where('anneesPaiement',$annee)->where('moisPaiement','08')->first(); 
        $Psept = Paie::where('anneesPaiement',$annee)->where('moisPaiement','09')->first(); 
        $Poct  = Paie::where('anneesPaiement',$annee)->where('moisPaiement','10')->first(); 
        $Pnov  = Paie::where('anneesPaiement',$annee)->where('moisPaiement','11')->first(); 
        $Pdec  = Paie::where('anneesPaiement',$annee)->where('moisPaiement','12')->first(); 

        $PaieJanv = $Pjanv != NULL ? $Pjanv->montantAssurance : 0;
        $PaieFev = $Pfevr != NULL ? $Pfevr->montantAssurance : 0;
        $PaieMars = $Pmars!= NULL ? $Pmars->montantAssurance : 0;
        $PaieAvr = $Pavr != NULL ? $Pavr->montantAssurance : 0;
        $PaieMai = $Pmai != NULL ? $Pmai->montantAssurance : 0;
        $PaieJuin = $Pjuin != NULL ? $Pjuin->montantAssurance : 0;
        $PaieJuil = $Pjuil != NULL ? $Pjuil->montantAssurance : 0;
        $PaieAout = $Paout != NULL ? $Paout->montantAssurance : 0;
        $PaieSept = $Psept != NULL ? $Psept->montantAssurance : 0;
        $PaieOct = $Poct != NULL ? $Poct->montantAssurance : 0;
        $PaieNov = $Pnov != NULL ? $Pnov->montantAssurance : 0;
        $PaieDec = $Pdec != NULL ? $Pdec->montantAssurance : 0;

        $NbrJan = $PaieJanv == 0 ? 0 : $PaieJanv/1000;
        $NbrFev = $PaieFev == 0 ? 0 : $PaieFev/1000;
        $NbrMars = $PaieMars == 0 ? 0 : $PaieMars/1000;
        $NbrAvr = $PaieAvr == 0 ? 0 : $PaieAvr/1000;
        $NbrMai = $PaieMai == 0 ? 0 : $PaieMai/1000;
        $NbrJuin = $PaieJuin == 0 ? 0 : $PaieJuin/1000;
        $NbrJuil = $PaieJuil == 0 ? 0 : $PaieJuil/1000;
        $NbrAout = $PaieAout == 0 ? 0 : $PaieAout/1000;
        $NbrSept = $PaieSept == 0 ? 0 : $PaieSept/1000;
        $NbrOct = $PaieOct == 0 ? 0 : $PaieOct/1000;
        $NbrNov = $PaieNov == 0 ? 0 : $PaieNov/1000;
        $NbrDec = $PaieDec == 0 ? 0 : $PaieDec/1000;



        // RAPPEL HAND NUMBERS
        $NbrRappelJan = 0;
        $NbrRappelFev = 0;
        $NbrRappelMars = 0;
        $NbrRappelAvr = 0;
        $NbrRappelMai = 0;
        $NbrRappelJuin = 0;
        $NbrRappelJuil = 0;
        $NbrRappelAout = 0;
        $NbrRappelSept = 0;
        $NbrRappelOct = 0;
        $NbrRappelNov = 0;
        $NbrRappelDec = 0;

        // MONTANT RAPPEL HAND
        $MontantRappelJanv = 0;
        $MontantRappelFev = 0;
        $MontantRappelMars = 0;
        $MontantRappelAvr = 0;
        $MontantRappelMai = 0;
        $MontantRappelJuin = 0;
        $MontantRappelJuil = 0;
        $MontantRappelAout = 0;
        $MontantRappelSept = 0;
        $MontantRappelOct = 0;
        $MontantRappelNov = 0;
        $MontantRappelDec = 0;

        // --------------------------------------------------------------------------------

        // TOTAL NUMBER PAIE + RAPPEL
        $totalNbrJanv = $NbrJan + $NbrRappelJan;
        $totalNbrFev = $NbrFev + $NbrRappelFev;
        $totalNbrMars = $NbrMars + $NbrRappelMars;
        $totalNbrAvril = $NbrAvr + $NbrRappelAvr;
        $totalNbrMai = $NbrMai + $NbrRappelMai;
        $totalNbrJuin = $NbrJuin + $NbrRappelJuin;
        $totalNbrJuil = $NbrJuil + $NbrRappelJuil;
        $totalNbrAout = $NbrAout + $NbrRappelAout;
        $totalNbrSept = $NbrSept + $NbrRappelSept;
        $totalNbrOct = $NbrOct + $NbrRappelOct;
        $totalNbrNov = $NbrNov + $NbrRappelNov;
        $totalNbrDec = $NbrDec + $NbrRappelDec;


        //-------------------------------------------------------------------------------

        $totalMontantJanv = $PaieJanv + $MontantRappelJanv;
        $totalMontantFev  = $PaieFev + $MontantRappelFev;
        $totalMontantMars = $PaieMars + $MontantRappelMars;
        $totalMontantAvril = $PaieAvr + $MontantRappelAvr;
        $totalMontantMai = $PaieMai + $MontantRappelMai;
        $totalMontantJuin = $PaieJuin + $MontantRappelJuin;
        $totalMontantJuil = $PaieJuil + $MontantRappelJuil;
        $totalMontantAout = $PaieAout + $MontantRappelAout;
        $totalMontantSept = $PaieSept + $MontantRappelSept;
        $totalMontantOct = $PaieOct + $MontantRappelOct;
        $totalMontantNov = $PaieNov + $MontantRappelNov;
        $totalMontantDec = $PaieDec + $MontantRappelDec;

        // -------------------------------------------------------------------------------

        $soldRest1 = $budgetAssurance - $totalMontantJanv;
        $soldRest2 =  $soldRest1 - $totalMontantFev;
        $soldRest3 =  $soldRest2 - $totalMontantMars;
        $soldRest4 =  $soldRest3 - $totalMontantAvril;
        $soldRest5 =  $soldRest4 - $totalMontantMai;
        $soldRest6 =  $soldRest5 - $totalMontantJuin;
        $soldRest7 =  $soldRest6 - $totalMontantJuil;
        $soldRest8 =  $soldRest7 - $totalMontantAout;
        $soldRest9 =  $soldRest8 - $totalMontantSept;
        $soldRest10 =  $soldRest9 - $totalMontantOct;
        $soldRest11 =  $soldRest10 - $totalMontantNov;
        $soldRest12 =  $soldRest11 - $totalMontantDec;

        // -------------------------------------------------------------------------------

        $template->setValue('budget', number_format($budgetAssurance,2,',',' '));

        //---------------------------------------------------------------------------------
        
        $template->setValue('nm1', $NbrJan);
        $template->setValue('nm2', $NbrFev);
        $template->setValue('nm3', $NbrMars);
        $template->setValue('nm4', $NbrAvr);
        $template->setValue('nm5', $NbrMai);
        $template->setValue('nm6', $NbrJuin);
        $template->setValue('nm7', $NbrJuil);
        $template->setValue('nm8', $NbrAout);
        $template->setValue('nm9', $NbrSept);
        $template->setValue('nm10', $NbrOct);
        $template->setValue('nm11', $NbrNov);
        $template->setValue('nm12', $NbrDec);

        // ------------------------------------------------------------------

        $template->setValue('pm1', number_format($PaieJanv,2,',',' '));
        $template->setValue('pm2', number_format($PaieFev,2,',',' '));
        $template->setValue('pm3', number_format($PaieMars,2,',',' '));
        $template->setValue('pm4', number_format($PaieAvr,2,',',' '));
        $template->setValue('pm5', number_format($PaieMai,2,',',' '));
        $template->setValue('pm6', number_format($PaieJuin,2,',',' '));
        $template->setValue('pm7', number_format($PaieJuil,2,',',' '));
        $template->setValue('pm8', number_format($PaieAout,2,',',' '));
        $template->setValue('pm9', number_format($PaieSept,2,',',' '));
        $template->setValue('pm10', number_format($PaieOct,2,',',' '));
        $template->setValue('pm11', number_format($PaieNov,2,',',' '));
        $template->setValue('pm12', number_format($PaieDec,2,',',' '));
       
        // --------------------------------------------------------------------
        $template->setValue('rn1', $NbrRappelJan);
        $template->setValue('rn2', $NbrRappelFev);
        $template->setValue('rn3', $NbrRappelMars);
        $template->setValue('rn4', $NbrRappelAvr);
        $template->setValue('rn5', $NbrRappelMai);
        $template->setValue('rn6', $NbrRappelJuin);
        $template->setValue('rn7', $NbrRappelJuil);
        $template->setValue('rn8', $NbrRappelAout);
        $template->setValue('rn9', $NbrRappelSept);
        $template->setValue('rn10', $NbrRappelOct);
        $template->setValue('rn11', $NbrRappelNov);
        $template->setValue('rn12', $NbrRappelDec);

        // --------------------------------------------------------------------
        $template->setValue('rm1', number_format($MontantRappelJanv,'2',',',' '));
        $template->setValue('rm2', number_format($MontantRappelFev,'2',',',' '));
        $template->setValue('rm3', number_format($MontantRappelMars,'2',',',' '));
        $template->setValue('rm4', number_format($MontantRappelAvr,'2',',',' '));
        $template->setValue('rm5', number_format($MontantRappelMai,'2',',',' '));
        $template->setValue('rm6', number_format($MontantRappelJuin,'2',',',' '));
        $template->setValue('rm7', number_format($MontantRappelJuil,'2',',',' '));
        $template->setValue('rm8', number_format($MontantRappelAout,'2',',',' '));
        $template->setValue('rm9', number_format($MontantRappelSept,'2',',',' '));
        $template->setValue('rm10', number_format($MontantRappelOct,'2',',',' '));
        $template->setValue('rm11', number_format($MontantRappelNov,'2',',',' '));
        $template->setValue('rm12', number_format($MontantRappelDec,'2',',',' '));


        // --------------------------------------------------------------------
        // SET NOMBRE TOTAL HAND (MONDATE + RAPPEL)
        $template->setValue('nt1', $totalNbrJanv);
        $template->setValue('nt2', $totalNbrFev);
        $template->setValue('nt3', $totalNbrMars);
        $template->setValue('nt4', $totalNbrAvril);
        $template->setValue('nt5', $totalNbrMai);
        $template->setValue('nt6', $totalNbrJuin);
        $template->setValue('nt7', $totalNbrJuil);
        $template->setValue('nt8', $totalNbrAout);
        $template->setValue('nt9', $totalNbrSept);
        $template->setValue('nt10', $totalNbrOct);
        $template->setValue('nt11', $totalNbrNov);
        $template->setValue('nt12', $totalNbrDec);
        
       //------------------------------------------------------------------------
        // SET NOMBRE TOTAL HAND (MONDATE + RAPPEL)
        $template->setValue('nt1', $totalNbrJanv);
        $template->setValue('nt2', $totalNbrFev);
        $template->setValue('nt3', $totalNbrMars);
        $template->setValue('nt4', $totalNbrAvril);
        $template->setValue('nt5', $totalNbrMai);
        $template->setValue('nt6', $totalNbrJuin);
        $template->setValue('nt7', $totalNbrJuil);
        $template->setValue('nt8', $totalNbrAout);
        $template->setValue('nt9', $totalNbrSept);
        $template->setValue('nt10', $totalNbrOct);
        $template->setValue('nt11', $totalNbrNov);
        $template->setValue('nt12', $totalNbrDec);

        // --------------------------------------------------------------------
        // SET THE TOTAL MONY CONSOMPTION (PAIE+RAEEP)
        $template->setValue('mt1', number_format($totalMontantJanv,2,',',' '));
        $template->setValue('mt2', number_format($totalMontantFev,2,',',' '));
        $template->setValue('mt3', number_format($totalMontantMars,2,',',' '));
        $template->setValue('mt4', number_format($totalMontantAvril,2,',',' '));
        $template->setValue('mt5', number_format($totalMontantMai,2,',',' '));
        $template->setValue('mt6', number_format($totalMontantJuin,2,',',' '));
        $template->setValue('mt7', number_format($totalMontantJuil,2,',',' '));
        $template->setValue('mt8', number_format($totalMontantAout,2,',',' '));
        $template->setValue('mt9', number_format($totalMontantSept,2,',',' '));
        $template->setValue('mt10', number_format($totalMontantOct,2,',',' '));
        $template->setValue('mt11', number_format($totalMontantNov,2,',',' '));
        $template->setValue('mt12', number_format($totalMontantDec,2,',',' '));

        // ---------------------------------------------------------------------
        $template->setValue('sr1', number_format($soldRest1,2,',',' '));
        $template->setValue('sr2', number_format($soldRest2,2,',',' '));
        $template->setValue('sr3', number_format($soldRest3,2,',',' '));
        $template->setValue('sr4', number_format($soldRest4,2,',',' '));
        $template->setValue('sr5', number_format($soldRest5,2,',',' '));
        $template->setValue('sr6', number_format($soldRest6,2,',',' '));
        $template->setValue('sr7', number_format($soldRest7,2,',',' '));
        $template->setValue('sr8', number_format($soldRest8,2,',',' '));
        $template->setValue('sr9', number_format($soldRest9,2,',',' '));
        $template->setValue('sr10', number_format($soldRest10,2,',',' '));
        $template->setValue('sr11', number_format($soldRest11,2,',',' '));
        $template->setValue('sr12', number_format($soldRest12,2,',',' '));

        ob_end_clean();
        ob_start();
        $template->saveAs(storage_path('StatBudget.docx'));
        return response()->download(storage_path('StatBudget.docx'));

    }
}
