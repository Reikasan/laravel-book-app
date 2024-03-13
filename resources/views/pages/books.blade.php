<x-app>
    <x-book-searchbar />
    <div class="book-container">
        @if(isset($books))
            @foreach($books as $book) 
                @if($book->isReviewedByUser)
                    @inject('bookService', 'App\Services\BookService')
                    <x-review-card :review="$bookService->getUserReview($book)" />
                @else
                    <x-book-card :book="$book" :isBookReviewedByUser=false/>
                @endif
            @endforeach
        @endif
    </div>
</x-app>

