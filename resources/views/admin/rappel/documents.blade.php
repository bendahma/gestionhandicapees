@extends('layouts.template')

@section('DocumentsPaie')
    <div class="container-fluid">
       <div class="p-2 bg-light shadow mb-2 rounded">
         <h5>Traitement Du Rappel Des Handicapées Mandatés</h5>

       </div>
        <div class="card shadow">
            <div class="card-header">
               Les Documents du chapitre 46-15 article U
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-lg-2">
                 <h5 class="pt-2" style="color:black;font-weight:600">Engagement 46-15</h5>
                </div>
                <div class="col-lg-2">
                  <button class="btn btn-primary btn-block" data-toggle="modal" data-target="#engagementPaiementRappel"><i class="fas fa-download"></i> Télécharger</button>
                  <form action=" {{route('rappel.download')}} " method="POST" id="">
                    @csrf
                    <div class="modal fade" id="engagementPaiementRappel" tabindex="-1" role="dialog" aria-labelledby="engagementPaiementRappelTitle" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id=""></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                              <div class="row">
                                <div class="col">
                                  <div class="form-group">
                                      <label for="" class="font-weight-bold text-right">Montant Rappel(46-15)</label>
                                      <input type="text" name="montantRappelDecision" id="" class="form-control">
                                  </div>
                                </div>      
                                <input type="hidden" name="document" value="decision">
                              </div> 
                              <div class="row">
                                <div class="col">
                                   <div class="form-group">
                                     <label for="" class="font-weight-bold text-right">Périod</label>
                                     <input type="text" name="periodDecision" id="" class="form-control" dir="rtl">
                                 </div>
                                 </div>      
                              </div>
                              
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annulé</button>
                            <button type="submit" class="btn btn-danger">OK</button>
                            </div>
                        </div>
                        </div>
                    </div>
                  </form>          
                </div>
                <div class="col-lg-2">
                  <h5 class="pt-2" style="color:black;font-weight:700">Mondate 46-15</h5>
                </div>
                <div class="col-lg-2">
                   <a href="{{route('paie.mondate', 'Paiement')}}" class="btn btn-primary btn-block"><i class="fas fa-download"></i> Télécharger</a>
                </div>
               </div>
               <div class="row mt-3">
                  <div class="col-lg-2">
                    <h5 class="pt-2" style="color:black;font-weight:700">Etat Paiement</h5>
                  </div>
                  <div class="col-lg-2">
                     <a href="{{route('paie.export')}}" class="btn btn-primary btn-block"><i class="fas fa-download"></i> Télécharger</a>
                  </div>
                  <div class="col-lg-2">
                     <h5 class="pt-2" style="color:black;font-weight:700">Répartition</h5>
                   </div>
                   <div class="col-lg-2">
                      <a href="{{route('paie.repartition')}}" class="btn btn-primary btn-block"><i class="fas fa-download"></i> Télécharger</a>
                   </div>
                   <div class="col-lg-2">
                     <h5 class="pt-2" style="color:black;font-weight:700">Décision</h5>
                   </div>
                   <div class="col-lg-2">
                      <button class="btn btn-primary btn-block" data-toggle="modal" data-target="#decisionRappel"><i class="fas fa-download"></i> Télécharger</button>
                      <form action=" {{route('rappel.download')}} " method="POST" id="">
                        @csrf
                        <div class="modal fade" id="decisionRappel" tabindex="-1" role="dialog" aria-labelledby="decisionRappelTitle" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="">Données du paiement du CF et Trésorier</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <div class="modal-body">
                                  <div class="row">
                                    <div class="col">
                                      <div class="form-group">
                                          <label for="" class="font-weight-bold text-right">Montant Rappel</label>
                                          <input type="text" name="montantRappelDecision" id="" class="form-control">
                                      </div>
                                    </div>      
                                    <input type="hidden" name="document" value="decision">
                                  </div> 
                                  <div class="row">
                                    <div class="col">
                                       <div class="form-group">
                                         <label for="" class="font-weight-bold text-right">Périod</label>
                                         <input type="text" name="periodDecision" id="" class="form-control" dir="rtl">
                                     </div>
                                     </div>      
                                  </div>
                                </div>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annulé</button>
                                <button type="submit" class="btn btn-danger">OK</button>
                                </div>
                            </div>
                            </div>
                        </div>
                      </form>                    
                   </div>
               </div>
            </div>
        </div>
        <div class="card shadow mt-3">
              <div class="card-header">
                  La paperasse du chapitre 33-13 article 02
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-lg-2">
                    <h5 class="pt-2" style="color:black;font-weight:600">Engagement 33-13</h5>
                  </div>
                  <div class="col-lg-2">
                    <a href="{{route('paie.engagement', 'Assurance')}}" class="btn btn-primary btn-block"><i class="fas fa-download"></i> Télécharger</a>
                  </div>
                  <div class="col-lg-2">
                    <h5 class="pt-2" style="color:black;font-weight:700">Mondate 33-13</h5>
                  </div>
                  <div class="col-lg-2">
                      <a href="{{route('paie.mondate', 'Assurance')}}" class="btn btn-primary btn-block"> <i class="fas fa-download"></i> Télécharger</a>
                  </div>
                  
                  </div>
                  <div class="row mt-3">
                    <div class="col-lg-2">
                      <h5 class="pt-2" style="color:black;font-weight:700">Bordereau Cnas</h5>
                    </div>
                    <div class="col-lg-2">
                        <a href="{{route('paie.Cnas', 'BORDEREAU')}}" class="btn btn-primary btn-block"><i class="fas fa-download"></i>Télécharger</a>
                    </div>
                    <div class="col-lg-2">
                        <h5 class="pt-2" style="color:black;font-weight:700">Cotisation Cnas</h5>
                      </div>
                      <div class="col-lg-2">
                        <a href="{{route('paie.Cnas', 'COTISATION')}}" class="btn btn-primary btn-block"><i class="fas fa-download"></i>Télécharger</a>
                      </div>
                      <div class="col-lg-2">
                        <h5 class="pt-2" style="color:black;font-weight:700">Avis Virement</h5>
                      </div>
                      <div class="col-lg-2">
                        <a href="{{route('paie.Cnas', 'AVIS')}}" class="btn btn-primary btn-block"><i class="fas fa-download"></i>Télécharger</a>
                      </div>
                  </div>
              </div>
        </div>
        <div class="card shadow mt-3">
                <div class="card-header">
                  La Bordereaux & jounales
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-2">
                        <h5 class="pt-2" style="color:black;font-weight:700">Bordereau CF</h5>
                        </div>
                        <div class="col-lg-2">
                          <a href="{{route('paie.BordereauCf')}}" class="btn btn-primary btn-block"><i class="fas fa-download"></i> Télécharger</a>
                        </div>
                        <div class="col-lg-2">
                          <h5 class="pt-2" style="color:black;font-weight:700">Bordereau CD</h5>
                        </div>
                        <div class="col-lg-2">
                          <a href="{{route('paie.BordereauCD')}}" class="btn btn-primary btn-block"><i class="fas fa-download"></i> Télécharger</a>
                        </div>
                        <div class="col-lg-2">
                          <h5 class="pt-2" style="color:black;font-weight:700">Journal</h5>
                        </div>
                        <div class="col-lg-2">
                          <a href="{{route('paie.Journal')}}" class="btn btn-primary btn-block"><i class="fas fa-download"></i> Télécharger</a>
                        </div>
                    </div>
                 </div>
        </div>
    </div>
@endsection