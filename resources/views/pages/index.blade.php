<x-app>
    <div>
        <x-book-searchbar />
        <section class="reviewed-books--recently">
            <h1>Recently Reviewed</h1>
            <div class="reviews-row">
                @if(count($latestReviews) == 0)
                    <h2 class="no-item">No reviews in 30 Days</h2>
                    <a class="btn btn-primary" href="{{ route('reviews.index')}}">All Reviews</a>
                @else
                    @foreach ($latestReviews as $latestReview)
                        <x-review-card :review="$latestReview" />
                    @endforeach
                @endif
            </div>
        </section>
        <section class="actions">
            <a href="{{ route('reviews.create') }}" class="action-btn action-btn--create">
                <span>Create<br/>Review</span>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M373.5 27.1C388.5 9.9 410.2 0 433 0c43.6 0 79 35.4 79 79c0 22.8-9.9 44.6-27.1 59.6L277.7 319l-10.3-10.3-64-64L193 234.3 373.5 27.1zM170.3 256.9l10.4 10.4 64 64 10.4 10.4-19.2 83.4c-3.9 17.1-16.9 30.7-33.8 35.4L24.4 510.3l95.4-95.4c2.6 .7 5.4 1.1 8.3 1.1c17.7 0 32-14.3 32-32s-14.3-32-32-32s-32 14.3-32 32c0 2.9 .4 5.6 1.1 8.3L1.7 487.6 51.5 310c4.7-16.9 18.3-29.9 35.4-33.8l83.4-19.2z"/></svg>
            </a>
            <p>What do you want?</p>
            <a href="{{ route('reviews.indexByYear', ['year' => now()->format('Y')]) }}" class="action-btn action-btn--show">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M96 0C43 0 0 43 0 96V416c0 53 43 96 96 96H384h32c17.7 0 32-14.3 32-32s-14.3-32-32-32V384c17.7 0 32-14.3 32-32V32c0-17.7-14.3-32-32-32H384 96zm0 384H352v64H96c-17.7 0-32-14.3-32-32s14.3-32 32-32zm32-240c0-8.8 7.2-16 16-16H336c8.8 0 16 7.2 16 16s-7.2 16-16 16H144c-8.8 0-16-7.2-16-16zm16 48H336c8.8 0 16 7.2 16 16s-7.2 16-16 16H144c-8.8 0-16-7.2-16-16s7.2-16 16-16z"/></svg>
                <span>My<br/>Review</span>
            </a>
        </section>
    </div>
</x-app>