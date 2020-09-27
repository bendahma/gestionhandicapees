@extends('layouts.template')

@section('addOrEditRappel')

    <div class="container-fluid">

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Saisie Un Rappel</h1>
         </div>

        <div class="card shadow">
            <div class="card-body">
                <form method="POST" action="{{route('rappel.Saisie')}}">
                    @csrf
                    <h4 class="text-danger font-weight-bold">Les informations Du Rappel</h3>
                    <hr>
                    <div class="row mt-1">
                            <div class="col">
                                <div class="form-group">
                                    <label for="name" class="font-weight-bold">Date Debut Rappel</label>
                                    <input type="date" class="form-control" required name="dateDebutRappel" value="">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="" class="font-weight-bold">Date Fin Rappel</label>
                                    <input type="date" class="form-control"  name="dateFinRappel" value="">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="name" class="font-weight-bold">Mois Paiement Rappel</label>
                                    <select name="moisRappel" id="" class="custom-select">
                                        <option value="" selected disabled>Choisi mois paiement rappel</option>
                                        <option value="01">Janvier</option>
                                        <option value="02">Fevrier</option>
                                        <option value="03">Mars</option>
                                        <option value="04">Avril</option>
                                        <option value="05">Mai</option>
                                        <option value="06">Juin</option>
                                        <option value="07">Juillet</option>
                                        <option value="08">Aout</option>
                                        <option value="09">Septembre</option>
                                        <option value="10">Octobre</option>
                                        <option value="11">Novembre</option>
                                        <option value="12">Decembre</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="" class="font-weight-bold">ANNEE Du Rappel</label>
                                    <input type="text" class="form-control"  name="anneeRappel" >
                                </div>
                            </div>
                    </div>
                    <h4 class="text-danger font-weight-bold">Les informations Du Paiement</h3>
                     <hr>
                     <div class="row mt-1">
                         <div class="col">
                             <div class="form-group">
                                 <label for="name" class="font-weight-bold">Nombre Des Mois</label>
                                 <input type="number" class="form-control" required id="name" name="nbrMois" placeholder="Nombre des mois">
                               </div>
                          </div>
                         <div class="col">
                             <div class="form-group">
                                 <label for="" class="font-weight-bold">Nombre Des Personnes</label>
                                 <input type="number" class="form-control" name="nbrPersonne" placeholder="Nombre Des Personnes" >
                             </div>
                         </div>
                         <div class="col">
                             <div class="form-group">
                                 <label for="" class="font-weight-bold">Montant Du Rappel(46/15)</label>
                                 <input type="number" class="form-control" name="montantPaiement" placeholder="Montant Du Paiement" >
                             </div>
                         </div>
                         <div class="col">
                             <div class="form-group">
                                 <label for="" class="font-weight-bold">Montant D'Assurance(33/13)</label>
                                 <input type="number" class="form-control" name="montantAssurance" placeholder="Montant D'Assurance" >
                             </div>
                         </div>
                     </div> 
                    <hr>
                    <div class="row">
                        <div class="col">
                            <input type="submit" value="Saisie le rappel" class="btn btn-success">
                        </div>
                    </div>
                  </form>
            </div>
        </div>
    </div>
    
@endsection