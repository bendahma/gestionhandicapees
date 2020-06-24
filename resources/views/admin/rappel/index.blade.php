@extends('layouts.template')

@section('resumeRappel')
    {{--  --}}
@endsection

@section('list_rappels')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
          <h1 class="h3 mb-0 text-gray-800">Listes des Rappels des Handicapées mondate</h1>
          <a href="{{route('rappel.export')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Liste des Rappels en attente</a>
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
                     <th>Nom & Prenom</th>
                     <th>Date Naissance</th>
                     <th>CCP</th>
                     <th>Date Debut</th>
                     <th>Date Fin</th>
                     <th>Status</th>
                     <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach ($rappels as $r)
                     <tr>
                        <td>{{$r->nameFr}}</td>
                        <td>{{date('d/m/Y', strtotime($r->dob))}}</td>
                        <td>{{$r->CCP}}</td>
                        <td>{{date('d/m/Y', strtotime($r->dateDebut))}}</td>
                        <td>{{date('d/m/Y', strtotime($r->dateFin))}}</td>
                        <td>
                           @if($r->RappelFait == 0)
                              Non payer
                           @else
                              Payer
                           @endif
                        </td>
                        <td>
                          <div class="row">
                            <div class="col-lg-2 align-self-center">
                              @if($r->RappelFait == 0)
                              <form action="{{route('rappel.confirm',$r->rappel_id)}}" method="POST">
                                @method('PATCH')
                                @csrf
                                <button tyle="submit" class="btn btn-link" style="font-size: 1.5rem; margin:0;padding:0;"> <span style="color:rgb(64, 14, 243); cursor: pointer;"><i class="far fa-check-circle"></i></span></button>
                              </form> 
                            </div>
                            <div class="col-lg-2 align-self-center">
                              <a class="btn btn-link" href="{{route('rappel.findInfo',[$r->rappel_id,$r->hand_id])}}" style="font-size: 1.5rem"> <span style="color:rgb(14, 243, 91)"><i class="fas fa-user-edit "></i></span></a>
                            </div>
                            @endif
                          </div>
                          
                           
                           
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
      <!--
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
                    <div class="row">
                        <div class="col">
                          <div class="form-group">
                            <label for="" class="font-weight-bold text-right">Motif</label>
                            <input type="text" name="motif" id="" class="form-control">
                          </div>
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
   -->
@endsection