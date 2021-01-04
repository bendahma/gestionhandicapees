<div class="">
    <div class="row mb-3">
        <div class="col-lg-3">
            <input type="date" name="" id="" wire:model.bounce.200ms="dateNaiss" class="form-control">
        </div>
        <div class="col-lg-3">
            <input type="text" name="" id="" placeholder="Recherche ..." wire:model.bounce.0ms="searchHand" class="form-control">
        </div>
        <div class="col-lg-3">
            <x-list-commune />
        </div>
        <div class="col-lg-1">
            <select class="custom-select" wire:model.bounce.0ms="perPage">
                  <option value="10">10</option>
                  <option value="100">100</option>
                  <option value="500">500</option>
                  <option value="1000">1000</option>
                  <option value="10000">Tous</option>
            </select>
        </div>
        <div class="col-lg-2">
            <button wire:click="videRecherche" class="btn btn-outline-success">Vide Recherche</button>
        </div>
    </div>
    <hr>
  <div class="table-responsive">
    <table class="table table-bordered" id="" width="100%" cellspacing="0">
      <thead>
        <tr>
          <th>N°</th>
          <th>Nom & Prenom</th>
          <th>Date Naissance</th>
          <th>CCP</th>
          <th>La Paie</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($hands as $n => $hand)
          <tr>
              <td>{{$n = $n + 1}}</td>
            <td>
                @if (Auth::user()->isAdmin() && $hand->status->status == 'En cours')
                    <button type="button" class="btn btn-link mx-0" onclick="deleteHandaler({{$hand->id}})" style="font-size: 1rem"> 
                        <span style="color:tomato"><i class="far fa-trash-alt"></i></span>
                    </button>
                @endif
                {{$hand->nameFr}}
            </td>
            <td>{{date('d/m/Y', strtotime($hand->dob))}}</td>
            <td>{{isset($hand->paieinformation->CCP) ? $hand->paieinformation->CCP : ''}}</td>
            <td>
                  <a href="{{$hand->status->status == 'En cours' 
                                  ? route('historique.HistoriquePaie',$hand->id) 
                                  : route('hand.suspendu', $hand->id) }}" target="_blank">
                    {{$hand->status->status}}
                  </a>
            </td>
            <td>
             <x-action id="{{$hand->id}}" :job="$actions" :type="$type" />
            </td>
          </tr>
        @endforeach
      </tbody> 
    </table>
            {{-- {{$hands->links('vendor.pagination.bootstrap-4')}} --}}
            {{$hands->links('vendor.pagination.simple-arrow-pagination')}}
  </div>
</div>
        