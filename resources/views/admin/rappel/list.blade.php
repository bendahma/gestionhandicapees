@extends('layouts.template')

@section('list_rappels')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
          <h1 class="h3 mb-0 text-gray-800">Listes des Rappels des Handicapées</h1>
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
                     <th>N°</th>
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
                     @foreach ($rappels as $key => $r)
                     <tr>
                        <td> {{$key = $key +1}} </td>
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
                          <ul class="nav">
                              <div class="d-flex">
                                 @if($r->RappelFait == 0)
                                    <form action="{{route('rappel.confirm',$r->rappel_id)}}" method="POST">
                                          @method('PATCH')
                                          @csrf
                                          <button tyle="submit" class="btn btn-link" style="font-size: 1.5rem; "> <span style="color:rgb(64, 14, 243); cursor: pointer;"><i class="far fa-check-circle"></i></span></button>
                                    </form> 
                                 @endif
                            
                                 <a class="btn btn-link" href="{{route('rappel.findInfo',[$r->rappel_id,$r->hand_id])}}" style="font-size: 1.5rem"> <span style="color:rgb(14, 243, 91)"><i class="fas fa-user-edit "></i></span></a>

                                 <form action="{{route('rappel.destroy',$r->rappel_id)}}" method="POST">
                                       @method('DELETE')
                                       @csrf
                                       <button tyle="submit" onclick="alert('Are you sure you want to delete rappel')" class="btn btn-link" style="font-size: 1.5rem;"> 
                                          <span style="color:tomato"><i class="far fa-trash-alt"></i> 
                                       </button>
                                 </form> 
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
      
@endsection