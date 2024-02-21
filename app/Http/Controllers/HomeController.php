<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;

class HomeController extends Controller
{
    public function index()
    {
        $userId = auth()->user()->id;
        $latestReviews = Review::where(['user_id' => $userId])
                            ->whereBetween('created_at', [now()->subDays(30), now()])
                            ->orderBy('created_at', 'desc')
                            ->take(4)
                            ->get();
        return view('pages.index', ['latestReviews' => $latestReviews]);
    }
}
