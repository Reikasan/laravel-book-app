<div class="book-card">
    <div class="book-card__img">
        <img src="{{ $review->book->image_thumbnail }}" alt="{{ $review->book->title }}"/>    
    </div>
    <div class="book-card__content">
        <div class="feedback-panel">
            <div class="rating">
                @for($i = 0; $i < $review->rating; $i++)
                <i class="icon fa-solid fa-star"></i>
                @endfor
                @for($i = 0; $i < (5 -$review->rating); $i++)
                <i class="icon fa-regular fa-star"></i>
                @endfor
            </div>
            <div class="review-date">at {{$review->review_date}}</div>
        </div>
        <div class="book-info">
            <h3>{{ $review->book->title }}</h3>
            <p>{{ $review->book->authors }}</p>
        </div>
    </div>
    <div class="book-card__btn-container">
        <a class="btn btn--secondary" href="{{route('books.show', ['book' => $review->book->id])}}">Book Details</a>
        <a class="btn btn--secondary" href="{{route('reviews.show', ['review' => $review])}}">Read Review</a>
    </div>
</div>  