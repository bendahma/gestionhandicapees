@extends('layouts.template')


@section('history')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
          <h1 class="h3 mb-0 text-gray-800">Listes Des Handicpaée renouvelle son dossier annuel</h1>
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
              
              
            </tr>
          </thead>
          <tbody>
            @foreach ($hands as $key => $hand)
              <tr>
                <td>{{$key = $key + 1}}</td>
                <td width="40%">{{$hand->nameFr}}</td>
                <td width="40%">{{date('d/m/Y', strtotime($hand->dob))}}</td>
              </tr>
            @endforeach
            
          </tbody>
        </table>
      </div>
    </div>
  </div>        

      </div>
      
@endsection