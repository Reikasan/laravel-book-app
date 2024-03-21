<?php

namespace App\Services;

use App\Http\Repositories\WishlistRepository as WishlistRepository;
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
}