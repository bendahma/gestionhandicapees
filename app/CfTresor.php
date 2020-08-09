<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Paie;
use App\Rappel;

class CfTresor extends Model
{
    protected $fillable = [
        'numEngagementPaie',
        'numEngagementAssurance',
        'dateEngagement',
        'numMondatePaiement',
        'numMondateAssurance',
        'dateMondate',
        'operation',
    ];

    public function paie(){
        return $this->belongsTo(Paie::class);
    }

    public function rappel(){
        return $this->belongsTo(Rappel::class);
    }
}
