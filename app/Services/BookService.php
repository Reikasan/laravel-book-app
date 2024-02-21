<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use App\Models\Book;

class BookService
{
    public function __construct()
    {

    }

    /**
     * Fetch book from Google Books API
     */
    public function fetchBook(string $type, string $keyword)
    {
        if($type === 'isbn') {
            $response = Http::get('https://www.googleapis.com/books/v1/volumes?q=isbn:' . $keyword . '&maxResults=40');
        } else {
            $keyword = $this->cleanKeyword($keyword);
            $response = Http::get('https://www.googleapis.com/books/v1/volumes?q=' . $keyword . '&maxResults=40');
        }
        $books = $response->json();
        $books = $this->mapBooksFromApi($books['items']);
        return $type === 'isbn' ? $books[0] : $books;
    }

    private function cleanKeyword(string $keyword): string
    {
        $keyword = str_replace(['+', '-', '&', '|', '!', '(', ')', '{', '}', '[', ']', '^', '~', '*', '?', ':', '\\'], '', $keyword);
        $keyword = preg_replace('/\s+/', ' ', $keyword);
        return str_replace(' ', '+', $keyword);
    }

    public function mapBooksFromApi(array $books): array
    {
        $mappedBooks = [];
        
        foreach($books as $book) {
            if(!isset($book['volumeInfo']['title']) || !isset($book['volumeInfo']['authors'])) {
                continue;
            }

            $item = new Book();
            $item->title = $book['volumeInfo']['title'];
            $item->sub_title = isset($book['volumeInfo']['subtitle']) ? $book['volumeInfo']['subtitle'] : null;
            $item->authors = implode(', ', $book['volumeInfo']['authors']);
            $item->description = isset($book['volumeInfo']['description']) ? $book['volumeInfo']['description'] : null;
            $item->image_thumbnail = isset($book['volumeInfo']['imageLinks']['thumbnail']) ? $book['volumeInfo']['imageLinks']['thumbnail'] : null;
            $item->image_large = isset($book['volumeInfo']['imageLinks']['medium']) ? $book['volumeInfo']['imageLinks']['medium'] : null;
            $item->isbn =  isset($book['volumeInfo']['industryIdentifiers'][0]['identifier']) ? $book['volumeInfo']['industryIdentifiers'][0]['identifier'] : null;
            $item->isbn13 = isset($book['volumeInfo']['industryIdentifiers'][1]['identifier']) ? $book['volumeInfo']['industryIdentifiers'][1]['identifier'] : null;
            $item->language = isset($book['volumeInfo']['language']) ? $book['volumeInfo']['language'] : null;
            $item->page_count = isset($book['volumeInfo']['pageCount']) ? $book['volumeInfo']['pageCount'] : null;
            $item->publisher = isset($book['volumeInfo']['publisher']) ? $book['volumeInfo']['publisher'] : null;
            $item->published_date = isset($book['volumeInfo']['publishedDate']) ? $book['volumeInfo']['publishedDate'] : null;
            $item->categories = isset($book['volumeInfo']['categories'])? $book['volumeInfo']['categories'][0] : null;
            $item->google_book_id = $book['id'];

            $mappedBooks[] = $item;
        }
        return $mappedBooks;
    }
}