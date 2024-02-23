<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use App\Services\BookService;
use App\Services\ReviewService;

class ReviewController extends Controller
{
    private $bookService;
    private $reviewService;

    public function __construct(BookService $bookService, ReviewService $reviewService)
    {
        $this->bookService = $bookService;
        $this->reviewService = $reviewService;
    }
    /**
     * Index page paginated by year.
     */
    public function indexByYear(int $year)
    {
        $reviewsByMonthAndYear = $this->reviewService->reviewsByMonthAndYear();
        $readMonth = $this->reviewService->getReadMonth();
// dd($reviewsByMonthAndYear);
        return view('pages.reviews', [
            'reviews' => $reviewsByMonthAndYear, 
            'readMonth' => $readMonth,
            'selectedYear' => $year
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Review $review)
    {
        return view('pages.review', ['review' => $review]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Review $review)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {
        //
    }

    public function createFromApi(Request $request)
    {
        $isbn = $request->input('isbn') != null ? $request->input('isbn') : $request->input('isbn13'); 

        $book = $this->bookService->fetchBook('isbn', $isbn);
        return view('pages.createReview', ['book' => $book]);
    }
}
