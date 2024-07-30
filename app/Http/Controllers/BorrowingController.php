<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Book;
use App\Models\Patron;
use App\Models\BorrowingRecord;
// use Illuminate\Database\Eloquent\ModelNotFoundException;

class BorrowingController extends Controller
{
  
    public function borrow($bookId, $patronId)
{
    
    $book = Book::findOrFail($bookId);
    $patron = Patron::findOrFail($patronId);

    $borrowingRecord = new BorrowingRecord();
    $borrowingRecord->book_id = $book->id;
    $borrowingRecord->patron_id = $patron->id;
    $borrowingRecord->borrowed_at = now();
    $borrowingRecord->save();

    return response()->json($borrowingRecord, 201);
}

    public function returnBook($bookId, $patronId)
    {
        $borrowingRecord = BorrowingRecord::where('book_id', $bookId)
                                            ->where('patron_id', $patronId)
                                            ->firstOrFail();

        $borrowingRecord->returned_at = now();
        $borrowingRecord->save();

        return response()->json($borrowingRecord, 200);
    }
}

