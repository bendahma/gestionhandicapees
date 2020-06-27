<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Hand;

class HandPaieStatus extends Model
{
    protected $fillable=['status','dateSupprission','justification','declarepar','motifAr','raisonEnAttente','EnAttentedateComissionPension'];

    public function hand()
    {
        return $this->belongsTo(Hand::class);
    }

    public function CheckPaieStatusInfoExists($id){
        $status = HandPaieStatus::where('hand_id',$id)->first();
        if($status->status == NULL || $status->dateSupprission == NULL || $status->motifAr == NULL ){
            return false;
        }
        return true;
    }

    public function getMotifAr($motif){
        switch($motif){
              case "DCD":
                return 'وفاة';
              case "MOUDJAHIDINE":
                return "مستفيد من معاش التقاعد المنقول للمجاهدين";
              case "ReversionCNR":
                return "مستفد من معاش التقاعد المنقول بالداخل و الخارج";  
              case "MOUDJAHIDINE":
                return "مستفيد من معاش التقاعد المنقول للمجاهدين";  
              case "ASSAINISSEMENT":
                return "تخفيض في نسبة العجز";  
              case "CNR":
                return "مستفيد من معاش التقاعد";  
              case "TravailHand":
                return "مستفيد من مناصب التشغيل في إطار الادماج المهني للأشخاص المعوقين";  
              case "PRISON":
                return "تواجد الشخص المعوق في السجن";  
              case "RegistreCommerce":
                return "تسجيل الشخص المعوق في السجل التجاري";  
              case "ANGEM":
                return "مستفيد من برنامج القرض المصغر";  
              case "TourismeAg":
                return "مستفيد من برامج الدعم في قطاع السياحة و الفلاحة";  
              case "تنازل":
                return "DESISTEMENT"; 
              case "CHANGEMENT_WILAYA":
                return "تغيير الإقامة لولاية أخرى";   
              case "AUTRE":
                return "أسباب أخرى";   
              default :
                return "";
        }
    }   

}
