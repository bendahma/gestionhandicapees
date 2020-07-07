@extends('layouts.template')

@section('addDesengagement')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Desengagement Pour Le Budget d'Année {{ date('Y') }}</h1>
        </div>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Desengagement</h6>
            </div>
            <div class="card-body">
                <form action="{{route('budget.DesengagementBudget')}}" method="post">
                    @csrf
                    @method("PATCH")
                    <div class="row">
                        <input type="hidden" name="annee" value="{{date('Y')}}">
                        <div class="col">
                           <h4 class="text-danger font-weight-bold">Desengagement Chapitre 46-15</h4>
                           <hr>
                           <div class="form-group">
                              <input type="number" class="form-control" id="" name="desengagementMondatement" placeholder="Montant du chapitre 46-15" >
                           </div>
                        </div>
                        <div class="col">
                           <h4 class="text-danger font-weight-bold">Desengagement Chapitre 33-13</h4>
                           <hr>
                           <div class="form-group">
                              <input type="number" class="form-control" id="" name="desengagementAssurance" placeholder="Montant du chapitre 46-15" >
                           </div>
                        </div>
                        <div class="col-lg-2">
                            <h4 class="text-danger font-weight-bold">Action</h4>
                            <hr>
                            <div class="form-group">
                                <input type="submit" value="Mettre a jours" class="btn btn-success">
                            </div>
                        </div>
                  </div>
                  
                </form>
            </div>
        </div>
    </div>
@endsection