

<h4 class="text-danger font-weight-bold">Les informations Du Rappel</h3>
    <hr>
    <div class="row mt-1">
        <div class="col">
            <div class="form-group">
                <label for="name" class="font-weight-bold">Date Debut</label>
                <input type="date" class="form-control" required id="name" name="dateDebut" placeholder="Date Debut Rappel ..." value="{{isset($rappel) ? $rappel->DateDebut : ''}}">
              </div>
         </div>
        <div class="col">
            <div class="form-group">
                <label for="" class="font-weight-bold">Date Fin</label>
                <input type="date" class="form-control" id="" name="dateFin" placeholder="Date Fin Rappel ..." value="{{ isset($rappel) ? $rappel->DateFin : '' }}">
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
       <div class="col">
         <div class="form-group">
             <label for="" class="font-weight-bold">Obs</label>
             <textarea name="obs" id="" cols="30" rows="5" class="form-control">
                {{isset($hand) ? $hand->obs : ''}}
             </textarea>
         </div>
      </div>
   </div>
