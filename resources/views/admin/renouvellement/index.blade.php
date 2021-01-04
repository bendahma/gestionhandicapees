{{-- @extends('layouts.template')


@section('history')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
          <h1 class="h3 mb-0 text-gray-800">Renouvellement Dossier Annuel Des Handicapées Mondate</h1>
          <a href="{{route('renouvellement.intia')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Debut de Renouvellement</a>
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
              <th>Date Renouvelement</th>
              <th>Confirmé</th>
              
            </tr>
          </thead>
          <tbody>
            @foreach ($hands as $hand)
              <tr>
                <td></td>
                <td>{{$hand->nameFr}}</td>
                <td >{{date('d/m/Y', strtotime($hand->dob))}}</td>
                
                  <form action="{{route('renouvellement.DossierRemi', $hand->id)}}" method="POST">
                      @csrf
                      @method('PUT')
                      <td>
                        <input type="date" name="dateRenouvelloment" id="" class="form-control" value="{{date('d/m/Y')}}" >
                      </td>
                      <td>
                        <input type="submit" class="btn btn-success btn-block " value="Confirmé"> 
                      </td>
                  </form>
               
              </tr>
            @endforeach
            
          </tbody>
        </table>
      </div>
    </div>
  </div>        

      </div>
      
@endsection --}}


@extends('layouts.template')
<!-- Page Heading -->


<x-pageHolder title="Renouvellement Dossier Annuel" icon="far fa-file-alt">
     <x-slot name="topAction">
        <a href="{{route('renouvellement.intia')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Debut de Renouvellement</a>
    </x-slot>
     @livewire('hands.hands-list',['actions'=>'dossierAnnuel','paiementStatus'=>'mondate'])
</x-pageHolder>