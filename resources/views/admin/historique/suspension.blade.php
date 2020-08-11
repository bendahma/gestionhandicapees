@extends('layouts.template')

@section('PaiementHistory')
    <div class="container-fluid">
      <div class="d-sm-flex align-items-center justify-content-between mb-4">
         <h1 class="h3 mb-0 text-gray-800">Historique du paiement</h1>
         <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-file-excel"></i> <i class="fas fa-download fa-sm text-white-50"></i> Télécharger</a>
       </div>

       <div class="card shadow mb-4">
         <div class="card-header py-3">
           <h6 class="m-0 font-weight-bold text-primary">Handicapées</h6>
         </div>
         <div class="card-body">
            <div class="row">
               <div class="col-lg-4">
                  <div class="form-group">
                        <label for="name" class="font-weight-bold">Nom & Prenom</label>     
                        <input type="text" class="form-control" readonly value="{{$hand->nameFr}}">
                  </div>   
               </div>
               <div class="col">
                  <div class="form-group">
                     <label for="name" class="font-weight-bold">Date de naissance</label>     
                     <input type="text" class="form-control" readonly value="{{$hand->dob}}">
                  </div>                 
               </div>
               <div class="col">
                  <div class="form-group">
                     <label for="name" class="font-weight-bold">Commune</label>     
                     <input type="text" class="form-control" readonly value="{{$commune->nomCommuneFr}}">
                  </div>                 
               </div>
               <div class="col">
                  <div class="form-group">
                     <label for="name" class="font-weight-bold">CCP</label>     
                     <input type="text" class="form-control" readonly value="{{$hand->paieinformation->CCP}}">
                  </div>                 
               </div>
            </div>
           
         </div>
       </div>
    </div>
    
    <div class="container-fluid">
       <div class="card shadow mt-3">
          <div class="card-header">
            <h6 class="m-0 font-weight-bold text-primary">Historique du paiement</h6>
          </div>
          <div class="card-body">
            <div class="table-responsive">
               <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                 <thead>
                   <tr>
                      <th>N°</th>
                     <th>Date suspension</th>
                     <th>Date Régélement</th>
                     <th>Motif</th>
                     <th>Action</th>
                   </tr>
                 </thead>
                 <tbody>
                     @foreach ($hand->handSuspentionHistories as $key => $h)
                        <tr>
                            <td>{{$key = $key +1 }}</td>
                            <td>{{isset($h->dateSupprission) ? $h->dateSupprission : ''}}</td>
                            <td>{{isset($h->dateRemi) ? $h->dateRemi : ''}}</td>
                            <td>{{isset($h->motif) ? $h->motif : ''}}</td>
                            <td> 
                               <form action="{{route('historique.DeleteHistoireSuspension',$hand->id,$h->id)}}" method="POST">
                                 @csrf
                                 @method("DELETE")
                                 <input type="submit" value="Supprime Historique" class="btn btn-danger btn">
                              </form>
                        </tr>
                    @endforeach           
                 </tbody>
               </table>
             </div>
          </div>
       </div>
    </div>
@endsection