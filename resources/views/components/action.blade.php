<div>
    @switch($job)
        @case('details')
            <select class="custom-select" onchange="window.location.href=this.value;">
                <option selected disabled >Action</option>
                <option value="{{route('hands.show', $hand->id)}}"><i class="fas fa-bars mr-1"></i> Details</option>
                <option value="{{route('hands.edit', $hand->id)}}"><i class="fas fa-user-edit"></i> Modifier</option>
            </select>
            @break
        
        @case('attestation')
                <a class="btn btn-outline-success border-0" href="{{route('attestation.telecharger', [$hand->id, $type])}}" style="font-size: 1.4rem" style="font-size: 1.4rem; text-decoration:none"> 
                    <span style=""><i class="fas fa-file-download"></i></span> 
                    <span style="font-size: 0.9rem; font-weight:700; text-decoration:none; color:black">Attestation {{$type}}</span>
                </a>
            @break
        @case('decision')
            <a class="btn btn-outline-success border-0 mx-auto" href="{{route('decision.telecharger', [$hand->id,$type])}}" style="font-size: 1.4rem"> 
                <span style=""><i class="fas fa-file-download"></i></span>
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