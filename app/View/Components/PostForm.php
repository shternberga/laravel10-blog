<?php

namespace App\View\Components;

use Illuminate\View\Component;

class PostForm extends Component
{
    public $categories;
    public $post;
    public $isEdit;

    public function __construct($categories = [], $post = null)
    {
        $this->post = $post;
        $this->categories = $categories;
        $this->isEdit = $post != null;
    }

    public function render()
    {
        return view('components.post-form');
    }
}
