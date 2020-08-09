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
use Debugbar;
use Auth;
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
        $hands = cache()->remember('HANDS_LISTS_ALL', 60*60*24 , function(){
            return Hand::with(['paieinformation:hand_id,CCP','status:hand_id,status'])->withTrashed()->get(['id','nameFr','dob']);
        });

        $user = Auth::user();

        Debugbar::info(Auth::user());

        return view('dashboard')
                    ->with('hands',$hands)
                    ->with('user',$user);
       
    }

    public function suspendu($id){
        $hand = Hand::with('status')->withTrashed()->where('id',$id)->first();
        $commune = Commune::where('codeCommune',$hand->codeCommune)->first();
        return view('admin.handsInfo.suspendu')
                                ->with("hand",$hand)
                                ->with("commune",$commune);

    }
}
