
<div class="book-card">
        <img src="{{ $book->image_link }}" alt="{{ $book->title }}"/>
        <div class="book-card__content">
            <div class="book-info">
                <h3>{{ $book->title }}</h3>
                <p>{{ $book->authors }}</p>
            </div>
        </div>
        @if($type === 'fetch')
        <div class="book-card__btn-container">
            <button class="btn btn-primary" href="{{$book->link}}">Learn More</button>
            <button class="btn btn-primary">Select</button>
        </div>
        @elseif($type === 'selected')
        <div class="book-card__btn-container">
            <button class="btn btn-primary" href="{{ route('books.show', ['book' => $book->id])}}">Check Book</button>
        </div>
        @endif  
</div>  