@extends('layouts.template')

@section('page')
    Convocation
@endsection

@section('dashboard')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
          <h1 class="h3 mb-0 text-gray-800">Listes des Handicapées mondate </h1>
          <a href="{{route('hands.exportHandsMondate')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-file-excel"></i> <i class="fas fa-download fa-sm text-white-50"></i> Liste Hand Mondate</a>
        </div>

 <!-- DataTales Example -->
 <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Handicapées</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>N°</th>
              <th>Nom & Prenom</th>
              <th>Date Naissance</th>
              <th>Télécharger</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($hands as $n => $hand)
              <tr>
                <td>{{$n++}}</td>
                <td>{{$hand->nameFr}}</td>
                <td>{{date('d/m/Y', strtotime($hand->dob))}}</td>
                
                <td>
                  <ul class="nav ">
                       <div class="d-flex">
                            <button type="button" class="btn btn-link" onclick="convocationHandler({{$hand->id}})" style="font-size: 1rem;text-decoration:none;color:black;font-weight:600"> 
                                <span style="color:tomato"><i class="fas fa-envelope-open-text"></i></span>
                                Télécharger
                            </button>
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

      <form action="" method="POST" id="convocationForm">
        @csrf
        <div class="modal fade" id="convocationModel" tabindex="-1" role="dialog" aria-labelledby="convocationModelTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="convocationModelTitle">Convocation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    
                    <div class="form-group text-right">
                        <label for="" class="font-weight-bold text-right">الأوراق</label>
                        <input type="text" name="paper" class="form-control" dir="rtl">
                    </div>
                    <div class="form-group text-right">
                        <label for="" class="font-weight-bold text-right">سبب الإستدعاء</label>
                        <input type="text" name="motif" class="form-control" dir="rtl">
                    </div>
                   
                </div>
                <div class="modal-footer">
                <button type="submit" class="btn btn-success">Télechargé</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annulé</button>
                </div>
            </div>
            </div>
        </div>

    </form>
      
@endsection