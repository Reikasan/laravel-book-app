<x-app>
    <div class="book-details">
        <div class="book-details__container">
            <div>
                <img 
                    src="{{ isset($book->image_large) ? $book->image_large : $book->image_thumbnail }}" 
                    alt="{{ $book->title }}"/>
            </div>
            <div>
                <h1>{{ $book->title }}</h1>
                <p>{{ $book->authors }}</p>
                <p>{{ $book->description }}</p>
                <p>{{ $book->isbn }}</p>
                <p>{{ $book->isbn13 }}</p>
                <p>{{ $book->page_count }}</p>
                <p>{{ $book->published_date }}</p>
                <p>{{ $book->publisher }}</p>
                <p>{{ $book->language }}</p>
            </div>
        </div>
    </div>
</x-app>