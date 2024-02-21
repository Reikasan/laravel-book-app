<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Services\BookService;

class BookController extends Controller
{
    private $bookService;

    public function __construct(BookService $bookService)
    {
        $this->bookService = $bookService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        $book = Book::findOrFail($book->id);
        return view('pages.book', ['book' => $book]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        //
    }

    public function searchByApi(Request $request)
    {
        $validated = $request->validate([
            'book-title' => 'required|string|max:100'
        ]);

        $bookTitle = $validated['book-title'];
        $books = $this->bookService->fetchBook('title', $bookTitle);

        return view('pages.books', [
            'books' => $books,
            'type' => 'fetch'
        ]);
    }

    

    public function showFetchedBook(Request $request)
    {
        $validated = $request->validate([
            'isbn' => 'string|max:100',
            'isbn13' => 'string|max:100'
        ]);

        $isbn = $validated['isbn'] != null ? $validated['isbn'] : $validated['isbn13']; 

        $book = $this->bookService->fetchBook('isbn', $isbn);
        return view('pages.book', ['book' => $book]);
    }
}
