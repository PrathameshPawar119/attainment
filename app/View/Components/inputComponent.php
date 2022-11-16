<?php

namespace App\View\Components;

use Illuminate\View\Component;

class inputComponent extends Component
{

    public $type;
    public $name;
    public $id;
    public $label;
    public $mainclass;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($type, $name, $id, $label, $mainclass)
    {
        $this->type = $type;
        $this->name = $name;
        $this->id = $id;
        $this->label = $label;
        $this->mainclass = $mainclass;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.input-component');
    }
}
