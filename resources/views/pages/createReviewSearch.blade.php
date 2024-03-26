<x-app>
    <div class="create-review-search">
        <div class="create-review-search__item">
            <h1>Search from book title</h1>
            <x-book-searchbar />
        </div>
        <span>or</span>
        <div class="create-review-search__item">
            <h1>from Your wishlist</h1>
            <div class="book-card__container">
                <!-- Books data from Wishlist -->
                @foreach($books as $item)
                    <x-book-card :book="$item->book" :$type :$isBookReviewedByUser :$refreshByUpdatingWishlist />
                @endforeach
            </div>
        </div>
    </div>
</x-app>