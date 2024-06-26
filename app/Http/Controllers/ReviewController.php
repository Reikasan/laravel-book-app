<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReviewRequest;
use App\Http\Requests\UpdateReviewRequest;
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
     * Index the drafts.
     */
    public function indexDrafts()
    {

        $drafts = $this->reviewService->getReviewDrafts();
        return view('pages.reviewDrafts', ['drafts' => $drafts]);
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
        if($this->reviewService->validateReview($inputs) === false) {
            return back()->withInput()->withErrors(['error' => 'The review is invalid.']);
        }
       
        try {
            $review = $this->reviewService->store($inputs);
            if($inputs['is_draft'] == true) {
                $request->session()->flash('success', 'The review has been saved as a draft.');
            } else {
                $request->session()->flash('success', 'The review has been stored successfully.');
            }

            // Remove the book from the wishlist if it exists
            $result = $this->wishlistService->destroyByBookId($inputs['book_id']);
            return response()->json(['reviewId' => $review->id], 200);
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
        return view('pages.editReview', ['review' => $review]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReviewRequest $request, Review $review)
    {
        if($this->reviewService->findOrFail($review->id) === null) {
            return back()->withInput()->withErrors(['error' => 'The review does not exist.']);
        }
        
        $inputs = $request->validated();
        if($this->reviewService->validateReview($inputs) === false) {
            return back()->withInput()->withErrors(['error' => 'The review is invalid.']);
        }
        try {
            $this->reviewService->updateReview($inputs, $review->id);
            $request->session()->flash('success', 'The review has been updated successfully.');
            return response()->json(['reviewId' => $review->id], 200);
        }
        catch (\Exception $e) {
            return back()->withInput()->withErrors(['error' => 'An error occurred while updating the review.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {
        if($this->reviewService->findOrFail($review->id) === null) {
            return back()->withInput()->withErrors(['error' => 'The review does not exist.']);
        }
        
        try {
            $this->reviewService->destroy($review->id);
            $request->session()->flash('success', 'The review has been deleted successfully.');
            return $this->index();
        }
        catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred while deleting the review.']);
        }
    }

    public function createFromApi(Request $request)
    {
        $isbn = $request->input('isbn') != null ? $request->input('isbn') : $request->input('isbn13'); 

        $book = $this->bookService->storeFetchedBook($isbn);
        return view('pages.createReview', ['book' => $book]);
    }
}