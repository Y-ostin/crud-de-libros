<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    public function index(Request $request){
    $user = Auth::user();
    $statusFilter = $request->status_filter;
    $nameFilter = $request->name_filter;

    $allBooks = $user->books();

    // Aplicar filtros
    if ($statusFilter) {
        if ($statusFilter == 'Pending') {
            $allBooks = $allBooks->where('is_read', false);
        } elseif ($statusFilter == 'Read') {
            $allBooks = $allBooks->where('is_read', true);
        }
    }

    if ($nameFilter) {
        $allBooks = $allBooks->where('title', 'like', '%' . $nameFilter . '%');
    }

    $allBooks = $allBooks->get();

    $pendingBooks = $allBooks->where('is_read', false);
    $readBooks = $allBooks->where('is_read', true);

    return view('books.index', compact('allBooks', 'pendingBooks', 'readBooks'));
    }
    

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'publication_year' => 'required|numeric',
            'synopsis' => 'required',
            'cover_url' => 'required|url',
            'status' => 'required', // Asegúrate de que el campo status esté presente en las reglas de validación
        ]);

        $book = new Book();
        $book->title = $request->title;
        $book->author = $request->author;
        $book->publication_year = $request->publication_year;
        $book->synopsis = $request->synopsis;
        $book->cover_url = $request->cover_url;
        $book->is_read = $request->status === 'Read'; // Asigna true si el status es "Read", de lo contrario asigna false
        $book->user_id = Auth::id();
        $book->save();

        return redirect()->route('books.index')->with('success', 'Book added successfully.');
    }   

    public function create()
    {
        return view('books.create');
    }
    

    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'publication_year' => 'required|numeric',
            'synopsis' => 'required',
            'cover_url' => 'required|url',
            'status' => 'required', // Asegúrate de que el campo status esté presente en las reglas de validación
        ]);

        $book->update([
            'title' => $request->title,
            'author' => $request->author,
            'publication_year' => $request->publication_year,
            'synopsis' => $request->synopsis,
            'cover_url' => $request->cover_url,
            'is_read' => $request->status === 'Read', // Asigna true si el status es "Read", de lo contrario asigna false
        ]);

        return redirect()->route('books.index')->with('success', 'Book updated successfully.');
    }

    public function destroy(Book $book)
    {
        $book->delete();

        return redirect()->route('books.index')->with('success', 'Book deleted successfully.');
    }

    public function markAsRead(Book $book)
    {
        $book->update(['is_read' => true]);

        return redirect()->route('books.index')->with('success', 'Book marked as read successfully.');
    }

    public function markAsUnread(Book $book)
    {
        $book->update(['is_read' => false]);

        return redirect()->route('books.index')->with('success', 'Book marked as unread successfully.');
    }
    
    public function edit(Book $book)
    {
        return view('books.edit', compact('book'));
    }
}
