<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Hand;
<<<<<<< HEAD
=======
use App\CfTresor;
>>>>>>> ebcea4b0270816f32e0a24123fc7538b230a81b1

class Rappel extends Model
{
    protected $fillable=[
<<<<<<< HEAD
        'AnneeRappel','DatePaiementRappel','DateDebut','DateFin','montantRappel','montantAssurance','nombreMois','nombrePersonne','RappelFait','Rapple_Obs'
=======
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
>>>>>>> ebcea4b0270816f32e0a24123fc7538b230a81b1
    ];

    public function hands(){
        return $this->belongsToMany(Hand::class);
    }
<<<<<<< HEAD
=======
    public function cftresors(){
        return $this->hasMany(CfTresor::class);
    }
>>>>>>> ebcea4b0270816f32e0a24123fc7538b230a81b1
}
