<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    protected $fillable = ['annee','budgetMondatement','budgetAssurance','budgetMondatementConsomme','budgetAssuranceConsomme'];
    
}
