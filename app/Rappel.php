<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Hand;

class Rappel extends Model
{
    protected $fillable=['AnneeRappel','DatePaiementRappel','DateDebut','DateFin','montantRappel','montantAssurance','nombreMois','nombrePersonne','RappelFait'];

    public function hands(){
        return $this->belongsToMany(Hand::class);
    }
}
