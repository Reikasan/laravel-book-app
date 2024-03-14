<x-app>
    <div class="create-review">
        <div class="book-details">
            <div class="book-details__img">
                <img 
                    src="{{ isset($book->image_large) ? $book->image_large : $book->image_thumbnail }}" 
                    alt="{{ $book->title }}"/>
            </div>
        </div>
        <div class="create-review__form">
            <div class="create-review__book-infos">
                <h1>{{ $book->title }}</h1>
                <p class="author">by {{ $book->authors }}</p>
            </div>
            <form method="POST" action="{{ route('reviews.store') }}">
                @csrf
                <input type="hidden" name="book_id" value="{{ $book->id }}">
                <div class="form-group w-half">
                    <label for="date">Review Date</label>
                    <input type="date" name="review-date" id="date" class="form-control" required>
                </div>
                <div class="form-group w-harf">
                    <div class="rating">
                        @for($i = 0; $i < 5; $i++)
                        <i class="fa-regular fa-star"></i>
                        @endfor
                        <input type="number" name="review-rate" value=0 hidden>
                    </div>
                </div>
                <div class="form-group">
                    <label for="review-text">Review</label>
                    <textarea name="review-text" id="reviewText" class="form-control" required></textarea>
                </div>
                <div class="btn-container">
                    <button type="submit" class="btn btn--primary">Add review</button>

                </div>
            </form>
        </div>
    </div>
</x-app>