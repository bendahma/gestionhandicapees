<div>
    <form action="" method="POST" id="deleteForm">
        @method('DELETE')
        @csrf

        <div class="modal fade" id="deleteModel" tabindex="-1" role="dialog" aria-labelledby="deleteModelTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="deleteModelTitle">Supprime Handicapées</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                          <div class="col">
                            <div class="form-group">
                                <label for="" class="font-weight-bold text-right">Action</label>
                                <select name="status" id="" class="form-control">
                                  <option value="Suspendu">Suspendu</option>
                                  <option value="Arrete">Arrete</option>
                                </select>
                            </div>
                          </div>      
                          <div class="col">
                            <div class="form-group">
                                <label for="" class="font-weight-bold text-right">Date Supprission</label>
                              <input type="date" name="dateSupprission" id="" class="form-control">
                            </div>
                          </div>      
                        </div> 
                        <div class="row" dir="rtl">
                            <div class="col">
                              <div class="form-group" >
                                <label for="" class="font-weight-bold text-center " >سبب التوقيف</label>
                                <select name="motifAr" class="form-control" dir="rtl" id="motifSup">
                                    <option value="" selected>إختر سبب الحذف</option>
                                    <option value="DOSSIER ANNUEL">عدم تحديد الملف السنوي</option>
                                    <option value="CNAS ACTIVE">الإنتساب للضمان الإجتماعي للأجراء</option>
                                    <option value="CASNOS ACTIVE">الإنتساب للضمان الإجتماعي لغير الأجراء</option>
                                    <option value="EMPLOI DU JEUNE">الإستفادة من عقود الإدماج المهني</option>
                                    <option value="DAIS">الإستفادة من برنامج الإدماج الإجتماعي (DAIS)</option>
                                    <option value="AFS"> الإستفادة من المنحة الجزافية للتضامن (AFS)</option>
                                    <option value="DCD">وفاة</option>
                                    <option value="ReversionCNR">مستفد من معاش التقاعد المنقول بالداخل و الخارج</option>
                                    <option value="MOUDJAHIDINE">مستفيد من معاش التقاعد المنقول للمجاهدين</option>
                                    <option value="ASSAINISSEMENT">تخفيض في نسبة العجز</option>
                                    <option value="CNR">مستفيد من معاش التقاعد</option>
                                    <option value="TravailHand">مستفيد من مناصب التشغيل في إطار الادماج المهني للأشخاص المعوقين</option>
                                    <option value="PRISON">تواجد الشخص المعوق في السجن</option>
                                    <option value="RegistreCommerce">تسجيل الشخص المعوق في السجل التجاري</option>
                                    <option value="ANGEM">مستفيد من برنامج القرض المصغر</option>
                                    <option value="TourismeAg">مستفيد من برامج الدعم في قطاع السياحة و الفلاحة</option>
                                    <option value="DESISTEMENT">تنازل</option>
                                    <option value="CHANGEMENT_WILAYA">تغيير الإقامة لولاية أخرى</option>
                                    <option value="AUTRE" >أسباب أخرى</option>                                
                                </select>
                              </div>
                            </div>
                        </div> 
                        <div class="row" style="display: none" id="AutreSuppMotif" dir="rtl">
                          <div class="col">
                              <input type="text" name="autreSupMotif" id="" placeholder="سبب آخر" class="form-control" dir="rtl">
                          </div>
                        </div>
                        <div class="row">
                          <div class="col">
                            <div class="form-group">
                              <label for="" class="font-weight-bold text-right">Justification</label>
                              <input type="text" name="justification" id="" class="form-control">
                            </div>
                          </div>
                          <div class="col">
                            <div class="form-group">
                              <label for="" class="font-weight-bold text-right">Declare par</label>
                              <input type="text" name="declarepar" id="" class="form-control">
                            </div>
                          </div>
                        </div>
                        <div class="row" >
                          <div class="col">
                            <div class="form-group">
                              <label for="" class="font-weight-bold text-right">Obs</label>
                              <textarea name="ObsSuspension" id="" class="form-control" >Obs</textarea>
                            </div>
                          </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Annulé</button>
                      <button type="submit" class="btn btn-danger">Supprime</button>
                    </div>
                </div>
            </div>
        </div>

      </form>
</div>