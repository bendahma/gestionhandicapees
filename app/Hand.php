<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


use App\CartHand;
use App\HandPaieStatus;
use App\Paie;
use App\CarteNational;
use App\PaieInformation;
use App\SecuriteSociale;
use App\Rappel;
use App\HandSuspentionHistory;
use App\RenouvellementDossier;
use App\Commune;

class Hand extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'numeroactenaissance', 'nameFr', 'nomAr',
        'prenomAr','sex','dob',
        'lieuxNaissanceFr','lieuxNaissanceAr',
        'address','addressAr','codeCommune','prenomMereFr','prenomPereAr',
        'prenomPereFr','nomMereFr',
        'nomMereAr','prenomMereAr','situationFamilialeFr',
        'nbrenfant','obs'
    ];

    // Relationships

    public function cartehand()
    {
        return $this->hasOne(CartHand::class);
    }
    
    public function cartenational()
    {
        return $this->hasOne(CarteNational::class);
    }

    public function paieinformation(){
        return $this->hasOne(PaieInformation::class);
    }
    
    public function securitesociale(){
        return $this->hasOne(SecuriteSociale::class);
    }


    public function status(){
        return $this->hasOne(HandPaieStatus::class);
    }

    public function paies(){
		return $this->belongsToMany(Paie::class);
    }

    public function rappels(){
		return $this->belongsToMany(Rappel::class);
    }

    public function handSuspentionHistories(){
        return $this->hasMany(HandSuspentionHistory::class);
    }

    public function renouvellementdossier(){
        return $this->hasOne(RenouvellementDossier::class);
    }

    public function commune(){
        return $this->hasOne(Commune::class);
    }

    public function CheckBasicInfoExsists(Hand $hand){
        if($hand->numeroactenaissance == NULL &&  $hand->nomAr == NULL &&  $hand->prenomAr == NULL && $hand->lieuxNaissanceAr == NULL &&  
            $hand->addressAr == NULL &&  $hand->prenomPereFr == NULL &&  $hand->nomMereFr == NULL 
            &&  $hand->prenomMereFr == NULL &&  $hand->prenomPereAr == NULL &&  $hand->nomMereAr == NULL &&  $hand->prenomMereAr == NULL && 
             $hand->situationFamilialeFr == NULL &&  $hand->situationFamilialeAr == NULL  &&  $hand->nbrenfant == NULL){
                return false;
            }
        return true;
    }

    public function CheckBasicInfoExsistsForDecision(Hand $hand){
        if($hand->nomAr == NULL &&  $hand->prenomAr == NULL && $hand->lieuxNaissanceAr == NULL && $hand->addressAr == NULL ){
                return false;
        }
        return true;
    }
 
    public function HandMondate(){
        $hands = cache()->remember('HAND_MONDATE_MODEL',60*60*24,function(){
            return Hand::whereHas('status',function($s){
                    $s->where('status', 'en cours');
            })->get();
        });
        return $hands;
    }

    public function HandSuspenduArrete(){
        $hands = Hand::onlyTrashed()->whereHas('status',function($s){
            $s->where('status', 'suspendu')->orWhere('status', 'arrete');
        })->with('paieinformation')->get();

        return $hands;
    }
    
    
    public function HandEnAttente(){
        $hands = Hand::onlyTrashed()->whereHas('status',function($s){
            $s->where('status', 'En attente');
        })->get();
        return $hands;
    }


    public static function search($search,$dateNaiss,$commune){

      if(empty($search) && empty($dateNaiss) && empty($commune)) { return static::query(); }
      else if( empty($dateNaiss) && empty($commune) ) {  return static::query()->where('nameFr','like','%'.$search.'%')
                                                                       ->orWhereHas('paieinformation',function($q) use($search) { $q->where('CCP','like','%'.$search.'%'); })
                                                                       ->orWhereHas('securitesociale',function($q) use($search) { $q->where('NSS','like','%'.$search.'%'); });}
      else if(empty($search) && empty($commune)) { return static::query()->where('dob',$dateNaiss); }
      else if(empty($search) && empty($dateNaiss)) { return static::query()->where('codeCommune',$commune) ; }
      else if(empty($search)) { return static::query()->where('dob',$dateNaiss)->where('codeCommune',$commune);  }
      else if(empty($dateNaiss) ) { return static::query()->where('codeCommune',$commune)
                                                   ->where('nameFr','like','%'.$search.'%')
                                                   ->orWhereHas('paieinformation',function($q) use($search){ $q->where('CCP','like','%'.$search.'%'); }) 
                                                   ->orWhereHas('securitesociale',function($q) use($search) { $q->where('NSS','like','%'.$search.'%'); });}
      else if(empty($commune)) { return static::query()->where('dob',$dateNaiss)
                                                ->where('nameFr','like','%'.$search.'%')
                                                ->orWhereHas('paieinformation',function($q) use($search){ $q->where('CCP','like','%'.$search.'%'); }) 
                                                ->orWhereHas('securitesociale',function($q) use($search) { $q->where('NSS','like','%'.$search.'%'); });}

      else { static::query()->where('dob',$dateNaiss)
                            ->where('codeCommune',$commune)
                            ->where('nameFr','like','%'.$search.'%')
                            ->orWhereHas('paieinformation',function($q) use($search){ $q->where('CCP','like','%'.$search.'%'); }) 
                            ->orWhereHas('securitesociale',function($q) use($search) { $q->where('NSS','like','%'.$search.'%'); });}

      
        
      //   return ((empty($search) && empty($dateNaiss) && empty($commune)) ? static::query()
      //           : (empty($dateNaiss) && empty($commune) ? static::query()->where('nameFr','like','%'.$search.'%')->orWhereHas('paieinformation',function($q) use($search){ $q->where('CCP','like','%'.$search.'%'); })                                                                     
      //           : (empty($search) && empty($commune) ? static::query()->where('dob',$dateNaiss) 
      //           : ( empty($search) && empty($dateNaiss) ?  static::query()->where('codeCommune',$commune)  
      //           : (empty($search) ? static::query()->where('dob',$dateNaiss)->where('codeCommune',$commune) 
      //           : (empty($dateNaiss) ? static::query()->where('codeCommune',$commune)->where('nameFr','like','%'.$search.'%')->orWhereHas('paieinformation',function($q) use($search){ $q->where('CCP','like','%'.$search.'%'); }) 
      //           : (empty($commune) ? static::query()->where('dob',$dateNaiss)->where('nameFr','like','%'.$search.'%')->orWhereHas('paieinformation',function($q) use($search){ $q->where('CCP','like','%'.$search.'%'); }) 
      //           : static::query()->where('dob',$dateNaiss)->where('codeCommune',$commune)->where('nameFr','like','%'.$search.'%')->orWhereHas('paieinformation',function($q) use($search){ $q->where('CCP','like','%'.$search.'%'); })   ))))))
      //           );
                
                                     
    }
    
}
