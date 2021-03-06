@extends('layouts.template')

@section('page')
    Budget
@endsection

@section('addBudget')
    <div class="container-fluid">
       <!-- Page Heading -->
       <div class="d-sm-flex align-items-center justify-content-between mb-4">
         <h1 class="h3 mb-0 text-gray-800">Ajouter Le Budget d'Année {{ date('Y') }}</h1>
       </div>
       <div class="card shadow mb-4">
         <div class="card-header py-3">
           <h6 class="m-0 font-weight-bold text-primary">Budget</h6>
         </div>
         <div class="card-body">
            {{$date = date('Y')}}
            <form method="POST" action="{{route('budget.update',$date)}}">
               @csrf
               @method('PATCH')
               <div class="row">
                     <div class="col">
                        <h4 class="text-danger font-weight-bold">Chapitre 46-15 Article U</h4>
                        <hr>
                        <div class="form-group">
                           <label for="name" class="font-weight-bold">Montant du chapitre</label>
                           <input type="number" class="form-control" id="" name="budgetMondatement" placeholder="Montant du chapitre 46-15 ..." >
                        </div>
                     </div>
                     <div class="col">
                        <h4 class="text-danger font-weight-bold">Chapitre 33-13 Article 02</h4>
                        <hr>
                        <div class="form-group">
                           <label for="name" class="font-weight-bold">Montant du chapitre</label>
                           <input type="number" class="form-control" id="" name="budgetAssurance" placeholder="Montant du chapitre 33-13 ..." >
                        </div>
                     </div>
               </div>
               
               
               <div class="row">
                  <div class="col">
                     <input type="submit" value="Ajouter" class="btn btn-success btn-block">
                  </div>
                  <div class="col">
                     <input type="reset" value="Efface" class="btn btn-danger btn-block">
                  </div>
               </div>
            </form>
         </div>
       </div>
       
       <div class="card shadow mb-4">
         <div class="card-header py-3">
           <h6 class="m-0 font-weight-bold text-primary">Budget Supplimentaire</h6>
         </div>
         <div class="card-body">
            {{$date = date('Y')}}
            <form method="POST" action="{{route('budget.updateBudgetSupplimentaire',$date)}}">
               @csrf
               @method('PATCH')
               <div class="row">
                     <div class="col">
                        <h4 class="text-danger font-weight-bold">Chapitre 46-15 Article U</h4>
                        <hr>
                        <div class="form-group">
                           <label for="name" class="font-weight-bold">Montant du chapitre</label>
                           <input type="number" class="form-control" id="" name="budgetSupplimenatireMondatement" placeholder="Montant du chapitre 46-15 ..." >
                        </div>
                     </div>
                     <div class="col">
                        <h4 class="text-danger font-weight-bold">Chapitre 33-13 Article 02</h4>
                        <hr>
                        <div class="form-group">
                           <label for="name" class="font-weight-bold">Montant du chapitre</label>
                           <input type="number" class="form-control" id="" name="budgetSupplimentaireAssurance" placeholder="Montant du chapitre 33-13 ..." >
                        </div>
                     </div>
                     <div class="col-lg-2">
                        <h4 class="text-danger font-weight-bold">ANNEE</h4>
                        <hr>
                        <div class="form-group">
                           <label for="name" class="font-weight-bold">Annee</label>
                           <input type="number" class="form-control" id="" name="budgetSupplimentaireAnnee" placeholder="Annee Du Budget Supplimentaire ..." >
                        </div>
                     </div>
               </div>
               
               
               <div class="row">
                  <div class="col">
                     <input type="submit" value="Ajouter" class="btn btn-success btn-block">
                  </div>
                  <div class="col">
                     <input type="reset" value="Efface" class="btn btn-danger btn-block">
                  </div>
               </div>
            </form>
         </div>
       </div>
       
    </div>
@endsection