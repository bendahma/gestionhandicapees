{{-- @extends('layouts.template')

@section('page')
    Convocation
@endsection

@section('dashboard')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
          <h1 class="h3 mb-0 text-gray-800">Listes des Handicapées mondate </h1>
          <a href="{{route('hands.exportHandsMondate')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-file-excel"></i> <i class="fas fa-download fa-sm text-white-50"></i> Liste Hand Mondate</a>
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
              <th>Télécharger</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($hands as $n => $hand)
              <tr>
                <td>{{$n++}}</td>
                <td>{{$hand->nameFr}}</td>
                <td>{{date('d/m/Y', strtotime($hand->dob))}}</td>
                
                <td>
                  <ul class="nav ">
                       <div class="d-flex">
                            <button type="button" class="btn btn-link" onclick="convocationHandler({{$hand->id}})" style="font-size: 1rem;text-decoration:none;color:black;font-weight:600"> 
                                <span style="color:tomato"><i class="fas fa-envelope-open-text"></i></span>
                                Télécharger
                            </button>
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

     
      
@endsection --}}


@extends('layouts.template')

<x-pageHolder title="Convocation" icon="fas fa-envelope-open-text">
      @livewire('hands.hands-list',['actions'=>'convocation','paiementStatus'=>'all'])
      <x-convocation-form />
</x-pageHolder>