<?php 
namespace App\Repositories;

use App\Models\Wishlist;

class WishlistRepository
{
    public function getAll()
    {
        return Wishlist::where('user_id', auth()->id())
                        ->orderBy('created_at', 'desc')
                        ->get();
    }

    public function store(array $data)
    {
        return Wishlist::create($data);
    }

    public function destroy(object $wishlist)
    {
        return $wishlist->delete();
    }

    public function isOwnedByUser(int $wishlistId)
    {
        return Wishlist::where('id', $wishlistId)
                        ->where('user_id', auth()->id())
                        ->exists();
    }

    public function destroyByBookId(int $bookId): int
    {
        return Wishlist::where([
                            'book_id' => $bookId,
                            'user_id' => auth()->id()
                        ])->delete();
    }
}