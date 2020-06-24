<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Hand;

class Rappel extends Model
{
    protected $fillable=['DateRappel','DatePaiementRappel','DateDebut','DateFin','montant','nombreMois','RappelFait'];

    public function hands(){
        return $this->belongsToMany(Hand::class);
    }
}
