<?php

namespace App\Http\Repositories;

use App\Models\Review;

class ReviewRepository
{
    public function getLatestReviews($userId, $numberOfReviews)
    {
        $reviews = Review::where(['user_id' => $userId])
                        ->whereBetween('created_at', [now()->subDays(30), now()])
                        ->orderBy('created_at', 'desc')
                        ->take($numberOfReviews)
                        ->get();
        return $reviews;
    }
}