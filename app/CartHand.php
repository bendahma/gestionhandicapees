<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use app\Hand;

class CartHand extends Model
{
    protected $fillable = ['numeroCart', 'natureHandFr','natureHandAr', 'pourcentage','dateCarte','dateCommissionPension'];

    public function hand()
    {
        return $this->belongsTo(Hand::class);
    }

    public function CheckCardInfoExists($id){
        $card = CartHand::where('hand_id',$id)->first();
        if($card->numeroCart == NULL || $card->natureHandFr == NULL || $card->natureHandAr == NULL || $card->dateCarte == NULL ){
            return false;
        }
        return true;
    }
}
