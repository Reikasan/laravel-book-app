<x-app>
    <x-book-searchbar />
    <div class="book-container">
        @csrf
        @if(isset($wishlists))
            @foreach($wishlists as $wishlist) 
                <x-book-card 
                    :book="$wishlist->book" 
                    :isBookReviewedByUser=false 
                    :$refreshByUpdatingWishlist 
                />
            @endforeach
        @endif
    </div>
</x-app>