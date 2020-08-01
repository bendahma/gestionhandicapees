<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use app\Hand;

class CarteNational extends Model
{

    protected $fillable = [
        'NumeroNational',
        'dateCarteIdentite',
        'communeCarteNationalFr',
        'communeCarteNationalAr',
        'wilayaCarteNational',
    ];

    public function hand()
    {
        return $this->belongsTo(Hand::class);
    }

    public function CheckCarteNationalInfoExists($id){
        $national = CarteNational::where('hand_id',$id)->first();
        if($national->NumeroNational == NULL || $national->dateCarteIdentite == NULL || $national->communeCarteNationalFr == NULL || $national->communeCarteNationalAr == NULL || $national->wilayaCarteNational ){
            return false;
        }
        return true;
    }
}
