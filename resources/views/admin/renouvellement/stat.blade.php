@extends('layouts.template')

@section('statRenouvellement')

    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Statistique du Renouvellement des Dossiers Annuel Pour l'Année </h1>
         </div>

        <div class="row">
            <div class="col-xl-4 col-md-6 mb-4">
              <div class="card border-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-sm font-weight-bold text-primary text-uppercase mb-1">Nombre Des Handicapées <br /> Mondate </div>
                      <div class="h4 mb-0 font-weight-bold text-gray-800">
                         {{$hands->count()}}
                      </div>
                    </div>
                    <div class="col-auto">
                     <i class="fas fa-wheelchair fa-3x"></i>
                  </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-md-6 mb-4">
              <div class="card border-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-sm font-weight-bold text-primary text-uppercase mb-1">Nombre des dossiers <br /> renouvellé</div>
                      <div class="h4 mb-0 font-weight-bold text-gray-800">
                         {{$renouvelle}}
                      </div>
                    </div>
                    <div class="col-auto">
                     <i class="fas fa-user-clock fa-3x"></i>
                  </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-md-6 mb-4">
               <div class="card border-danger shadow h-100 py-2">
                  <div class="card-body">
                     <div class="row no-gutters align-items-center">
                     <div class="col mr-2">
                        <div class="text-sm font-weight-bold text-primary text-uppercase mb-1">Nombre des dossiers  <br />non renouvellé</div>
                        <div class="h4 mb-0 font-weight-bold text-gray-800">
                           {{$hands->count() - $renouvelle}}
                        </div>
                     </div>
                     <div class="col-auto">
                        <i class="fas fa-user-slash fa-3x"></i>
                     </div>
                     </div>
                  </div>
               </div>
            </div>
        </div>

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Renouvellement Des Dossiers Annuel Par Commune </h1>
        </div>
        <div class="card shadow mb-4">
         <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Statistique Par Commune</h6>
          </div>
         <div class="card-body">
           <div class="table-responsive">
             <table class="table table-bordered" width="100%" cellspacing="0" id="">
               <thead>
                 <tr>
                   <th>Commune</th>
                   <th>Nombre des mondates</th>
                   <th>Nombre des renouvelle</th>
                   <th>Nombre des non renouvelle</th>
                   <th>Action</th>
                 </tr>
               </thead>
               <tbody>
                 @php
                     $j=0;
                 @endphp
                  @for ($i = 4601; $i<=4628;$i++)
                    <tr>
                      <td>
                        {{$communes[$j]->nomCommuneFr}}
                      </td>
                      <td>{{$handsGrp[$i]->count()}}</td>
                      <td>{{$HandRen[$i]->count()}}</td>
                      <td>{{$handsGrp[$i]->count() - $HandRen[$i]->count()}}</td>
                      <td>
                        @if (Auth::user()->role == 'admin')
                          <form action="{{route('renouvellement.suspendu')}}" method="POST">
                            @csrf
                            <input type="hidden" name="codeCommune" value='{{$communes[$j]->codeCommune}}'>
                            <input type="hidden" name="dateSuspension" value="{{date('Y-m').'-01'}}">
                            <input type="submit" value="Suspendu" class="btn btn-danger btn-block">
                          </form>
                        @endif
                      </td>
                    </tr>
                    @php
                        $j++;
                    @endphp
                  @endfor
                   
               </tbody>
             </table>
           </div>
         </div>
       </div>        
     
    </div>
       
    
    <br><br><br><br>
@endsection