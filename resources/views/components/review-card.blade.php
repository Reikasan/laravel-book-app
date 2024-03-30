<div class="book-card">
    <div class="book-card__img img-with-link">
        <img 
            src="{{ $review->book->image_thumbnail }}" 
            alt="{{ $review->book->title }}"
        />    
        <x-image-overlay :book="$review->book" />
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
        @if($review->is_draft)
        <a class="btn btn--secondary" href="{{route('reviews.edit', ['review' => $review])}}">Edit Draft</a>
        @else
        <a class="btn btn--primary" href="{{route('reviews.show', ['review' => $review])}}">Read Review</a>
        @endif
    </div>
</div>  