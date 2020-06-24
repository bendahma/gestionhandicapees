@extends('layouts.template')

@section('showSuspenduInfo')

<div class="container">

   <div class="d-sm-flex align-items-center justify-content-between mb-4">
       <h1 class="h3 mb-0 text-gray-800">Les informations du handicapé(e) Suspendu</h1>
       {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-file-excel"></i> <i class="fas fa-download fa-sm text-white-50"></i>  --}}
         {{-- Fiche Handicapées</a> --}}
         <div>
          <a class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm" href="{{route('decision.telecharger', [$hand->id,'suspension'])}}"> <span style="color:rgb(255, 255, 255)"><i class="fas fa-file-download"></i></span> Décision du suspension </a> 
          <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" onclick="remiHandaler({{$hand->id}})"> <span><i class="far fa-check-circle"></i></span> Régle la situation </button>
         </div>
         
   </div>

   <div class="card shadow">
       <div class="card-body">
           <form>
               
               <h4 class="text-danger font-weight-bold">Etat d'handicapée</h3>
               <hr>
               <div class="row mt-1">
                   <div class="col-lg-4">
                       <div class="form-group">
                           <label for="name" class="font-weight-bold">Nom & Prenom</label>
                           <input type="text" readonly class="form-control" id="name" name="nameFr" placeholder="Nom & Prenom ..." value="{{isset($hand) ? $hand->nameFr : ''}}">
                         </div>
                    </div>
                   <div class="col">
                       <div class="form-group">
                           <label for="" class="font-weight-bold">Date de Naissance</label>
                           <input type="date" readonly class="form-control" id="" name="dob" placeholder="Date de naissance ..." value="{{ isset($hand) ? $hand->dob : '' }}">
                       </div>
                   </div>
                   <div class="col">
                     <div class="form-group">
                         <label for="" class="font-weight-bold">Commune</label>
                         <input type="text" readonly class="form-control" id="" name=""value="{{ isset($hand) ? $hand->commune : '' }}">
                     </div>
                 </div>
               </div>
               <div class="row mt-1">
                  <div class="col-lg-4">
                      <div class="form-group">
                          <label for="name" class="font-weight-bold">Etat</label>
                          <input type="text" readonly class="form-control" id="" name="" value="{{isset($hand) ? $hand->status->status : ''}}">
                        </div>
                   </div>
                   <div class="col-lg-4" >
                    <div class="form-group">
                        <label for="" class="font-weight-bold" style="text-align: center">Motif</label>
                        <input type="text" readonly class="form-control text-right" id="" name="" value="{{
                            isset($hand) ? $hand->status->getMotifAr($hand->status->motifAr) : ''
                        }}">
                    </div>
                </div>
                  <div class="col">
                      <div class="form-group">
                          <label for="" class="font-weight-bold">Date Suppression</label>
                          <input type="date" readonly class="form-control" id="" name="" value="{{ isset($hand) ? $hand->status->dateSupprission : '' }}">
                      </div>
                  </div>
               </div>
               @php 
                  
                @endphp
               <div class="row mt-1" dir="">
                 
               </div>
               <div class="row">
                <div class="col">
                  <div class="form-group">
                      <label for="" class="font-weight-bold">justification</label>
                      <input type="text" readonly class="form-control" id="" name="" value="{{ isset($hand) ? $hand->status->justification : '' }}">
                  </div>
              </div>
              <div class="col">
                  <div class="form-group">
                      <label for="" class="font-weight-bold">Declare par</label>
                      <input type="text" readonly class="form-control" id="" name="" value="{{ isset($hand) ? $hand->status->declarepar : '' }}">
                  </div>
              </div>
              </div>
              
             </form>
       </div>
   </div>
</div>
    
<form action="" method="POST" id="remiForm">
    @csrf
    <div class="modal fade" id="remiHand" tabindex="-1" role="dialog" aria-labelledby="remiHand" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="deleteModelTitle">Régle la situation du paiement</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                 {{-- <h6 class="text-center"> Are you sur you want to delete this category. </h6>  --}}
                <div class="row">
                  <div class="col">
                    <div class="form-group">
                        <label for="" class="font-weight-bold">Situation</label>
                        <select name="status" id="" class="form-control">
                          <option value="en cours" selected>En cours</option>
                        </select>
                    </div>
                  </div>      
                  <div class="col">
                    <div class="form-group">
                        <label for="" class="font-weight-bold">Date Remi</label>
                       <input type="date" name="dateRemi" id="" class="form-control">
                    </div>
                  </div>      
                </div> 
                <div class="row">
                    <div class="col">
                      <div class="form-group">
                        <label for="" class="font-weight-bold">Raison</label>
                        <input type="text" name="raison" id="" class="form-control">
                      </div>
                    </div>
                </div> 
                <h5 style="color:black;font-weight:700; margin-bottom:1rem;text-decoration:underline">Rappel</h5>
                <div class="row">
                  <div class="col">
                    <div class="form-group">
                      <label for="" class="font-weight-bold">Rappel</label>
                      <select name="meriteRappel" id="" class="form-control">
                        <option value="oui">Oui</option>
                        <option value="non">Non</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col">
                    <div class="form-group">
                      <label for="" class="font-weight-bold">Date Debut</label>
                      <input type="date" name="dateDebut" id="" class="form-control" value="{{$hand->status->dateSupprission}}">
                    </div>
                  </div>
                  <div class="col">
                    <div class="form-group">
                      <label for="" class="font-weight-bold">Date Fin</label>
                      <input type="date" name="dateFin" id="" class="form-control">
                    </div>
                  </div>
              </div>
              <div class="row">
                <div class="col">
                  <div class="form-group">
                      <label for="" class="font-weight-bold">Obs</label>
                      <textarea name="obsRappel" id="" cols="5" rows="3" class="form-control"></textarea>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <div class="row">
                <div class="col-lg-6">
                  <button type="submit" class="btn btn-success btn-block">Régle</button>
                </div>
                <div class="col-lg-6">
                  <button type="button" class="btn btn-secondary btn-block" data-dismiss="modal">Annulé</button>
                </div>
              </div>
            </div>
        </div>
        </div>
    </div>

</form>
  

@endsection