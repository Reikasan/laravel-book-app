<x-app>
    <div class="review">
        <div class="book-details">
            <div class="book-details__img">
                <a href="{{ route('books.show', $review->book->id) }}" class="book-image-link">
                    <img 
                        src="{{ isset($review->book->image_large) ? $review->book->image_large : $review->book->image_thumbnail }}" 
                        alt="{{ $review->book->title }}"/>
                    <div class="overlay">
                        <p>Details</p>
                    </div>
                </a>
            </div> 
            <div class="book-details__content">
                <div>
                    <h1>{{ $review->book->title }}</h1>
                    <p class="sub-title">{{ $review->book->sub_title }}</p>
                    <p class="author">by {{ $review->book->authors }}</p>
                </div>
                <div>
                    <div class="rating">
                        @for($i = 0; $i < $review->rating; $i++)
                        <i class="icon fa-solid fa-star"></i>
                        @endfor
                        @for($i = 0; $i < 5 - $review->rating; $i++)
                        <i class="icon fa-regular fa-star"></i>
                        @endfor
                    </div>
                    <p class="review-date">Reviewed at {{ $review->review_date }}</p>
                </div>
            </div>
        </div>
        <div class="review__content">
            <h2>Review</h2>
            <p>{{ $review->review }}</p>
        </div>
        <div class="btn-container">
            <a href="{{ route('reviews.edit', $review->id) }}" class="btn btn--primary">Edit review</a>
            <a href="{{route('reviews.index')}}" class="btn btn--secondary">Check more reviews</a>
        </div>
    </div>
</x-app>