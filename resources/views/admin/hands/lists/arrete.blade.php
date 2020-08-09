@extends('layouts.template')

@section('page')
    Listes Des Suspendu
@endsection

@section('dashboard')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
          <h1 class="h3 mb-0 text-gray-800">Listes des Handicapées Suspendu et Arrete</h1>
          <div>
            <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm" onclick="suspenduRange()"> <span><i class="far fa-calendar-times"></i></span> Date suspension </button>
            <a href="{{route('hands.exportHandsSuspendu')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-file-excel"></i> <i class="fas fa-download fa-sm text-white-50"></i> Liste Hand Suspendu</a>
          
          </div>
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
              <th>Nom & Prenom</th>
              <th>Date Naissance</th>
              <th>Date suspension</th>
              <th>Motif</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($hands as $hand)
              <tr>
                <td>{{$hand->nameFr}}</td>
                <td>{{date('d/m/Y', strtotime($hand->dob))}}</td>
                <td>
                    {{$hand->status->dateSupprission}}
                </td>
                <td>
                    {{$hand->status->motifAr}}
                </td>
              </tr>
            @endforeach
            
          </tbody>
        </table>
      </div>
    </div>
  </div>        

      </div>
      <!-- /.container-fluid -->

     @include('admin.statistics.suspensionDates')
      
@endsection