<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Hand;

class Paie extends Model
{
    protected $fillable=[
        'moisPaiement',
        'anneesPaiement',
        'montantPaiement',
        'montantAssurance',
        'NumeroEngagementPaie',
        'NumeroEngagementAssurance',
        'NumeroMondatePaie',
        'NumeroMondateAssurance'
    ];

    public function hands(){
		    return $this->belongsToMany(Hand::class);
    }

}
