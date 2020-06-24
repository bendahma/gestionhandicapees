@extends('layouts.template')


@section('listAttestation')
    <!-- Begin Page Content -->
    <div class="container-fluid">


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
              <th>Nature</th>
              <th>CCP</th>
              <th>Statut</th>
              <th>Téléchargé</th>
              
            </tr>
          </thead>
          <tbody>
            @foreach ($hands as $hand)
              <tr>
                <td>{{$hand->nameFr}}</td>
                <td>{{date('d/m/Y', strtotime($hand->dob))}}</td>
                <td>{{$hand->cartehand->natureHandFr}}</td>
                <td>{{$hand->paieinformation->CCP}}</td>
                <td>
                  <a href="{{$hand->status->status != 'En cours' ? route('hand.suspendu', $hand->id) : '#'}}">
                    {{$hand->status->status}}
                  </a>
                </td>
                @if($type == 'paiement')
                    <td>
                      <a class="btn btn-link" href="{{route('attestation.telecharger', [$hand->id, 'paiement'])}}" style="font-size: 1.4rem" style="font-size: 1.4rem; text-decoration:none"> 
                        <span style="color:rgb(56, 14, 243)"><i class="fas fa-file-download"></i></span> 
                        <span style="font-size: 0.9rem; font-weight:700; text-decoration:none; color:black">Attestation</span></a>
                    </td>
                @else
                    <td>
                      <a class="btn btn-link" href="{{route('attestation.telecharger', [$hand->id, 'desistement'])}}" style="font-size: 1.4rem; text-decoration:none"> 
                        <span style="color:rgb(13, 245, 52)"><i class="fas fa-file-download"></i></span> 
                        <span style="font-size: 0.9rem; font-weight:700; text-decoration:none; color:black">Désistement</span> </a>
                    </td>
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