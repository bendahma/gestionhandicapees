<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Hand; 


class HandSuspentionHistory extends Model
{
    protected $fillable=['status','motif','dateSupprission','dateRemi','hand_id'];

    public function hand(){
        return $this->bolongsTo(Hand::class);
    }
}