<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Hand;

class PaieInformation extends Model
{
    protected $fillable = ['CCP','RIP','datePremierPension','dateDecisionPension','Beneficier','dateDebutPension'];
    
    public function hand(){

        return $this->blongsTo(Hand::class);
    }

}
