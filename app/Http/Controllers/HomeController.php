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
        $latestReviews = $this->reviewService->getLatestReviews();
        $drafts = $this->reviewService->getReviewDrafts();
        $wishlist = $this->wishlistService->getAll();
        return view('pages.index', [
            'latestReviews' => $latestReviews,
            'drafts' => $drafts,
            'wishlist' => $wishlist,
            'refreshByUpdatingWishlist' => "true",
        ]);
    }
}
