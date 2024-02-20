<div class="book-search">
    <form class="book-search__form" method="post" action="{{ route('showFetchedBooks')}}">
       @csrf
        <div class="form-group inline">
            <input type="text" id="bookSearchInput" name="book-title" placeholder="Enter book title" class="form-control" />
            <button 
                id='searchBtn'
                type="submit"
                class="btn btn--primary"
            >
                Search
            </button>
        </div>
    </form>

</div>