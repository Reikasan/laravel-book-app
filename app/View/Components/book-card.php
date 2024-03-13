<?php

namespace App\View\Components;

use App\Services\BookService;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class bookCard extends Component
{
    private $book;
    private $bookService;

    /**
     * Create a new component instance.
     */
    public function __construct($book, BookService $bookService)
    {
        $this->book = $book;
        $this->bookService = $bookService;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.book-card', [
            'book' => $this->book,
            'isBookReviewedByUser' => $this->bookService->isBookReviewedByUser($this->book->id),
        ]);
    }
}
