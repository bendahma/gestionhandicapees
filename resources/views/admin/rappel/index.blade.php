@extends('layouts.template')

@section('RappelResume')

    <div class="container">

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Résumé des Rappels d'année {{date('Y')}}  </h1>
         </div>
         <div class="d-sm-flex align-items-center justify-content-between mb-4">
          <h5 class=" mb-0 text-gray-600">Les Rappels Payer  </h5>
         </div>
        <div class="row">
            <div class="col">
              <div class="card border-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-sm font-weight-bold text-primary text-uppercase mb-1">Nombre des Rappels </div>
                      <div class="h4 mb-0 font-weight-bold text-gray-800">
                            {{$nbrRappel}}
                        </div>
                    </div>
                    <div class="col-auto">
                     <i class="fas fa-money-bill-wave fa-2x text-gray-300"></i>
                  </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="card border-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-sm font-weight-bold text-primary text-uppercase mb-1">Nombre Des Personnes Payer</div>
                      <div class="h4 mb-0 font-weight-bold text-gray-800">
                            {{$nbrPersonne}}
                        </div>
                    </div>
                    <div class="col-auto">
                     <i class="fas fa-money-bill-wave fa-2x text-gray-300"></i>
                  </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="card border-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-sm font-weight-bold text-primary text-uppercase mb-1">Nombre Des Mois Payer</div>
                      <div class="h4 mb-0 font-weight-bold text-gray-800">
                          {{$nbrMois}}
                      </div>
                    </div>
                    <div class="col-auto">
                     <i class="fas fa-money-bill-wave fa-2x text-gray-300"></i>
                  </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
        <div class="row mt-3">
          <div class="col">
            <div class="card border-success shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-sm font-weight-bold text-primary text-uppercase mb-1">Montant des Rappels ( CHAP 46/15 ART U) </div>
                    <div class="h4 mb-0 font-weight-bold text-gray-800">
                          {{ number_format($MontantRappel,2,'.',' ')}}
                      </div>
                  </div>
                  <div class="col-auto">
                   <i class="fas fa-money-bill-wave fa-2x text-gray-300"></i>
                </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="card border-success shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-sm font-weight-bold text-primary text-uppercase mb-1">Montant d'Assurance ( CHAP 33/13 ART 2 )</div>
                    <div class="h4 mb-0 font-weight-bold text-gray-800">
                          {{ number_format($MontantAssurance,2,'.',' ')}}
                      </div>
                  </div>
                  <div class="col-auto">
                   <i class="fas fa-money-bill-wave fa-2x text-gray-300"></i>
                </div>
                </div>
              </div>
            </div>
          </div>
      </div>

      <br>

      <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h5 class=" mb-0 text-gray-900">Les Rappels En Instance  </h5>
      </div>
      
    </div>

    <br><br><br><br>
@endsection