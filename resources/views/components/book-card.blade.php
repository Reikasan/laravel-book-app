<div class="book-card">
    <div class="book-card__img img-with-link">
        <img 
            src="{{ $book->image_thumbnail }}" 
            alt="{{ $book->title }}"/>
        <x-image-overlay :book="$book" />
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
        @if(!$isBookReviewedByUser)
        <a class="btn btn--primary review-btn" href="{{ route('reviews.createBookReview', ['book' => $book->id])}}">Review it</a>
        @endif
    </div>
    @else
    <div class="book-card__btn-container">
        <form class="book-card__form--create-review" method="POST" action="{{ route('reviews.createFromApi', ['title' => $book->title]) }}">
            @csrf
            <input type="hidden" name="isbn" value="{{ $book->isbn }}">
            <input type="hidden" name="isbn13" value="{{ $book->isbn13 }}">
            @if(!$isBookReviewedByUser)
            <button type="submit" class="btn btn--primary">Review it</button>
            @endif
        </form>
        <a class="btn btn--primary review-btn hidden" href="">Review it</a>
    </div>
    @endif  
</div>  