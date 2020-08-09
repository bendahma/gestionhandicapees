@extends('layouts.template')

@section('AfficheCfTresor')
<div class="container-fluid">
  <h4>Les Données Des Engagements Et Mondates Du Paiement</h4>
    <div class="card shadow mt-3">
       <div class="card-header">
         <h6 class="m-0 font-weight-bold text-primary">Données des engagements et mondates du paiement</h6>
       </div>
       <div class="card-body">
         <div class="table-responsive">
            <table class="table table-bordered" id="" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Annee</th>
                  <th>Mois</th>
                  <th>N° Mondate Paie</th>
                  <th>N° Mondate Assurance</th>
                  <th>Date Mondate</th>
                  <th>N° Engagement Paie</th>
                  <th>N° Engagement Assurance</th>
                  <th>Date Engagement</th>
                </tr>
              </thead>
              <tbody>
                {{-- @foreach ($paie as $key => $p)
                    <tr>
                      <td>{{$p->anneesPaiement}}</td>
                      <td>{{$p->moisPaiement}}</td>
                      <td>{{$p->NumeroMondatePaie}}</td>
                      <td>{{$p->NumeroMondatePaie}}</td>
                      <td style="padding: 10px 0;font-size:0.9rem;">{{$p->dateMondatePaie}}</td>
                      <td>{{$p->NumeroEngagementPaie}}</td>
                      <td>{{$p->NumeroEngagementPaie}}</td>
                      <td style="padding: 10px 0;font-size:0.9rem;">{{$p->dateEngagementPaie}}</td>                      
                    </tr>
                @endforeach --}}
              </tbody>
            </table>
          </div>
       </div>
    </div>
 </div>
@endsection