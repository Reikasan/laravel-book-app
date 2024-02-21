<x-app>
    <div>
        <x-book-searchbar />
        <div class="reviewed-books--recently">
            <h2>Recently Reviewed</h2>
            <div class="reviews">
                @foreach ($latestReviews as $latestReview)
                    <x-review-card :review="$latestReview" />
                @endforeach
            </div>
            <button class="btn btn-primary">View More</button>
        </div>
    </div>
</x-app>