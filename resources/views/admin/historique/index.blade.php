@extends('layouts.template')

@section('page')
    Historique
@endsection

@section('history')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
          <h1 class="h3 mb-0 text-gray-800">Listes des Handicapées mondate</h1>
        </div>

 <!-- DataTales Example -->
 <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Handicapées</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>N° </th>
              <th>Nom & Prenom</th>
              <th>Date Naissance</th>
              <th>CCP</th>
              <th>Statut</th>
              <th>Historique</th>
              <th>Historique</th>
              
            </tr>
          </thead>
          <tbody>
            @foreach ($hands as $n => $hand)
              <tr>
                <td>{{$n+1}}</td>
                <td>{{$hand->nameFr}}</td>
                <td>{{date('d/m/Y', strtotime($hand->dob))}}</td>
                <td>{{$hand->paieinformation->CCP}}</td>
                <td>{{$hand->status->status}}</td>
               <td>
                  <a class="btn btn-link" href="{{route('historique.HistoriquePaie', $hand->id)}}" style="font-size: 1.4rem" style="font-size: 1.4rem; text-decoration:none"> 
                  <span style="font-size: 1rem; font-weight:700; text-decoration:none; color:rgb(61, 9, 204)">Paiement</span></a>
               </td>
               <td>
                  <a class="btn btn-link" href="" style="font-size: 1.4rem; text-decoration:none"> 
                  <span style="font-size: 1rem; font-weight:700; text-decoration:none; color:rgb(241, 10, 10)">Suspension</span> </a>
               </td>
              </tr>
            @endforeach
            
          </tbody>
        </table>
      </div>
    </div>
  </div>        

      </div>
      
@endsection