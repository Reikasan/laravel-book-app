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
        $bookTitle = $request->input('book-title');
        $books = $this->bookService->fetchBook('title', $bookTitle);
        $books = $this->bookService->mapBooksFromApi($books);

        return view('pages.books', [
            'books' => $books,
            'type' => 'fetch'
        ]);
    }

    

    public function showFetchedBook(Request $request)
    {

        $isbn = $request->input('isbn') != null ? $request->input('isbn') : null; 

        $book = $this->bookService->fetchBook('isbn', $isbn);
        $book = $this->bookService->mapBooksFromApi($book);

        return view('pages.book', ['book' => $book]);
    }
}
