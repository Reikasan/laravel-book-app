<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ReviewService;
use App\Services\WishlistService;

class HomeController extends Controller
{
    private $reviewService;
    private $wishlistService;

    public function __construct(ReviewService $reviewService, WishlistService $wishlistService)
    {
        $this->reviewService = $reviewService;
        $this->wishlistService = $wishlistService;
    }

    public function index()
    {
        $userId = auth()->user()->id;
        $latestReviews = $this->reviewService->getLatestReviews($userId);
        $wishlist = $this->wishlistService->getAll();
        return view('pages.index', [
            'latestReviews' => $latestReviews,
            'wishlist' => $wishlist,
        ]);
    }
}
