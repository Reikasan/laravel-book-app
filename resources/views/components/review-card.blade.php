
<div class="book-card">
    review card
    <img src="{{ $review->book->image_thumbnail }}" alt="{{ $review->book->title }}"/>
    <div class="book-card__content">
        <div class="book-info">
            <h3>{{ $review->book->title }}</h3>
            <p>{{ $review->book->authors }}</p>
        </div>
    </div>
    <form class="book-card__btn-container" action="{{route('reviews.show', ['review' => $review])}}" method="GET">
        <button class="btn btn-primary" type="submit">Read Review</button>
    </form>
</div>  