<?php

namespace App\View\Components;

use Illuminate\View\Component;

class BlogLayout extends Component
{
    public $categories;

    public function __construct($categories)
    {
        $this->categories = $categories;
    }

    public function render()
    {
        return view('components.blog-layout');
    }
}
