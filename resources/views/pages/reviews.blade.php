<x-app>
    <x-book-searchbar />
    <div class="review-container">
        @if(isset($reviews))
            @foreach($reviews as $review) 
            <x-review-card :review="$review"/>
            @endforeach
        @endif
    </div>
</x-app>

