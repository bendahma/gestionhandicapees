@extends('layouts.template')


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
        <table class="table table-bordered" id="dataTableRe" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Nom & Prenom</th>
              <th>Date Naissance</th>
              <th>CCP</th>
              <th>Statut</th>
              <th>Date Renouvelement</th>
              <th>Confirmé</th>
              
            </tr>
          </thead>
          <tbody>
            @foreach ($hands as $hand)
              <tr>
                <td>{{$hand->nameFr}}</td>
                <td > <span style="max-width: 100px">{{date('d/m/Y', strtotime($hand->dob))}}</span></td>
                <td>{{$hand->paieinformation->CCP}}</td>
                <td>
                  <a href="{{$hand->status->status != 'En cours' ? route('hand.suspendu', $hand->id) : '#'}}">
                    {{$hand->status->status}}
                  </a>
                </td>
                @if($hand->renouvellementdossier->dossierRenouvelle == 0)
                <form action="{{route('renouvellement.DossierRemi', $hand->id)}}" method="POST">
                    @csrf
                    @method('PATCH')
                    <td>
                      <input type="date" name="dateRenouvelloment" id="" class="form-control" value="{{date('d/m/Y')}}" >
                    </td>
                    <td>
                      <input type="submit" class="btn btn-success btn-block " value="Confirmé"> 
                    </td>
                </form>
                @else
                <td> {{$hand->renouvellementdossier->DateRenouvellement}} </td>
                <td style="font-weight: 600">Dossier Annuel Déjà Renouvelle</td>

               @endif
              </tr>
            @endforeach
            
          </tbody>
        </table>
      </div>
    </div>
  </div>        

      </div>
      
@endsection