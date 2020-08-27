@extends('layouts.template')

@section('page')
    List Hand Sans Dossier Annuel
@endsection

@section('dashboard')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
          <h1 class="h3 mb-0 text-gray-800">Listes des Handicapées Sans Dossier Annuel </h1>
          <h3>Commune : {{$commune->nomCommuneFr}}</h3>
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
              <th>N°</th>
              <th>Nom & Prenom</th>
              <th>Date Naissance</th>
              
              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($handNonRen as $n => $hand)
              <tr>
                <td>{{$n=$n+1}}</td>
                <td>{{$hand->nameFr}}</td>
                <td>{{date('d/m/Y', strtotime($hand->dob))}}</td>
              
                <td>
                 
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