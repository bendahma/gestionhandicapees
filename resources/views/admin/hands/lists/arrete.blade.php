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
              <th>N°</th>
              <th>Nom & Prenom</th>
              <th>Date Naissance</th>
              <th>ِCommune</th>
              <th>ccp</th>
              <th>Date suspension</th>
              <th>Motif</th>
              <th>Obs</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($hands as $k => $hand)
              <tr>
                <td>{{ $k = $k + 1 }}</td>
                <td>{{$hand->nameFr}}</td>
               
                <td>{{date('d/m/Y', strtotime($hand->dob))}}</td>
                <td>{{$hand->codeCommune}}</td>
                <td>{{$hand->paieinformation->CCP}}</td>
                <td>{{$hand->status->dateSupprission}}</td>
                <td>{{$hand->status->motifAr}}</td>
                <td dir="rtl" style="text-align: right">{{$hand->status->motifAr == 'AUTRE' ? $hand->status->autreMotif : ''}}</td>
                <td>
                  <ul class="nav ">
                    <div class="d-flex">
                       <a class="btn btn-link" href="" style="font-size: 1.5rem" target="_blank"> <span style="color:rgb(7, 60, 233)"><i class="far fa-eye"></i></span> </a>
                       <a class="btn btn-link" href=" {{route('hands.editSuspensionInfo',$hand->id)}} " style="font-size: 1.5rem" target="_blank"> <span style="color:rgb(14, 243, 91)"><i class="fas fa-user-edit "></i></span></a>
                       
                       <a class="btn btn-link" href="" style="font-size: 1.5rem" target="_blank"> <span style="color:tomato"><i class="far fa-trash-alt"></i></span></a>
                      
                     </div>
               </ul>
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