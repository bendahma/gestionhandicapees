<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Hand;

class Commune extends Model
{
    protected $fillable = ['codeCommune','nomCommuneFr','nomCommuneAr'] ;

    public function hand(){
        return $this->belongsTo(Hand::class);
    }
}
