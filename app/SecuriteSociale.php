<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Hand;

class SecuriteSociale extends Model
{
    protected $fillable = ['NSS','DateDebutAssurance'];
    public function hand(){
        return $this->belongsTo(Hand::class);
    }

}
