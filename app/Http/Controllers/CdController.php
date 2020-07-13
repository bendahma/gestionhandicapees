<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Paie;
use App\Hand;
use App\Commune;
use DB;
use Response;
class CdController extends Controller
{
    public function index(){
        return view('admin.CD.index');
    }

    public function CdClassique(Request $request){
        $hands = DB::table('hands')
                        ->join('paie_information','paie_information.hand_id','hands.id')
                        ->join('hand_paie','hand_paie.hand_id','hands.id')
                        ->join('paies','paies.id','hand_paie.paie_id')
                        ->select('hands.nameFr','paie_information.CCP')
                        ->where('paies.moisPaiement','=',$request->moisPaiement)
                        ->where('paies.anneesPaiement','=',$request->anneePaiement)
                        ->get();
        
        $paie = Paie::where('moisPaiement',$request->moisPaiement)->where('anneesPaiement',$request->anneePaiement)->first();

        $montant = $paie->montantPaiement ;
        $nbrHand = $montant / config('paie.MontantPaie');
        switch (strlen($montant)){
            case 1:
                $montant = '0000000000' . $montant . '00';
                break;
            case 2:
                $montant = '000000000' . $montant . '00';
                break;
            case 3:
                $montant = '00000000' . $montant . '00';
                break;
            case 4:
                $montant = '0000000' . $montant . '00';
                break;
            case 5:
                $montant = '000000' . $montant . '00';
                break;
            case 6:
                $montant = '00000' . $montant . '00';
                break;
            case 7:
                $montant = '0000' . $montant . '00';
                break;
            case 8:
                $montant = '000' . $montant . '00';
                break;
            case 9:
                $montant = '00' . $montant . '00';
                break;
            case 10:
                $montant = '0' . $montant . '00';
                break;
            case 11:
                $montant = '' . $montant . '00';
                break;
        }
        switch (strlen($nbrHand)){
            case 1:
                $nbrHand = '000000'.$nbrHand;
                break;
            case 2:
                $nbrHand = '00000'.$nbrHand;
                break;
            case 3:
                $nbrHand = '0000'.$nbrHand;
                break;
            case 4:
                $nbrHand = '000'.$nbrHand;
                break;
            case 5:
                $nbrHand = '00'.$nbrHand;
                break;
            case 6:
                $nbrHand = '0'.$nbrHand;
                break;
            case 7:
                $nbrHand = $nbrHand;
                break;
            
        }

        $content = "*00000000000030006473" . $montant  . $nbrHand.$request->moisPaiement.$request->anneePaiement;
        $separtor = '';
        
        while((strlen($content) + strlen($separtor)) < 61){
            $separtor .= ' '; 
        }
        $content .= $separtor . '0';
        foreach($hands as $hand){
            $name = (string)$hand->nameFr;
            while(strlen($name) < 27){
                $name .= ' ';
            }
            $montant = 1000000;
            $ccp =(string)str_replace('CLE','',$hand->CCP);
            $compte = '';
            switch(strlen($ccp)){
                case 1:
                    $compte = '0000000000000000000'.$ccp;
                    break;
                case 2:
                    $compte = '000000000000000000'.$ccp;
                    break;
                case 3:
                    $compte = '00000000000000000'.$ccp;
                    break;
                case 4:
                    $compte = '0000000000000000'.$ccp;
                    break;
                case 5:
                    $compte = '000000000000000'.$ccp;
                    break;
                case 6:
                    $compte = '00000000000000'.$ccp;
                    break;
                case 7:
                    $compte = '0000000000000'.$ccp;
                    break;
                case 8:
                    $compte = '000000000000'.$ccp;
                    break;
                case 9:
                    $compte = '00000000000'.$ccp;
                    break;
                case 10:
                    $compte = '0000000000'.$ccp;
                    break;
                case 11:
                    $compte = '000000000'.$ccp;
                    break;
                case 12:
                    $compte = '00000000'.$ccp;
                    break;
                case 13:
                    $compte = '0000000'.$ccp;
                    break;
                case 14:
                    $compte = '000000'.$ccp;
                    break;
                case 15:
                    $compte = '00000'.$ccp;
                    break;
                case 16:
                    $compte = '0000'.$ccp;
                    break;
                case 17:
                    $compte = '000'.$ccp;
                    break;
                case 18:
                    $compte = '00'.$ccp;
                    break;
                case 19:
                    $compte = '0'.$ccp;
                    break;
                case 20:
                    $compte = $ccp;
                    break;
            }
            $content .= "\r\n";
            $content .= '*'.$compte.'000000'.$montant.$name.'1';
        }
        
        $fileName = 'Paie '. date('m-Y') .'.txt';

        $headers = [
        'Content-type' => 'text/plain', 
        'Content-Disposition' => sprintf('attachment; filename="%s"', $fileName),
        ];
        return Response::make($content, 200, $headers);
    }

    public function CdMondatement(Request $request){

        $hands = DB::table('hands')
                        ->join('paie_information','paie_information.hand_id','hands.id')
                        ->join('hand_paie','hand_paie.hand_id','hands.id')
                        ->join('paies','paies.id','hand_paie.paie_id')
                        ->select('hands.nameFr','paie_information.RIP')
                        ->where('paies.moisPaiement','=',$request->moisPaiement)
                        ->where('paies.anneesPaiement','=',$request->anneePaiement)
                        ->get();
        
        $content = "";
        $paie = Paie::where('moisPaiement',$request->moisPaiement)->where('anneesPaiement',$request->anneePaiement)->first();
        $montant = $paie->montantPaiement ;
        $nbrHand = $montant / config('paie.MontantPaie');

        switch (strlen($montant)){
            case 1:
                $montant = '0000000000' . $montant . '00';
                break;
            case 2:
                $montant = '000000000' . $montant . '00';
                break;
            case 3:
                $montant = '00000000' . $montant . '00';
                break;
            case 4:
                $montant = '0000000' . $montant . '00';
                break;
            case 5:
                $montant = '000000' . $montant . '00';
                break;
            case 6:
                $montant = '00000' . $montant . '00';
                break;
            case 7:
                $montant = '0000' . $montant . '00';
                break;
            case 8:
                $montant = '000' . $montant . '00';
                break;
            case 9:
                $montant = '00' . $montant . '00';
                break;
            case 10:
                $montant = '0' . $montant . '00';
                break;
            case 11:
                $montant = '' . $montant . '00';
                break;
        }
        switch (strlen($nbrHand)){
            case 1:
                $nbrHand = '000000'.$nbrHand;
                break;
            case 2:
                $nbrHand = '00000'.$nbrHand;
                break;
            case 3:
                $nbrHand = '0000'.$nbrHand;
                break;
            case 4:
                $nbrHand = '000'.$nbrHand;
                break;
            case 5:
                $nbrHand = '00'.$nbrHand;
                break;
            case 6:
                $nbrHand = '0'.$nbrHand;
                break;
            case 7:
                $nbrHand = $nbrHand;
                break;
            
        }

        $content = "*00846001514444600177" . $montant  . $nbrHand.$request->moisPaiement.$request->anneePaiement.'137246';
        $nMondate = $request->NumeroMondatePaie;
        $separtor = '';
        
        while((strlen($content) + strlen($nMondate) + strlen($separtor)) < 61){
            $separtor .= ' '; 
        }
        $content .= $separtor.$nMondate.'0';

        foreach($hands as $hand){
            $name = (string)$hand->nameFr;
            while(strlen($name) < 27){
                $name .= ' ';
            }
            $montant = 1000000;
            $rip = (string)$hand->RIP;
            $content .= "\r\n";
            $content .= '*'.$rip.'000000'.$montant.$name.'1';
        }
        $fileName =  '137246'.'_'.$nMondate.'_'.date('Y').".txt";

        $headers = [
        'Content-type' => 'text/plain', 
        'Content-Disposition' => sprintf('attachment; filename="%s"', $fileName),
        ];
        return Response::make($content, 200, $headers);
    }

    public function CdBeneficier(Request $request){
        $hands = DB::table('hands')
                        ->join('paie_information','paie_information.hand_id','hands.id')
                        ->join('hand_paie','hand_paie.hand_id','hands.id')
                        ->join('paies','paies.id','hand_paie.paie_id')
                        ->join('securite_sociales','securite_sociales.hand_id','hands.id')
                        ->select('hands.nameFr','hands.address','hands.codeCommune','paie_information.RIP','securite_sociales.NSS','paie_information.Beneficier')
                        ->where('paies.moisPaiement','=',$request->moisPaiement)
                        ->where('paies.anneesPaiement','=',$request->anneePaiement)
                        ->where('paie_information.Beneficier','=',0)
                        ->get();


        $countBenef = $hands->count();

        $content =  '137246'.'|'.$countBenef;
        foreach($hands as $hand){
            $commune = Commune::where('codeCommune',$hand->codeCommune)->first();
            $name = $hand->nameFr;
            $rip = $hand->RIP;
            $nss = $hand->NSS;
            $address = $hand->address . ' ' .$commune->nomCommuneFr;
            $content .= "\r\n";
            $content .= $rip.'|'.$nss.'|'.$name.'|'.$address;
           
        }
        
        $handsBenif = DB::table('hands')
                        ->join('paie_information','paie_information.hand_id','hands.id')
                        ->join('hand_paie','hand_paie.hand_id','hands.id')
                        ->join('paies','paies.id','hand_paie.paie_id')
                        ->select('paie_information.Beneficier')
                        ->where('paies.moisPaiement','=',$request->moisPaiement)
                        ->where('paies.anneesPaiement','=',$request->anneePaiement)
                        ->where('paie_information.Beneficier','=',0)
                        ->update(array('Beneficier' => 1));

        
        $fileName = "CD Beneficier". date('m-Y') .".txt";

        $headers = [
        'Content-type' => 'text/plain', 
        'Content-Disposition' => sprintf('attachment; filename="%s"', $fileName),
        ];
        return Response::make($content, 200, $headers);
    }

}
