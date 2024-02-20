
<div class="book-card">
        <img src="{{ $book->image_thumbnail }}" alt="{{ $book->title }}"/>
        <div class="book-card__content">
            <div class="book-info">
                <h3>{{ $book->title }}</h3>
                <p>{{ $book->authors }}</p>
            </div>
        </div>
        @if($type === 'fetch')
        <form class="book-card__btn-container" method="POST" action={{ route('books.showFetchedBook', ['title' => $book->title])}}>
            @csrf
            <input type="hidden" name="isbn" value="{{ $book->isbn }}">
            <input type="hidden" name="isbn13" value="{{ $book->isbn13 }}">
            <button type="submit" class="btn btn-primary">Learn More</button>
            <button class="btn btn-primary">Select</button>
        </form>
        @elseif($type === 'selected')
        <div class="book-card__btn-container">
            <button class="btn btn-primary" href="{{ route('books.show', ['book' => $book->id])}}">Check Book</button>
        </div>
        @endif  
</div>  