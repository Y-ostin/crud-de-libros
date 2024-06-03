@extends('layouts.app')

@section('content')
    <h1 class="text-3xl font-bold mb-4 text-center">Books</h1>

    <!-- Botón para agregar un nuevo libro -->
    <div class="mb-4 flex justify-center">
        <a href="{{ route('books.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded inline-block">Add New Book</a>
    </div>

    <!-- Filtros -->
    <div class="mb-4 flex justify-center">
        <form action="{{ route('books.index') }}" method="GET" class="flex items-center">
            <label for="status_filter" class="mr-2">Filter by Status:</label>
            <select name="status_filter" id="status_filter" class="bg-gray-200 rounded-md py-1 px-2">
                <option value="">All</option>
                <option value="Pending" {{ request()->status_filter == 'Pending' ? 'selected' : '' }}>Pending</option>
                <option value="Read" {{ request()->status_filter == 'Read' ? 'selected' : '' }}>Read</option>
            </select>
            <input type="text" name="name_filter" id="name_filter" placeholder="Filter by Name" class="ml-2 rounded-md py-1 px-2">
            <button type="submit" class="ml-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded">Apply Filters</button>
        </form>
    </div>

    <div class="flex justify-around">
        <!-- Lista de todos los libros -->
        <div class="w-1/3">
            <h2 class="text-xl font-bold mb-2 text-center">All Books</h2>
            <div class="mb-8">
                <table class="table-auto border-collapse border border-gray-400 mx-auto">
                    <thead>
                        <tr>
                            <th class="px-4 py-2">Title</th>
                            <th class="px-4 py-2">Author</th>
                            <th class="px-4 py-2">Status</th>
                            <th class="px-4 py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($allBooks as $book)
                            <tr>
                                <td class="border px-4 py-2">{{ $book->title }}</td>
                                <td class="border px-4 py-2">{{ $book->author }}</td>
                                <td class="border px-4 py-2">{{ $book->is_read ? 'Read' : 'Pending' }}</td>
                                <td class="border px-4 py-2 flex justify-center">
                                    <a href="{{ route('books.edit', $book) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded mr-2">Edit</a>
                                    <form action="{{ route('books.destroy', $book) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded" onclick="return confirm('Are you sure you want to delete this book?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Lista de libros pendientes -->
        <div class="w-1/3">
            <h2 class="text-xl font-bold mb-2 text-center">Pending Books</h2>
            <div class="mb-8">
                <table class="table-auto border-collapse border border-gray-400 mx-auto">
                    <thead>
                        <tr>
                            <th class="px-4 py-2">Title</th>
                            <th class="px-4 py-2">Author</th>
                            <th class="px-4 py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pendingBooks as $book)
                            <tr>
                                <td class="border px-4 py-2">{{ $book->title }}</td>
                                <td class="border px-4 py-2">{{ $book->author }}</td>
                                <td class="border px-4 py-2 flex justify-center">
                                    <a href="{{ route('books.edit', $book) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded mr-2">Edit</a>
                                    <form action="{{ route('books.destroy', $book) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded" onclick="return confirm('Are you sure you want to delete this book?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Lista de libros leídos -->
        <div class="w-1/3">
            <h2 class="text-xl font-bold mb-2 text-center">Read Books</h2>
            <div class="mb-8">
                <table class="table-auto border-collapse border border-gray-400 mx-auto">
                    <thead>
                        <tr>
                            <th class="px-4 py-2">Title</th>
                            <th class="px-4 py-2">Author</th>
                            <th class="px-4 py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($readBooks as $book)
                            <tr>
                                <td class="border px-4 py-2">{{ $book->title }}</td>
                                <td class="border px-4 py-2">{{ $book->author }}</td>
                                <td class="border px-4 py-2 flex justify-center">
                                    <a href="{{ route('books.edit', $book) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded mr-2">Edit</a>
                                    <form action="{{ route('books.destroy', $book) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded" onclick="return confirm('Are you sure you want to delete this book?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
