@extends('layouts.app')

@section('content')
    <h1 class="text-3xl font-bold mb-4">Edit Book</h1>

    <form action="{{ route('books.update', $book) }}" method="POST" class="max-w-md mx-auto bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="title" class="block text-gray-700 text-sm font-bold mb-2">Title:</label>
            <input type="text" name="title" id="title" value="{{ $book->title }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>
        <div class="mb-4">
            <label for="author" class="block text-gray-700 text-sm font-bold mb-2">Author:</label>
            <input type="text" name="author" id="author" value="{{ $book->author }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>
        <div class="mb-4">
            <label for="publication_year" class="block text-gray-700 text-sm font-bold mb-2">Publication Year:</label>
            <input type="number" name="publication_year" id="publication_year" value="{{ $book->publication_year }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>
        <div class="mb-4">
            <label for="synopsis" class="block text-gray-700 text-sm font-bold mb-2">Synopsis:</label>
            <textarea name="synopsis" id="synopsis" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ $book->synopsis }}</textarea>
        </div>
        <div class="mb-4">
            <label for="cover_url" class="block text-gray-700 text-sm font-bold mb-2">Cover URL:</label>
            <input type="url" name="cover_url" id="cover_url" value="{{ $book->cover_url }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>
        <div class="mb-4">
            <label for="status" class="block text-gray-700 text-sm font-bold mb-2">Status:</label>
            <select name="status" id="status" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <option value="Pending" {{ $book->status === 'Pending' ? 'selected' : '' }}>Pending</option>
                <option value="Read" {{ $book->status === 'Read' ? 'selected' : '' }}>Read</option>
            </select>
        </div>
        <div class="flex items-center justify-between">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Update Book</button>
            <a href="{{ route('books.index') }}" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">Cancel</a>
        </div>
    </form>
@endsection
