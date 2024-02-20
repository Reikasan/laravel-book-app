<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class BookController extends Controller
{
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

    public function showFetchedBooks(Request $request)
    {
        $bookTitle = $request->input('book-title');
        $response = Http::get('https://www.googleapis.com/books/v1/volumes?q=' . $bookTitle);
        $books = $response->json();

        $formattedBooks = [];
        // dd($books['items']);
        foreach($books['items'] as $book) {
            $item = new Book();
            $item->title = $book['volumeInfo']['title'];
            $item->sub_title = isset($book['volumeInfo']['subtitle']) ? $book['volumeInfo']['subtitle'] : null;
            $item->authors = isset($book['volumeInfo']['authors']) ? implode(', ', $book['volumeInfo']['authors']) : null;
            $item->description = isset($book['volumeInfo']['description']) ? $book['volumeInfo']['description'] : null;
            $item->image_link = isset($book['volumeInfo']['imageLinks']['thumbnail']) ? $book['volumeInfo']['imageLinks']['thumbnail'] : null;
            $item->isbn =  isset($book['volumeInfo']['industryIdentifiers'][0]['identifier']) ? $book['volumeInfo']['industryIdentifiers'][0]['identifier'] : null;
            $item->isbn13 = isset($book['volumeInfo']['industryIdentifiers'][1]['identifier']) ? $book['volumeInfo']['industryIdentifiers'][1]['identifier'] : null;
            $item->language = isset($book['volumeInfo']['language']) ? $book['volumeInfo']['language'] : null;
            $item->page_count = isset($book['volumeInfo']['pageCount']) ? $book['volumeInfo']['pageCount'] : null;
            $item->publisher = isset($book['volumeInfo']['publisher']) ? $book['volumeInfo']['publisher'] : null;
            $item->published_date = isset($book['volumeInfo']['publishedDate']) ? $book['volumeInfo']['publishedDate'] : null;
            $item->category_id = isset($book['volumeInfo']['categories'])? $book['volumeInfo']['categories'][0] : null;
            $item->google_book_id = $book['id'];

            $formattedBooks[] = $item;
        }
        return view('pages.books', [
            'books' => $formattedBooks,
            'type' => 'fetch'
        ]);
    }
}
