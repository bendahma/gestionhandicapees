@extends('layouts.template')

@section('addOrEditRappel')
    <div class="container-fluid">
        <div class="card card-default">
            <div class="card-header">
                <h3>Mettre à jours la durée du rappel</h3>
            </div>
            <div class="card-body">
                <form action="{{route('rappel.updateRappel',$rappel->id)}}" method="POST">
                    @method('PATCH')
                    @csrf
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="name" class="font-weight-bold">Nom & Prenom</label>
                                <input type="text" class="form-control" readonly required value="{{ $hand->nameFr }}">
                              </div>
                         </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="" class="font-weight-bold">Date Naissance</label>
                                <input type="date" class="form-control" readonly value="{{  $hand->dob }}">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="" class="font-weight-bold">CCP</label>
                                <input type="text" class="form-control" readonly value="{{  $hand->paieinformation->CCP }}">
                            </div>
                        </div>
                    </div>
                    <div class="row mt-1">
                        <div class="col">
                            <div class="form-group">
                                <label for="name" class="font-weight-bold">Date Debut</label>
                                <input type="date" class="form-control" required id="name" name="dateDebut" placeholder="Date Debut Rappel ..." value="{{isset($rappel) ? $rappel->DateDebut : ''}}">
                              </div>
                         </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="" class="font-weight-bold">Date Fin</label>
                                <input type="date" class="form-control" id="" name="dateFin" placeholder="Date Fin Rappel ..." value="{{ isset($rappel) ? $rappel->DateFin : '' }}">
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row mt-1">
                       <div class="col">
                         <input type="submit" value="Mettre à jours" class="btn btn-outline-success btn-block">
                      </div>
                       <div class="col">
                         <input type="reset" value="Mettre à jours" class="btn btn-danger btn-block">
                      </div>
                   </div>
                
                </form>
            </div>
        </div>
    </div>
@endsection