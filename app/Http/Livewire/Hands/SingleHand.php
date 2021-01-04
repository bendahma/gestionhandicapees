<?php

namespace App\Http\Livewire\Hands;

use Livewire\Component;

class SingleHand extends Component
{


    public $hand;

    public function render()
    {
        return view('livewire.hands.single-hand');
    }
}
