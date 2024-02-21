<?php

namespace App\Services;

use App\Http\Repositories\ReviewRepository as ReviewRepository;

class ReviewService
{
    private $reviewRepository;

    public function __construct(ReviewRepository $reviewRepository)
    {
        $this->reviewRepository = $reviewRepository;
    }

    public function getLatestReviews($userId)
    {
        return $this->reviewRepository->getLatestReviews($userId);
    }
}