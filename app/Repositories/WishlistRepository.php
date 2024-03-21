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
}