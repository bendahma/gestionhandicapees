<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Hand;
use App\Commune;

use Auth;

class ConvocationController extends Controller
{


    public function index(){
        $hands = Hand::withTrashed()->orderBy('codeCommune','asc')->get(['id','nameFr','dob']);
        return view('admin.convocation.index',compact('hands'));
    }

    /*
        Send Convocation for suspension paie Asking to come
    */

    public function Suspension($id){

        $hand = Hand::where('id',$id)->withTrashed()->first();

        $commune = Commune::where('codeCommune',$hand->codeCommune)->first();
        
        if(!$hand->CheckBasicInfoExsistsForDecision($hand)){
            session()->flash('error','Erreur, Il Faut Remplir Les Informations Du Handicapée Avant Télécharger La Convocation');
            return redirect(route('hands.edit', $hand));
        }

        $template = new \PhpOffice\PhpWord\TemplateProcessor(dirname(dirname(__DIR__)) . '\Templates\ConvocationSuspendu.docx');
        $output = "Convocation.docx";
        $template->setValue('nomAr', $hand->nomAr);
        $template->setValue('prenAr', $hand->prenomAr);
        $template->setValue('addAr', $hand->addressAr);
        $template->setValue('communeAr', $commune->nomCommuneAr);
        $template->setValue('username', Auth::user()->nameAr);
        ob_end_clean();
        ob_start();
        $template->saveAs(storage_path($output));
        return response()->download(storage_path($output));
        

        
    }

    public function SuspensionAny(Request $request,$id){

        $hand = Hand::where('id',$id)->withTrashed()->first();

        $commune = Commune::where('codeCommune',$hand->codeCommune)->first();
        
        if(!$hand->CheckBasicInfoExsistsForDecision($hand)){
            session()->flash('error','Erreur, Il Faut Remplir Les Informations Du Handicapée Avant Télécharger La Convocation');
            return redirect(route('hands.edit', $hand));
        }

        $template =  new \PhpOffice\PhpWord\TemplateProcessor(dirname(dirname(__DIR__)) . '\Templates\Convocation.docx');
        $output = "Convocation.docx";
        $template->setValue('nomAr', $hand->nomAr);
        $template->setValue('prenAr', $hand->prenomAr);
        $template->setValue('addAr', $hand->addressAr);
        $template->setValue('communeAr', $commune->nomCommuneAr);
        $template->setValue('papier', $request->paper);
        $motif = $request->motif != NULL ? $request->motif : 'من أجل أمر يهمكم' ;
        $template->setValue('motif', $motif);

        $template->setValue('username', Auth::user()->nameAr);
        ob_end_clean();
        ob_start();
        $template->saveAs(storage_path($output));
        return response()->download(storage_path($output));
        

        
    }
}
