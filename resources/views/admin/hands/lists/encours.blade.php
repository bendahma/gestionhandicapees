@extends('layouts.template')

@section('page')
    Liste Des Handicapées Mondates
@endsection

@section('dashboard')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
          <h1 class="h3 mb-0 text-gray-800">Listes des Handicapées mondate</h1>
          <a href="{{route('hands.exportHandsMondate')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-file-excel"></i> <i class="fas fa-download fa-sm text-white-50"></i> Liste Hand Mondate</a>
        </div>

 <!-- DataTales Example -->
 <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Handicapées</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTableATT" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Nom & Prenom</th>
              <th>Date Naissance</th>
              <th>ACTION</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($hands as $hand)
              <tr>
                <td>{{$hand->nameFr}}</td>
                <td>{{date('d/m/Y', strtotime($hand->dob))}}</td>
                <td>
                  <ul class="nav ">
                        <div class="d-flex">
                          <a class="btn btn-link" href="{{route('hands.show', $hand->id)}}" style="font-size: 1.5rem"> <span style="color:rgb(7, 60, 233)"><i class="far fa-eye"></i></span> </a>
                          <a class="btn btn-link" href="{{route('hands.edit', $hand->id)}}" style="font-size: 1.5rem"> <span style="color:rgb(14, 243, 91)"><i class="fas fa-user-edit "></i></span></a>
                          @if ($hand->status->status == 'En cours')
                            <button type="button" class="btn btn-link" onclick="deleteHandaler({{$hand->id}})" style="font-size: 1.5rem"> <span style="color:tomato"><i class="far fa-trash-alt"></i></span></button>
                          @endif
                        </div>
                  </ul>
                </td>
              </tr>
            @endforeach
            
          </tbody>
        </table>
      </div>
    </div>
  </div>        

      </div>
      <!-- /.container-fluid -->

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
                     {{-- <h6 class="text-center"> Are you sur you want to delete this category. </h6>  --}}
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
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annulé</button>
                <button type="submit" class="btn btn-danger">Supprime</button>
                </div>
            </div>
            </div>
        </div>

    </form>
      
@endsection