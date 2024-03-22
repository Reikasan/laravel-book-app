<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use Illuminate\Http\Request;
use App\Models\Wishlist;
use App\Services\WishlistService;
use App\Services\BookService;
use App\Models\Book;


class WishlistController extends Controller
{
    private $bookService;
    private $wishlistService;

    public function __construct(
        BookService $bookService, 
        WishlistService $wishlistService)
    {
        $this->bookService = $bookService;
        $this->wishlistService = $wishlistService;
    }

    public function store(Request $request)
    {
        try {
            $inputs = $request->validate([
                'book_id' => 'string',
                'isbn' => 'nullable|string|max:100',
                'isbn13' => 'nullable|string|max:100',
            ]);
            
            if(!isset($inputs['book_id'])) {
                $isbn = $inputs['isbn'] ? $inputs['isbn'] : $inputs['isbn13'];
                $book = $this->bookService->storeFetchedBook($isbn);
                $inputs['book_id'] = $book->id;
            } else {
                $book = $this->bookService->getBookById($inputs['book_id']);
            }

            $inputs['user_id'] = auth()->id();
            unset($inputs['isbn']);
            unset($inputs['isbn13']);
            
            $this->wishlistService->store($inputs);
            // Return a success message
            // return response()->json(['message' => 'Successfully added to wishlist'], 200);
            return redirect()->route('books.show', ['book' => $book]);
        } catch (\Exception $e) {
            // Return an error message
            // return response()->json(['message' => 'Error: ' . $e->getMessage()], 500);
        dd($e->getMessage());
        }
    }
}