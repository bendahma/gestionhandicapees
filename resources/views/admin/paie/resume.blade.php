@extends('layouts.template')

@section('PaieResume')

    <div class="container-fluid">

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Paiement du mois {{date('M Y')}}  </h1>
          </div>

        <div class="row">
            <div class="col-xl-4 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Nombre des handicapées</div>
                      <div class="h3 mb-0 font-weight-bold text-gray-800">{{ number_format($count,0,',',' ') }} Personne</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-wheelchair fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Chapitre 46-15 article U</div>
                      <div class="h3 mb-0 font-weight-bold text-gray-800">{{ number_format($count*10000,2,',',' ') }} DZ</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-money-bill-wave fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Chapitre 33-13 article 02</div>
                      <div class="h3 mb-0 font-weight-bold text-gray-800">{{ number_format($count*1000,2,',',' ') }} DZ</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>

         <div class="card shadow">
            <div class="card-header">
               La paperasse du chapitre 46-15 article U
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-lg-2">
                 <h5 class="pt-2" style="color:black;font-weight:600">Engagement 46-15</h5>
                </div>
                <div class="col-lg-2">
                  <a href="{{route('paie.engagement', 'Paiement')}}" class="btn btn-primary btn-block"><i class="fas fa-download"></i> Télécharger</a>
                </div>
                <div class="col-lg-2">
                  <h5 class="pt-2" style="color:black;font-weight:700">Mondate 46-15</h5>
                </div>
                <div class="col-lg-2">
                   <a href="{{route('paie.mondate', 'Paiement')}}" class="btn btn-primary btn-block"><i class="fas fa-download"></i> Télécharger</a>
                </div>
               </div>
               <div class="row mt-3">
                  <div class="col-lg-2">
                    <h5 class="pt-2" style="color:black;font-weight:700">Etat Paiement</h5>
                  </div>
                  <div class="col-lg-2">
                     <a href="{{route('paie.export')}}" class="btn btn-primary btn-block"><i class="fas fa-download"></i> Télécharger</a>
                  </div>
                  <div class="col-lg-2">
                     <h5 class="pt-2" style="color:black;font-weight:700">Répartition</h5>
                   </div>
                   <div class="col-lg-2">
                      <a href="{{route('paie.repartition')}}" class="btn btn-primary btn-block"><i class="fas fa-download"></i> Télécharger</a>
                   </div>
                   <div class="col-lg-2">
                     <h5 class="pt-2" style="color:black;font-weight:700">Décision</h5>
                   </div>
                   <div class="col-lg-2">
                      <a href="{{route('paie.decision')}}" class="btn btn-primary btn-block"><i class="fas fa-download"></i> Télécharger</a>
                   </div>
               </div>
            </div>
        </div>
        <div class="card shadow mt-3">
              <div class="card-header">
                  La paperasse du chapitre 33-13 article 02
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-lg-2">
                    <h5 class="pt-2" style="color:black;font-weight:600">Engagement 33-13</h5>
                  </div>
                  <div class="col-lg-2">
                    <a href="{{route('paie.engagement', 'Assurance')}}" class="btn btn-primary btn-block"><i class="fas fa-download"></i> Télécharger</a>
                  </div>
                  <div class="col-lg-2">
                    <h5 class="pt-2" style="color:black;font-weight:700">Mondate 33-13</h5>
                  </div>
                  <div class="col-lg-2">
                      <a href="{{route('paie.mondate', 'Assurance')}}" class="btn btn-primary btn-block"> <i class="fas fa-download"></i> Télécharger</a>
                  </div>
                  
                  </div>
                  <div class="row mt-3">
                    <div class="col-lg-2">
                      <h5 class="pt-2" style="color:black;font-weight:700">Bordereau Cnas</h5>
                    </div>
                    <div class="col-lg-2">
                        <a href="{{route('paie.Cnas', 'BORDEREAU')}}" class="btn btn-primary btn-block"><i class="fas fa-download"></i>Télécharger</a>
                    </div>
                    <div class="col-lg-2">
                        <h5 class="pt-2" style="color:black;font-weight:700">Cotisation Cnas</h5>
                      </div>
                      <div class="col-lg-2">
                        <a href="{{route('paie.Cnas', 'COTISATION')}}" class="btn btn-primary btn-block"><i class="fas fa-download"></i>Télécharger</a>
                      </div>
                      <div class="col-lg-2">
                        <h5 class="pt-2" style="color:black;font-weight:700">Avis Virement</h5>
                      </div>
                      <div class="col-lg-2">
                        <a href="{{route('paie.Cnas', 'AVIS')}}" class="btn btn-primary btn-block"><i class="fas fa-download"></i>Télécharger</a>
                      </div>
                  </div>
              </div>
        </div>
        <div class="card shadow mt-3">
                <div class="card-header">
                  La Bordereaux & jounales
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-2">
                        <h5 class="pt-2" style="color:black;font-weight:700">Bordereau CF</h5>
                        </div>
                        <div class="col-lg-2">
                          <a href="{{route('paie.BordereauCf')}}" class="btn btn-primary btn-block"><i class="fas fa-download"></i> Télécharger</a>
                        </div>
                        <div class="col-lg-2">
                          <h5 class="pt-2" style="color:black;font-weight:700">Bordereau CD</h5>
                        </div>
                        <div class="col-lg-2">
                          <a href="{{route('paie.BordereauCD')}}" class="btn btn-primary btn-block"><i class="fas fa-download"></i> Télécharger</a>
                        </div>
                        <div class="col-lg-2">
                          <h5 class="pt-2" style="color:black;font-weight:700">Journal</h5>
                        </div>
                        <div class="col-lg-2">
                          <a href="{{route('paie.Journal')}}" class="btn btn-primary btn-block"><i class="fas fa-download"></i> Télécharger</a>
                        </div>
                    </div>
                 </div>
        </div>
    </div>
@endsection    