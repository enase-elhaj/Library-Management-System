<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Facades\Cache;

class BookController extends Controller
{
    
    public function index()
    {
       
        return Book::all();
     
    }

    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'author' => 'required|string',
            'publication_year' => 'required|integer',
            'isbn' => 'required|string|unique:books',
        ]);

        return Book::create($validated);
    }

   
    public function show(string $id)
    {
        // $book = Cache::remember("book_{$id}", 60, function () use ($id) {
        return Book::findOrFail($id);
        // });
    }

    
    public function update(Request $request, string $id)
    {
        $book = Book::findOrFail($id);
        
        $validated = $request->validate([
            'title' => 'string',
            'author' => 'string',
            'publication_year' => 'integer',
            'isbn' => 'string|unique:books,isbn,' . $id,
        ]);

        $book->update($validated);

        return $book;
    }

   
    public function destroy(string $id)
    {
        $book = Book::findOrFail($id);
        $book->delete();

        return response()->json(['message' => 'Book deleted successfully']);
    }
}
