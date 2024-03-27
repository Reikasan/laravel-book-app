<?php

namespace App\Repositories;

use App\Models\Review;
use Carbon\Carbon;

class ReviewRepository
{
    public function getLatestReviews(int $userId): object
    {
        $reviews = Review::where(['user_id' => $userId])
                        ->whereBetween('review_date', [now()->subDays(60), now()])
                        ->orderBy('review_date', 'desc')
                        ->get();
        return $reviews;
    }

    private function allUserReviews(): object
    {
        $reviews = Review::where(['user_id' => auth()->id()])
                        ->orderBy('review_date', 'desc')
                        ->get();
        return $reviews;
    } 

    public function reviewsByMonthAndYear(): object
    {
        $reviews = $this->allUserReviews();
        $groupedReviews = $reviews->groupBy(function($review) {
            return Carbon::parse($review->review_date)->format('F.Y');
        });
        return $groupedReviews;
    }

    public function getReadMonth(): array
    {
        $reviews = $this->allUserReviews();
        $year = [];
        $readMonthPair = [];
        $oldestDate = Carbon::parse($reviews->sortBy('review_date')->first()->review_date);

        // Create an array of years between the oldest and the current year
        for($i = now()->format('Y'); $i >= $oldestDate->format('Y'); $i--) {
            $year[] = $i;
        }

        // Create an array of months between the oldest and the current month
        foreach($year as $y) {
            $i = 11;
            $j = 0;
            $monthNames = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

            if($y == $oldestDate->format('Y')) {
                $j = intval($oldestDate->format('m')) - 1;
            } elseif($y == now()->format('Y')) {
                $i = now()->format('m') -1;
            } 

            for($i; $i >= $j; $i--) {
                $readMonthPair[$y][] = $monthNames[$i];
            }
        }
        return $readMonthPair;
    }

    public function store(array $inputs): object | null
    {
        return Review::create([
            'user_id' => auth()->id(),
            'book_id' => $inputs['book_id'],
            'rating' => $inputs['review-rate'],
            'review_date' => $inputs['review-date'],
            'review' => $inputs['review-text']
        ]);
    }
}