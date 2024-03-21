<?php
namespace App\Repositories;

use App\Models\Book;

class BookRepository
{
    public function findBookByApiId(string $apiId): object | null 
    {
        return Book::where('google_book_id', $apiId)->first();
    }

    public function isBookInDatabase(string $apiId): bool
    {
        return Book::where('google_book_id', $apiId)->exists();
    }

    public function isBookReviewedByUser(int $bookId): bool
    {
        return Book::find($bookId)->reviews()->where('user_id', auth()->id())->exists();
    }

    public function getUserReview($book): object | null
    {
        $userId = auth()->id();
        return $book->reviews->where('user_id', $userId)->first();
    }

    public function returnStoredBook(Book $book): object | null
    {
        if(isset($book->isReviewedByUser)) {
            unset($book->isReviewedByUser);
        }

        if($book->save()) {
            return $book;
        }
        return null;
    }
}