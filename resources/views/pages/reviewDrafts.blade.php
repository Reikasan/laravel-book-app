<x-app>
    <x-book-searchbar />
    <div class="book-container">
        @foreach($drafts as $draft)
            <x-review-card :review="$draft"/>
        @endforeach
    </div>
</x-app>