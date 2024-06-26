<x-app>
    <div class="review">
        <div class="review__form">
            <form method="POST">
                @csrf
                <input type="hidden" name="book_id" value="{{ $book->id }}" required>
                <div class="book-details grid">
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
                                <input type="hidden" name="review-rate" min="1" max="5" value=0 step="1">
                                <p class="error-message">Please enter a number between 1 and 5</p>
                            </div>
                        </div>
                        <div class="form-group w-half">
                            <label for="date">Date</label>
                            <input type="date" name="review-date" id="date" class="form-control">
                            <p class="error-message">Please enter a valid date</p>
                        </div>
                    </div>
                </div>
                <div class="grid">
                    <div></div>
                    <div class="form-group">
                        <label for="review-text">Review</label>
                        <textarea name="review-text" id="reviewText" class="form-control" maxlength="5000"></textarea>
                        <p class="error-message">Please enter a review</p>
                    </div>
                </div>
                <div class="btn-container">
                    <button type="submit" class="btn btn--secondary store-btn store-btn--draft">Save as draft</button>
                    <button type="submit" class="btn btn--primary store-btn store-btn--review">Add review</button>
                </div>
            </form>
        </div>
    </div>
</x-app>