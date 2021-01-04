<div>
        <td>{{$hand->id}}</td>
        <td>{{$hand->nameFr}}</td>
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
            <ul class="nav">
                 <div class="d-flex">
                    <a class="btn btn-link" href="{{route('hands.show', $hand->id)}}" style="font-size: 1.5rem" target="_blank"> <span style="color:rgb(7, 60, 233)"><i class="far fa-eye"></i></span> </a>
                    <a class="btn btn-link" href="{{route('hands.edit', $hand->id)}}" style="font-size: 1.5rem" target="_blank"> <span style="color:rgb(14, 243, 91)"><i class="fas fa-user-edit "></i></span></a>
                    @if (Auth::user()->isAdmin() && $hand->status->status == 'En cours')
                      <button type="button" class="btn btn-link" onclick="deleteHandaler({{$hand->id}})" style="font-size: 1.5rem"> <span style="color:tomato"><i class="far fa-trash-alt"></i></span></button>
                    @endif
                  </div>
            </ul>
          </td>
       
</div>
