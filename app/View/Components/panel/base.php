<?php

namespace App\View\Components\panel;

use Illuminate\Support\Facades\File;
use Illuminate\View\Component;

class base extends Component
{
    public $panelRoutes;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->panelRoutes = json_decode(File::get(storage_path() . "/app/routes.json"));
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.panel.base');
    }
}
