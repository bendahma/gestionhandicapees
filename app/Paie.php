<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Hand;
<<<<<<< HEAD
=======
use App\CfTresor;
>>>>>>> ebcea4b0270816f32e0a24123fc7538b230a81b1

class Paie extends Model
{
    protected $fillable=[
        'moisPaiement',
        'anneesPaiement',
        'montantPaiement',
        'montantAssurance',
<<<<<<< HEAD
        'NumeroEngagementPaie',
        'NumeroEngagementAssurance',
        'NumeroMondatePaie',
        'NumeroMondateAssurance',
        'dateEngagementPaie',
        'dateMondatePaie'
=======
>>>>>>> ebcea4b0270816f32e0a24123fc7538b230a81b1
    ];

    public function hands(){
		    return $this->belongsToMany(Hand::class);
    }

    public function MoisEnLettre($mois){
        $moisLettre = '';
        switch($mois){
            case 1:
                $moisLettre = 'Janvier';
                break;
            case 2:
                $moisLettre = 'Fevrier';
                break;
            case 3:
                $moisLettre = 'Mars';
                break;
            case 4:
                $moisLettre = 'Avril';
                break;
            case 5:
                $moisLettre = 'Mai';
                break;
            case 6:
                $moisLettre = 'Juin';
                break;
            case 7:
                $moisLettre = 'Juillet';
                break;
            case 8:
                $moisLettre = 'Aout';
                break;
            case 9:
                $moisLettre = 'Septembre';
                break;
            case 10:
                $moisLettre = 'Octobre';
                break;
            case 11:
                $moisLettre = 'Novembre';
                break;
            case 12:
                $moisLettre = 'Décembre';
                break;
        }

        return $moisLettre;
    }

<<<<<<< HEAD
=======
    public function cftresors(){
        return $this->hasMany(CfTresor::class);
    }
>>>>>>> ebcea4b0270816f32e0a24123fc7538b230a81b1
}
