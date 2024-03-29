<div class="book-card">
    <div class="book-card__img">
        <img src="{{ $book->image_thumbnail }}" alt="{{ $book->title }}"/>
    </div>
    <div class="book-card__content">
        <div class="feedback-panel">
            <div class="icons">
                @if($book->wishlist->contains('user_id', Auth::id()))
                <i class="icon 
                    fa-solid 
                    fa-heart 
                    wishlist-icon 
                    wishlist-icon--remove"
                    data-refresh={{ $refreshByUpdatingWishlist }}
                    @if($book->wishlist->firstWhere('user_id', Auth::id()) !== null)
                    data-wishlist-id={{ $book->wishlist->firstWhere("user_id", Auth::id())->id }}
                    @endif
                ></i>
                @else
                <i class="icon 
                    fa-regular 
                    fa-heart 
                    wishlist-icon 
                    wishlist-icon--add"
                    @if($book->id !== null)
                    data-book-id={{ $book->id}}
                    @else
                    data-book-isbn={{ $book->isbn}}
                    data-book-isbn13={{ $book->isbn13}}
                    @endif
                    data-refresh={{ $refreshByUpdatingWishlist }}
                ></i>
                @endif
                <i class="icon fa-regular fa-comments"></i>
            </div>
            <div class="review-count">
                <div class="review-count__number">
                    @if($book->reviews->count() == 0)
                        You will be the first to review
                    @elseif($book->reviews->count() == 1)
                        {{ $book->reviews->count() }} User reviewed
                    @else
                        {{ $book->reviews->count() }} Users reviewed
                    @endif
                </div>
            </div>
        </div>
        <div class="book-info">
            <h3>{{ $book->title }}</h3>
            <p>{{ $book->authors }}</p>
        </div>
    </div>
    @if($book->isBookInDatabase)
    <div class="book-card__btn-container">
        <a class="btn btn--secondary" href="{{ route('books.show', ['book' => $book->id])}}">Book Details</a>
        @if(!$isBookReviewedByUser)
        <a class="btn btn--secondary" href="{{ route('reviews.createBookReview', ['book' => $book->id])}}">Review it</a>
        @endif
    </div>
    @else
    <div class="book-card__btn-container">
        <form class="book-card__form--show" method="POST" action={{ route('books.showFetchedBook', ['title' => $book->title])}}>
            @csrf
            <input type="hidden" name="isbn" value="{{ $book->isbn }}">
            <input type="hidden" name="isbn13" value="{{ $book->isbn13 }}">
            <button type="submit" class="btn btn--secondary show-details-btn">Book Details</button>
        </form>
        <form class="book-card__form--create-review" method="POST" action="{{ route('reviews.createFromApi', ['title' => $book->title]) }}">
            @csrf
            <input type="hidden" name="isbn" value="{{ $book->isbn }}">
            <input type="hidden" name="isbn13" value="{{ $book->isbn13 }}">
            @if(!$isBookReviewedByUser)
            <button type="submit" class="btn btn--secondary">Review it</button>
            @endif
        </form>
    </div>
    @endif  
</div>  