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
        $latestReviews = $this->reviewService->getLatestReviews($userId);
        return view('pages.index', ['latestReviews' => $latestReviews]);
    }
}
