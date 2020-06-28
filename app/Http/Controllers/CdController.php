<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Paie;
use App\Hand;
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
        
        $content = "";
        foreach($hands as $hand){
            $name = (string)$hand->nameFr;
            while(strlen($name) <= 27){
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
            $content .= '*'.$compte.'000000'.$montant.$name.'1';
            $content .= "\r\n";
        }
        
        $fileName = "CD Classique.txt";

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
        foreach($hands as $hand){
            $name = (string)$hand->nameFr;
            while(strlen($name) < 27){
                $name .= ' ';
            }
            $montant = 1000000;
            $rip = (string)$hand->RIP;
            $content .= '*'.$rip.'000000'.$montant.$name.'1';
            $content .= "\r\n";
        }
        $fileName = "CD Mondatement.txt";

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
                        ->select('hands.nameFr','hands.address','hands.commune','paie_information.RIP','securite_sociales.NSS')
                        ->where('paies.moisPaiement','=',$request->moisPaiement)
                        ->where('paies.anneesPaiement','=',$request->anneePaiement)
                        ->where('paie_information.Beneficier','=',0)
                        ->get();
        $countBenef = $hands->count();
        $content = $countBenef;
        $content .= "\r\n";
        foreach($hands as $hand){
            $name = (string)$hand->nameFr;
            $rip = (string)$hand->RIP;
            $nss = (string)$hand->NSS;
            $address = (string)$hand->address . (string)$hand->commune;
            $content .= $rip.'|'.$nss.'|'.$name.'|'.$address;
            $content .= "\r\n";
        }
        $fileName = "CD Beneficier.txt";

        $headers = [
        'Content-type' => 'text/plain', 
        'Content-Disposition' => sprintf('attachment; filename="%s"', $fileName),
        ];
        return Response::make($content, 200, $headers);
    }


    

}
