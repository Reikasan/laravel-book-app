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
                'isbn' => 'required|string|max:100',
            ]);
            
            if($inputs['book_id'] === 'null') {
                $book = $this->bookService->storeFetchedBook($inputs['isbn']);
                $inputs['book_id'] = $book->id;
            } 

            $inputs['user_id'] = auth()->id();
            unset($inputs['isbn']);
            
            $this->wishlistService->store($inputs);
            // Return a success message
            return response()->json(['message' => 'Successfully added to wishlist'], 200);
        } catch (\Exception $e) {
            // Return an error message
            return response()->json(['message' => 'Error: ' . $e->getMessage()], 500);
        }
    }
}