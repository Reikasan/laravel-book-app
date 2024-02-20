@extends('layouts.app')
@section('content')
    <x-book-searchbar />
    <div class="book-container">
        {{-- books-b‚lade --}}
        @if(isset($books))
            @foreach($books as $book) 
            <x-book-card :book="$book" :type="$type" />
            @endforeach
        @endif
    </div>
@endsection
