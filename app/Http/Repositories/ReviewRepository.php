<?php

namespace App\Http\Repositories;

use App\Models\Review;

class ReviewRepository
{
    public function getLatestReviews($userId)
    {
        $reviews = Review::where(['user_id' => $userId])
                        ->whereBetween('review_date', [now()->subDays(60), now()])
                        ->orderBy('review_date', 'desc')
                        ->get();
        return $reviews;
    }
}