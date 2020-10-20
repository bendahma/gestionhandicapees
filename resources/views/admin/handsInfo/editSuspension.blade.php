@extends('layouts.template')

@section('page')
      Suspension
@endsection

@section('showSuspenduInfo')

<div class="container-fluid">

   <div class="d-sm-flex align-items-center justify-content-between mb-4">
       <h1 class="h3 mb-0 text-gray-800">Mettre à jours les informations du suspension</h1>
    </div>
         
   

   <div class="card shadow">
       <div class="card-body">
           <form method="POST" action=" {{route('hands.updateSuspensionInfo')}} ">
                @csrf
                @method('PATCH')
               <h4 class="text-danger font-weight-bold">Etat d'Handicapée</h3>
               <hr>
               
               <div class="row mt-1">
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="name" class="font-weight-bold">Etat</label>
                                <input type="text" readonly class="form-control" id="" name="" value=" {{$status->status}} ">
                              </div>
                        </div>
                  
                        <div class="col" >
                              <div class="form-group">
                                  <label for="" class="font-weight-bold" style="text-align: center">Motif</label>
                                  <input type="text" readonly class="form-control text-right" id="" name="" value=" {{$status->motifAr}} ">
                              </div>
                        </div>
                       
                        <div class="col">
                          <div class="form-group">
                              <label for="" class="font-weight-bold">Autre</label>
                              <input type="text" readonly class="form-control" id="" name="" >
                          </div>
                        </div>

                     
                        <div class="col">
                          <div class="form-group">
                              <label for="" class="font-weight-bold">Date Suppression</label>
                              <input type="date" readonly class="form-control" id="" name="" value=" {{$status->dateSupprission}} ">
                          </div>
                        </div>
                   </div>
              
              
               <div class="row">
                <div class="col">
                  <div class="form-group">
                      <label for="" class="font-weight-bold">justification</label>
                      <input type="text" readonly class="form-control" id="" name="" value=" {{$status->justification}} ">
                  </div>
              </div>
              <div class="col">
                  <div class="form-group">
                      <label for="" class="font-weight-bold">Declare par</label>
                      <input type="text" readonly class="form-control" id="" name="" value="">
                  </div>
              </div>
              
              </div>
             
              <div class="row">
                <div class="col">
                  <label for="" class="font-weight-bold">Observation</label>
                  <textarea name="obs" id="" cols="30" rows="2" class="form-control"></textarea>
                </div>
              </div>
             </form>
       </div>
   </div>
</div>

@endsection