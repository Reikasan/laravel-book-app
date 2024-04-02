<div class="img-overlay">
    @if($book->isBookInDatabase)
    <a href="{{ route('books.show', $book->id) }}" class="btn">
        Details
    </a>
    @else
    <form class="book-card__form--show" method="POST" action={{ route('books.showFetchedBook', ['title' => $book->title])}}>
        @csrf
        <input type="hidden" name="isbn" value="{{ $book->isbn }}">
        <input type="hidden" name="isbn13" value="{{ $book->isbn13 }}">
        <button type="submit" class="btn show-details-btn">Details</button>
    </form>
    <a href="" class="btn hidden">Details</a>
    @endif
</div>