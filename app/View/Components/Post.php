<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Post extends Component
{

    public $username;
    public $title;
    public $image;
    public $body;
    public $isLink;
    public $postId;
    /**
     * Create a new component instance.
     */
    public function __construct($username, $title, $image, $body, $isLink = false, $postId = null)
    {
        $this->username = $username;
        $this->title = $title;
        $this->image = $image;
        $this->body = $body;
        $this->isLink = $isLink;
        $this->postId = $postId;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.post');
    }
}