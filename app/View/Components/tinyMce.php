<?php

namespace App\View\Components;

use Illuminate\View\Component;

class tinyMce extends Component
{

    public $name, $text;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $text)
    {
        $this->name = $name;
        $this->text = $text;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.tiny-mce');
    }
}
