<?php

namespace App\Services;

use App\Repositories\ReviewRepository as ReviewRepository;

class ReviewService
{
    private $reviewRepository;

    public function __construct(ReviewRepository $reviewRepository)
    {
        $this->reviewRepository = $reviewRepository;
    }

    public function getLatestReviews()
    {
        return $this->reviewRepository->getLatestReviews();
    }

    public function getReviewDrafts()
    {
        return $this->reviewRepository->getReviewDrafts();
    }

    public function reviewsByMonthAndYear()
    {
        return $this->reviewRepository->reviewsByMonthAndYear();
    } 
    
    public function getReadMonth()
    {
        return $this->reviewRepository->getReadMonth();
    }

    public function store(array $inputs): object | null
    {
        return $this->reviewRepository->store($inputs);
    }
}