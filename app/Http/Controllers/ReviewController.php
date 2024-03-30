<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReviewRequest;
use App\Models\Review;
use Illuminate\Http\Request;
use App\Services\BookService;
use App\Services\ReviewService;
use App\Services\WishlistService;
use App\Models\Book;

class ReviewController extends Controller
{
    private $bookService;
    private $reviewService;
    private $wishlistService;

    public function __construct(BookService $bookService, 
                                ReviewService $reviewService,
                                WishlistService $wishlistService)
    {
        $this->bookService = $bookService;
        $this->reviewService = $reviewService;
        $this->wishlistService = $wishlistService;
    }

    public function index()
    {
        $year = now()->year;
        return $this->indexByYear($year);
    }
    
    /**
     * Index page paginated by year.
     */
    public function indexByYear(int $year)
    {
        $reviewsByMonthAndYear = $this->reviewService->reviewsByMonthAndYear();
        $readMonth = $this->reviewService->getReadMonth();
        
        return view('pages.reviews', [
            'reviews' => $reviewsByMonthAndYear, 
            'readMonth' => $readMonth,
            'selectedYear' => $year
        ]);
    }

    /**
     * Show the search Book page.
     */
    public function create()
    {
        $wishlist = $this->wishlistService->getAll();

        return view('pages.createReviewSearch', [
            'books' => $wishlist,
            'type' => 'fromWishlist',
            'isBookReviewedByUser' => false,
            'refreshByUpdatingWishlist' => "true"
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createBookReview(Book $book)
    {
        return view('pages.createReview', ['book' => $book]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreReviewRequest $request)
    {
        $inputs = $request->validated();
        try {
            $review = $this->reviewService->store($inputs);

            // Remove the book from the wishlist if it exists
            $result = $this->wishlistService->destroyByBookId($inputs['book_id']);
            // Redirect to the review page
            return redirect()->route('reviews.show', ['review' => $review->id]);
        } 
        catch (\Exception $e) {
            return back()->withInput()->withErrors(['error' => 'An error occurred while saving the review.']);
        }
    }
    
    /**
     * Store a draft review.
     */
    public function storeDraft(StoreReviewRequest $request)
    {
        $inputs = $request->validated();
        $inputs['is_draft'] = true;
        try {
            $review = $this->reviewService->store($inputs);

            // Remove the book from the wishlist if it exists
            $result = $this->wishlistService->destroyByBookId($inputs['book_id']);
            // Redirect to the review page
            return redirect()->route('reviews.show', ['review' => $review->id]);
        } 
        catch (\Exception $e) {
            return back()->withInput()->withErrors(['error' => 'An error occurred while saving the review.']);
        }
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

        $book = $this->bookService->storeFetchedBook($isbn);
        return view('pages.createReview', ['book' => $book]);
    }
}
