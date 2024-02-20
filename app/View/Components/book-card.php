<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class bookCard extends Component
{
    public $book;
    public $type;

    /**
     * Create a new component instance.
     */
    public function __construct($book, $type)
    {
       $this->book = $book; 
       $this->type = $type;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.book-card', [
            'book' => $this->book,
            'type' =>$this->type
        ]);
    }
}
