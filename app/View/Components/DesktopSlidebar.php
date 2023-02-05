<?php

namespace App\View\Components;

use Illuminate\View\Component;

class DesktopSlidebar extends Component
{
    public $from;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($from = '')
    {
        $this->from = $from;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.desktop-slidebar');
    }
}
