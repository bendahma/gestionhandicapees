<form action="{{route('paie.updateCfTresorData')}}" method="POST" id="">
    @csrf
    <div class="modal fade" id="donneeCFTresorForm" tabindex="-1" role="dialog" aria-labelledby="MenthlyStatModelTitle" aria-hidden="true">
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
                      <label for="" class="font-weight-bold text-right">N° Engagement Paie</label>
                      <input type="number" name="NumEngagementPaie" id="" class="form-control">
                  </div>
                </div>      
                <div class="col">
                  <div class="form-group">
                    <label for="" class="font-weight-bold text-right">N° ENgagement Assurance</label>
                    <input type="number" name="NumEngagementAssurance" id="" class="form-control">
                </div>
                </div>      
              </div> 
              <div class="row">
                <div class="col">
                  <div class="form-group">
                      <label for="" class="font-weight-bold text-right">Date Engagement</label>
                      <input type="date" name="dateEngagement" id="" class="form-control">
                  </div>
                </div>      
              </div> 
              <div class="row">
                <div class="col">
                  <div class="form-group">
                      <label for="" class="font-weight-bold text-right">N° Mondate Paie</label>
                      <input type="number" name="NumMondatePaie" id="" class="form-control">
                  </div>
                </div>      
                <div class="col">
                  <div class="form-group">
                    <label for="" class="font-weight-bold text-right">N° Mondate Assurance</label>
                    <input type="number" name="NumMondateAssurance" id="" class="form-control">
                </div>
                </div>      
              </div> 
              <div class="row">
                <div class="col">
                  <div class="form-group">
                      <label for="" class="font-weight-bold text-right">Date Mondate</label>
                      <input type="date" name="dateMondate" id="" class="form-control">
                  </div>
                </div>      
              </div> 
             <input type="hidden" name="moisPaiement" value="{{date('m')}}">
             <input type="hidden" name="anneePaiement" value="{{date('Y')}}">
               
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annulé</button>
            <button type="submit" class="btn btn-danger">OK</button>
            </div>
        </div>
        </div>
    </div>
  </form>
