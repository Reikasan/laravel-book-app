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

    public function index()
    {
        $wishlists = $this->wishlistService->getAll();
        $refreshByUpdatingWishlist = "true";
        return view('pages.wishlists', compact('wishlists', 'refreshByUpdatingWishlist'));
    }

    public function store(Request $request)
    {
        try {
            $inputs = $request->validate([
                'book_id' => 'string',
                'isbn' => 'nullable|string|max:100',
                'isbn13' => 'nullable|string|max:100',
                'asynchronous' => 'nullable|string',
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
            
            $savedItem = $this->wishlistService->store($inputs);

            if(isset($inputs['asynchronous'])) {
                return response()->json(['wishlistId' => $savedItem->id], 200);
            }
            
            return redirect()->route('books.show', ['book' => $book]);
        } catch (\Exception $e) {
            if(isset($inputs['asynchronous'])) {
                return response()->json(['message' => 'Error: ' . $e->getMessage()], 500);
            }
            dd($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Wishlist $wishlist)
    {
        try {
            if(!$this->wishlistService->isOwnedByUser($wishlist->id)) {
                return;
            }
            $this->wishlistService->destroy($wishlist);
            return response()->json(['success' => true], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error'. $e->getMessage()], 500);
        }
    }
}