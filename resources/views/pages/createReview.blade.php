<x-app>
    <div class="review">
        <div class="review__form">
            <form method="POST" action="{{ route('reviews.store') }}">
                @csrf
                <input type="hidden" name="book_id" value="{{ $book->id }}">
                <div class="book-details">
                    <div class="book-details__img img-with-link">
                        <img 
                            src="{{ isset($book->image_large) ? $book->image_large : $book->image_thumbnail }}" 
                            alt="{{ $book->title }}"
                        />
                            <x-image-overlay :$book/>
                    </div>
                    <div class="book-details__content">
                        <h1>{{ $book->title }}</h1>
                        <p class="author">by {{ $book->authors }}</p>
                        <div class="form-group w-harf">
                            <div class="rating">
                                @for($i = 0; $i < 5; $i++)
                                <i class="icon fa-regular fa-star"></i>
                                @endfor
                                <input type="number" name="review-rate" value=0 hidden>
                            </div>
                        </div>
                        <div class="form-group w-half">
                            <label for="date">Date</label>
                            <input type="date" name="review-date" id="date" class="form-control" required>
                        </div>
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