<?php

namespace App\View\Components;

use Illuminate\View\Component;

class vinput extends Component
{

    public $type;
    public $name;
    public $id;
    public $label;
    public $mainclass;
    public $value;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($type, $name, $id, $label, $mainclass, $value)
    {
        $this->type = $type;
        $this->name = $name;
        $this->id = $id;
        $this->label = $label;
        $this->mainclass = $mainclass;
        $this->value = $value;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.vinput');
    }
}
