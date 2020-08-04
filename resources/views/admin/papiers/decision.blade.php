@extends('layouts.template')


@section('listAttestation')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
          <h1 class="h3 mb-0 text-gray-800">Décision des Handicapées {{$papier}}</h1>
        </div>

 <!-- DataTales Example -->
 <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Handicapées</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTableATT" width="100%">
          <thead>
            <tr>
              <th>Nom & Prenom</th>
              <th>Date Naissance</th>
              <th>Décision</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($hands as $hand)
               <tr>
                  <td>{{$hand->nameFr}}</td>
                  <td>{{date('d/m/Y', strtotime($hand->dob))}}</td>
                  <td class="d-flex">
                        <a class="btn btn-link mx-auto" href="{{route('decision.telecharger', [$hand->id,$papier])}}" style="font-size: 1.4rem"> 
                          <span style="color:rgb(56, 14, 243)"><i class="fas fa-file-download"></i></span>
                          <span style="font-size:0.9rem; font-weight:700">Télécharger</span>
                        </a>
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