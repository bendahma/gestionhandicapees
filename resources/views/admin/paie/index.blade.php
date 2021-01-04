@extends('layouts.template')

@section('PaieResume')

    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Paiement du mois {{date('M Y')}}  </h1>
        </div>
        <div class="row">
            <div class="col-xl-4 col-md-6 mb-4">
              <div class="card border-success shadow h-100 py-2">
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
              <div class="card border-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Chapitre 46-15 article U</div>
                      <div class="h3 mb-0 font-weight-bold text-gray-800">{{ number_format($count*config('paie.MontantPaie'),2,',',' ') }} DZ</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-money-bill-wave fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-md-6 mb-4">
              <div class="card border-secondary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Chapitre 33-13 article 02</div>
                      <div class="h3 mb-0 font-weight-bold text-gray-800">{{ number_format($count*config('paie.MontantAssurance'),2,',',' ') }} DZ</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Paiement Des Mois Passe  </h1>
        </div>
        <div class="card card-body shadow-sm">
          <table class="table" id="dataTable">
            <thead>
              <tr>
                <th>N°</th>
                <th>Annee</th>
                <th>Mois</th>
                <th>Nombre</th>
                <th>Montant Paie</th>
                <th>Montant Assurance</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
                  @foreach ($paies as $p)
                      <tr>
                        <td> {{$loop->iteration}} </td>
                        <td> {{$p->anneesPaiement}} </td>
                        <td> {{DateTime::createFromFormat('!m', $p->moisPaiement)->format('F') }} </td>
                        <td> {{$p->montantPaiement / 10000}} </td>
                        <td> {{ number_format($p->montantPaiement,2,'.',' ')}} </td>
                        <td> {{ number_format($p->montantAssurance,2,'.',' ')}} </td>
                        <td>
                          <a href=" {{route('monthlyPaie.list',$p->id)}} " class="btn btn-outline-success">Listes des Handicapées</a>
                        </td>
                       
                      </tr>
                  @endforeach
            </tbody>
          </table>
        </div>
    </div>
@endsection