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
<<<<<<< HEAD
         $hands = cache()->remember('HANDS_LISTS_ALL', 60*60*24 , function(){
            return Hand::with(['paieinformation:hand_id,CCP','status:hand_id,status'])->withTrashed()->get(['id','nameFr','dob']);
         });

        return view('dashboard')->with('hands',$hands);
                   
=======
        $hands = cache()->remember('HANDS_LISTS_ALL', 60*60*24 , function(){
            return Hand::with(['paieinformation:hand_id,CCP','status:hand_id,status'])->withTrashed()->get(['id','nameFr','dob']);
        });
        
        return view('dashboard')->with('hands',$hands);
       
>>>>>>> ebcea4b0270816f32e0a24123fc7538b230a81b1
    }

    public function suspendu($id){
        $hand = Hand::with('status')->withTrashed()->where('id',$id)->first();
        $commune = Commune::where('codeCommune',$hand->codeCommune)->first();
        return view('admin.handsInfo.suspendu')
<<<<<<< HEAD
                ->with("hand",$hand)
                ->with("commune",$commune);
=======
                                ->with("hand",$hand)
                                ->with("commune",$commune);
>>>>>>> ebcea4b0270816f32e0a24123fc7538b230a81b1

    }
}
