<x-app>
    <div class="review">
        <div class="menu-btn">
            <i class="fa-solid fa-ellipsis-vertical"></i>
            <ul class="menu hidden">
                <li class="menu__item">
                    <a href="{{ route('reviews.edit', $review->id) }}" class="">
                        <i class="fa-solid fa-pen"></i>
                        Edit
                    </a>
                </li>
                <li class="menu__item">
                    <form action="{{ route('reviews.destroy', $review->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="">
                            <i class="fa-solid fa-eraser"></i>
                            Delete
                        </button>
                    </form>
                </li>
                <li class="menu__item">
                    <a href="{{ route('books.show', $review->book->id) }}" class="">
                        <i class="fa-solid fa-book"></i>
                        Book details
                    </a>
                </li>
            </ul>
        </div>
        <div class="book-details">
            <div class="book-details__img img-with-link">
                    <img 
                        src="{{ isset($review->book->image_large) ? $review->book->image_large : $review->book->image_thumbnail }}" 
                        alt="{{ $review->book->title }}"
                    />
                    <x-image-overlay :book="$review->book"/>
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
            <div></div>
            <div>
                <h2>Review</h2>
                <p>{{ $review->review }}</p>
            </div>
        </div>
    </div>
</x-app>