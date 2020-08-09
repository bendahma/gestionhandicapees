<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Hand;
use App\CfTresor;

class Rappel extends Model
{
    protected $fillable=[
        'AnneeRappel',
        'DatePaiementRappel',
        'DateDebut',
        'DateFin',
        'montantRappel',
        'montantAssurance',
        'nombreMois',
        'nombrePersonne',
        'RappelFait',
        'Rapple_Obs',
    ];

    public function hands(){
        return $this->belongsToMany(Hand::class);
    }
    public function cftresors(){
        return $this->hasMany(CfTresor::class);
    }
}
