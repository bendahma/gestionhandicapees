<form action="" method="POST" id="MenthlyStatistics">
    @csrf
    <div class="modal fade" id="MenthlyStatModel" tabindex="-1" role="dialog" aria-labelledby="MenthlyStatModelTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="">Statistique Des Handicapées Suspendu</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col">
                  <div class="form-group">
                      <label for="" class="font-weight-bold text-right">Mois Paiement</label>
                      <select name="moisPaie" id="" class="form-control">
                          <option value="01">Janvier</option>
                          <option value="02">Fevrier</option>
                          <option value="03">Mars</option>
                          <option value="04">Avril</option>
                          <option value="05">Mai</option>
                          <option value="06">Juin</option>
                          <option value="07">Juil</option>
                          <option value="08">Aout</option>
                          <option value="09">Septembre</option>
                          <option value="10">Novembre</option>
                          <option value="11">Octobre</option>
                          <option value="12">Decembre</option>
                      </select>
                  </div>
                </div>      
                <div class="col">
                  <div class="form-group">
                    <label for="" class="font-weight-bold text-right">Annee </label>
                    <input type="text" name="AnneePaie" id="" class="form-control">
                  </div>
                </div>  
                <div class="col">
                  <div class="form-group">
                    <label for="" class="font-weight-bold text-right">Date du mondate</label>
                    <input type="date" name="dateMondate" id="" class="form-control">
                  </div>
                </div>      
              </div> 
                <div class="row">
                  <div class="col">
                    <div class="form-group">
                        <label for="" class="font-weight-bold text-right">Date Debut</label>
                        <input type="date" name="dateDebutStat" id="" class="form-control">
                    </div>
                  </div>      
                  <div class="col">
                    <div class="form-group">
                      <label for="" class="font-weight-bold text-right">Date Fin</label>
                      <input type="date" name="dateFinStat" id="" class="form-control">
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
