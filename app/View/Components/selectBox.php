<?php

namespace App\View\Components;

use Illuminate\View\Component;

class selectBox extends Component
{
    public $parameters;
    public $ids;  
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($parameters, $ids)
    {
        $this->parameters = $parameters;
        $this->ids = $ids;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.select-box');
    }
}
