<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Hand;

class action extends Component
{
    
    public $hand ;
    public $id;
    public $job;
    public $type="";
    public function __construct($id,$job,$type = null)
    {
        $this->job = $job;
        $this->type= $type;
        $this->id = $id;
        $this->hand = Hand::withTrashed()->where('id',$this->id)->first();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.action');
    }
}
