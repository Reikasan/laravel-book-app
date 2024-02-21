<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ReviewService;

class HomeController extends Controller
{
    private $reviewService;

    public function __construct(ReviewService $reviewService)
    {
        $this->reviewService = $reviewService;
    
    }

    public function index()
    {
        $userId = auth()->user()->id;
        $numberOfReviews = 4;
        $latestReviews = $this->reviewService->getLatestReviews($userId, $numberOfReviews);
        return view('pages.index', ['latestReviews' => $latestReviews]);
    }
}
