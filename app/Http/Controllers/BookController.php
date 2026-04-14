<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $query = Book::query();

        // Search by title or author
        if ($request->search) {
            $query->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('author', 'like', '%' . $request->search . '%');
        }

        // Filter by genre
        if ($request->genre) {
            $query->where('genre', $request->genre);
        }

        $books = $query->latest()->paginate(10);
        $genres = Book::select('genre')->distinct()->pluck('genre');

        return view('books.index', compact('books', 'genres'));
    }

    public function create()
    {
        return view('books.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'description' => 'required',
            'genre' => 'required',
            'published_year' => 'required|integer',
            'isbn' => 'required|unique:books,isbn',
            'pages' => 'required|integer',
            'language' => 'required',
            'publisher' => 'required',
            'price' => 'required|numeric',
            'cover_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'is_available' => 'boolean'
        ]);

        if ($request->hasFile('cover_image')) {
            $validated['cover_image'] = $request->file('cover_image')
                ->store('covers', 'public');
        }

        $validated['is_available'] = $request->has('is_available');

        Book::create($validated);

        return redirect()->route('books.index')
            ->with('success', 'Book added successfully.');
    }

    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }

    public function edit(Book $book)
    {
        return view('books.edit', compact('book'));
    }

    public function update(Request $request, Book $book)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'description' => 'required',
            'genre' => 'required',
            'published_year' => 'required|integer',
            'isbn' => 'required|unique:books,isbn,' . $book->id,
            'pages' => 'required|integer',
            'language' => 'required',
            'publisher' => 'required',
            'price' => 'required|numeric',
            'cover_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'is_available' => 'boolean'
        ]);

        if ($request->hasFile('cover_image')) {
            $validated['cover_image'] = $request->file('cover_image')
                ->store('covers', 'public');
        }

        $validated['is_available'] = $request->has('is_available');

        $book->update($validated);

        return redirect()->route('books.index')
            ->with('success', 'Book updated successfully.');
    }

    public function destroy(Book $book)
    {
        $book->delete();

        return redirect()->route('books.index')
            ->with('success', 'Book deleted successfully.');
    }
}
