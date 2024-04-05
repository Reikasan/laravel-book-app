<x-app>
    <div class="review">
        <div class="review__form">
            <form method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="review_id" value="{{ $review->id }}" required>
                <div class="book-details grid">
                    <div class="book-details__img img-with-link">
                        <img 
                            src="{{ isset($review->book->image_large) ? $review->book->image_large : $review->book->image_thumbnail }}" 
                            alt="{{ $review->book->title }}"
                        />
                        <x-image-overlay :book="$review->book" />
                    </div>
                    <div class="book-details__content">
                        <h1>{{ $review->book->title }}</h1>
                        <p class="author">by {{ $review->book->authors }}</p>
                        <div class="form-group w-harf">
                            <div class="rating">
                                @for($i = 0; $i < $review->rating; $i++)
                                <i class="icon fa-solid fa-star"></i>
                                @endfor
                                @for($i = 5; $i > $review->rating; $i--)
                                <i class="icon fa-regular fa-star"></i>
                                @endfor
                                @if($review->rating == null)
                                <input type="hidden" name="review-rate" min="1" max="5" value=0 step="1">
                                @else
                                <input type="hidden" name="review-rate" min="1" max="5" value={{$review->rating}} step="1">
                                @endif
                                <p class="error-message">Please enter a number between 1 and 5</p>
                            </div>
                        </div>
                        <div class="form-group w-half">
                            <label for="date">Date</label>
                            @if($review->review_date !== null)
                            <input type="date" name="review-date" id="date" value={{$review->review_date}} class="form-control">
                            @else
                            <input type="date" name="review-date" id="date" class="form-control">
                            @endif
                            <p class="error-message">Please enter a valid date</p>
                        </div>
                    </div>
                </div>
                <div class="grid">
                    <div></div>
                    <div class="form-group">
                        <label for="review-text">Review</label>
                        <textarea name="review-text" id="reviewText" class="form-control" maxlength="5000">@if($review->review != null){{$review->review}}@endif</textarea>
                        <p class="error-message">Please enter a review</p>
                    </div>
                </div>
                <div class="btn-container">
                    @if($review->is_draft == 1)
                    <button type="submit" class="btn btn--secondary edit-btn store-btn--draft">Save as draft</button>
                    @endif
                    <button type="submit" class="btn btn--primary edit-btn store-btn--review">Update review</button>
                </div>
            </form>
        </div>
    </div>
</x-app>