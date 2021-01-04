<div>
    @switch($job)
        @case('details')
            <select name="" id="" class="custom-select" onchange="window.location.href=this.value;">
                <option selected disabled >Action</option>
                <option value="{{route('hands.show', $hand->id)}}">Details</option>
                <option value=" {{route('hands.edit', $hand->id)}}">Modifier</option>
            </select>
            @break
        
        @case('attestation')
                <a class="btn btn-link" href="{{route('attestation.telecharger', [$hand->id, $type])}}" style="font-size: 1.4rem" style="font-size: 1.4rem; text-decoration:none"> 
                    <span style="color:rgb(56, 14, 243)"><i class="fas fa-file-download"></i></span> 
                    <span style="font-size: 0.9rem; font-weight:700; text-decoration:none; color:black">Attestation {{$type}}</span>
                </a>
            @break
        @case('decision')
            <a class="btn btn-link mx-auto" href="{{route('decision.telecharger', [$hand->id,$type])}}" style="font-size: 1.4rem"> 
                <span style="color:rgb(56, 14, 243)"><i class="fas fa-file-download"></i></span>
                <span style="font-size:0.9rem; font-weight:700">Télécharger</span>
              </a>
              @break

        @case('convocation')
            <ul class="nav ">
                <div class="d-flex">
                    <button type="button" class="btn btn-link" onclick="convocationHandler({{$hand->id}})" style="font-size: 1rem;text-decoration:none;color:black;font-weight:600"> 
                        <span style="color:tomato"><i class="fas fa-envelope-open-text"></i></span>
                        Télécharger
                    </button>
                </div>
            </ul>
            @break

        @case('dossierAnnuel')
            @if ($hand->renouvellementdossier->dossierRenouvelle == 0)
                <form action="{{route('renouvellement.DossierRemi', $hand->id)}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col">
                            <input type="date" name="dateRenouvelloment" id="" class="form-control input-sm" >

                        </div>
                        <div class="col">
                            <input type="submit" class="btn btn-outline-success btn-block btn-sm" value="Confirmé"> 

                        </div>
                    </div>
                </form>
            @else
               Dossier renouvelle {{ !empty($hand->renouvellementdossier->DateRenouvellement) ? 'le : ' . date('d/m/Y', strtotime($hand->renouvellementdossier->DateRenouvellement )) : '' }}
            @endif
            
            @break
    @endswitch
</div>