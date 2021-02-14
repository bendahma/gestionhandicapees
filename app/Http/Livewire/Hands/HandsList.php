<?php

namespace App\Http\Livewire\Hands;

use Livewire\Component;
use Livewire\WithPagination;

use App\Hand;

class HandsList extends Component
{
    use WithPagination;
 
    protected $listeners = ['refrsh'=>'$refresh'];

    public $paiementStatus = '';
    public $searchHand = '';
    public $dateNaiss = '';
    public $actions;
    public $commune = '';
    public $type = '';
    public $perPage = 10;
    // public $hands = [];
    public function mount($actions,$type = null){
        $this->actions = $actions;
        $this->type = $type;
        
    }


    public function videRecherche(){
        $this->searchHand = '';
        $this->dateNaiss = '';
        $this->commune = '';
        $this->perPage = 10;
        $this->emit('newfocus');
        $this->emit('refrsh');
    }

    public function render()
    {

        $hands = $this->paiementStatus == 'suspendu' ? Hand::search($this->searchHand,$this->dateNaiss,$this->commune)->with(['status','paieinformation','renouvellementdossier'])->onlyTrashed()->paginate($this->perPage)
                                                     : ($this->paiementStatus == 'mondate' ? Hand::search($this->searchHand,$this->dateNaiss,$this->commune)->with(['status','paieinformation','renouvellementdossier'])->paginate($this->perPage)
                                                                                           : Hand::search($this->searchHand,$this->dateNaiss,$this->commune)->with(['status','paieinformation','renouvellementdossier'])->withTrashed()->paginate($this->perPage));
        $this->emit('focusDateRenouvellement');
        return view('livewire.hands.hands-list')->with('hands',$hands);
    }
}
