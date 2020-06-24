@extends('layouts.template')

@section('addOrEditRappel')

    <div class="container-fluid">

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">{{isset($rappel) ? 'Mise a Jour Les Informations Du rappel' : 'Ajouter un rappel'}} </h1>
         </div>

        <div class="card shadow">
            <div class="card-body">
                <form method="POST" action="{{isset($rappel) ? route('rappel.update', $rappel->id) : route('rappel.store') }}">
                    @csrf
                    @if(isset($hand))
                        @method('PATCH')
                    @endif
                    <h4 class="text-danger font-weight-bold">Les information du handicapée</h3>
                    <hr>
                    <div class="row mt-1">
                        <div class="col">
                            <div class="form-group">
                                <label for="name" class="font-weight-bold">Nom & Prenom</label>
                                <input type="text" class="form-control" required id="name" readonly name="nameFr" value="{{isset($hand) ? $hand->nameFr : ''}}">
                              </div>
                         </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="" class="font-weight-bold">Date de Naissance</label>
                                <input type="date" class="form-control" id="" readonly name="dob" value="{{ isset($hand) ? $hand->dob : '' }}">
                            </div>
                        </div>
                        <div class="col">
                           <div class="form-group">
                               <label for="" class="font-weight-bold">CCP</label>
                               <input type="text" class="form-control" readonly  id="" name="CCP" placeholder="CCP..." value="{{isset($hand) ? $hand->paieinformation->CCP : ''}}">
                             </div>
                        </div>
                         
                    </div>
                    <div class="row">
                     <div class="col">
                       <div class="form-group">
                           <label for="" class="font-weight-bold">Obs</label>
                           <textarea name="obs" id="" cols="30" rows="5" class="form-control">
                              {{isset($hand) ? $hand->obs : ''}}
                           </textarea>
                       </div>
                    </div>
                 </div>
                 <hr>
                    <h4 class="text-danger font-weight-bold">Les information du leur rappel</h3>
                     <hr>
                     <div class="row mt-1">
                         <div class="col-lg-3">
                             <div class="form-group">
                                 <label for="name" class="font-weight-bold">Date Debut</label>
                                 <input type="date" class="form-control" required id="name" name="dateDebut" placeholder="Date Debut Rappel ..." value="{{isset($rappel) ? $rappel->DateDebut : ''}}">
                               </div>
                          </div>
                         <div class="col-lg-3">
                             <div class="form-group">
                                 <label for="" class="font-weight-bold">Date Fin</label>
                                 <input type="date" class="form-control" id="" name="dateFin" placeholder="Date Fin Rappel ..." value="{{ isset($rappel) ? $rappel->DateFin : '' }}">
                             </div>
                         </div>
                     </div>
                     <hr>
                    <div class="row">
                        <div class="col">
                            <input type="submit" value="{{isset($hand) ? 'Mettre a jours' : 'Ajouter'}}" class="btn btn-success">
                        </div>
                    </div>
                  </form>
            </div>
        </div>
    </div>
    
@endsection