<?php

namespace App\Services;

use App\Repositories\WishlistRepository as RepositoriesWishlistRepository;

class WishlistService 
{
    private $wishlistRepository;

    public function __construct(RepositoriesWishlistRepository $wishlistRepository)
    {
        $this->wishlistRepository = $wishlistRepository;
    }

    public function getAll()
    {
        return $this->wishlistRepository->getAll();
    }

    public function store(array $data)
    {
        return $this->wishlistRepository->store($data);
    }

    public function destroy(object $wishlist)
    {
        return $this->wishlistRepository->destroy($wishlist);
    }

    public function isOwnedByUser(int $wishlistId): bool
    {
        return $this->wishlistRepository->isOwnedByUser($wishlistId);
    }
}