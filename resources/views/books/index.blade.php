<x-layout title="Books List | fresh-laravel-app">
    <div class="max-w-6xl mx-auto mt-12 px-4 pb-20">

        <div class="flex flex-col md:flex-row justify-between items-end mb-8 gap-4">
            <div>
                <h1 class="text-3xl font-black text-white tracking-tight">
                    Book Management
                </h1>
                <p class="text-blue-200/60 text-sm mt-1">
                    Manage and organize your book collection efficiently.
                </p>
            </div>

            <a href="{{ route('books.create') }}"
               class="flex items-center gap-2 bg-amber-400 hover:bg-amber-300 text-amber-950 px-5 py-2.5 rounded-xl font-bold text-sm transition-all shadow-lg shadow-amber-400/20 active:scale-95">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                        clip-rule="evenodd" />
                </svg>
                Add New Book
            </a>
        </div>

        @if(session('success'))
            <div class="mb-6 rounded-xl bg-emerald-500/20 border border-emerald-400/30 text-emerald-300 px-6 py-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white/5 border border-white/10 backdrop-blur-md rounded-3xl shadow-2xl p-6 mb-8">
            <form method="GET" action="{{ route('books.index') }}">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                    <!-- Search -->
                    <div>
                        <label class="block text-sm font-semibold text-blue-100 mb-2">
                            Search
                        </label>
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Search by title or author..."
                            class="w-full rounded-xl bg-white/10 border border-white/10 px-4 py-2.5 text-white placeholder:text-white/30 focus:ring-2 focus:ring-amber-400 outline-none transition-all sm:text-sm">
                    </div>

                    <!-- Filter -->
                    <div>
                        <label class="block text-sm font-semibold text-blue-100 mb-2">
                            Filter by Genre
                        </label>
                        <select name="genre"
                            class="w-full rounded-xl bg-white/10 border border-white/10 px-4 py-2.5 text-white focus:ring-2 focus:ring-amber-400 outline-none sm:text-sm">
                            <option value="" class="text-black">All Genres</option>
                            @foreach($genres as $genre)
                                <option value="{{ $genre }}"
                                    class="text-black"
                                    {{ request('genre') == $genre ? 'selected' : '' }}>
                                    {{ $genre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex items-end">
                        <button type="submit"
                            class="w-full bg-amber-400 hover:bg-amber-300 text-amber-950 px-4 py-2.5 rounded-xl font-bold text-sm transition-all shadow-lg shadow-amber-400/20">
                            Apply Filters
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Books Table -->
        <div class="relative overflow-hidden bg-white/5 border border-white/10 backdrop-blur-md rounded-3xl shadow-2xl">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-white/5 text-blue-200/70 text-xs uppercase tracking-widest font-bold">
                            <th class="px-6 py-4">Book Details</th>
                            <th class="px-6 py-4">Author</th>
                            <th class="px-6 py-4">Genre</th>
                            <th class="px-6 py-4">Price</th>
                            <th class="px-6 py-4">Availability</th>
                            <th class="px-6 py-4 text-right">Actions</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-white/10">
                        @forelse ($books as $book)
                            <tr class="group hover:bg-white/[0.03] transition-colors">
                                
                                <!-- Book Details -->
                                <td class="px-6 py-5">
                                    <div class="flex items-center gap-3">

                                        <div>
                                            <div class="text-white font-semibold">
                                                {{ $book->title }}
                                            </div>
                                            <div class="text-blue-100/40 text-xs font-mono">
                                                ISBN: {{ $book->isbn }}
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-6 py-5 text-blue-100/70 text-sm">
                                    {{ $book->author }}
                                </td>

                                <td class="px-6 py-5">
                                    <span class="bg-blue-400/10 text-blue-300 px-2.5 py-0.5 rounded-full text-xs border border-blue-400/20">
                                        {{ $book->genre }}
                                    </span>
                                </td>

                                <td class="px-6 py-5 text-blue-100/70 text-sm">
                                    ₱{{ number_format($book->price, 2) }}
                                </td>

                                <td class="px-6 py-5">
                                    @if($book->is_available)
                                        <span class="bg-emerald-400/10 text-emerald-300 px-2.5 py-0.5 rounded-full text-xs border border-emerald-400/20">
                                            Available
                                        </span>
                                    @else
                                        <span class="bg-red-400/10 text-red-300 px-2.5 py-0.5 rounded-full text-xs border border-red-400/20">
                                            Unavailable
                                        </span>
                                    @endif
                                </td>

                                <!-- Actions -->
                                <td class="px-6 py-5 text-right">
                                    <div class="flex justify-end items-center gap-2 opacity-0 group-hover:opacity-100 transition-opacity">

                                        <!-- View -->
                                        <a href="{{ route('books.show', $book->id) }}"
                                           class="p-2 text-blue-300 hover:bg-blue-400/20 rounded-lg transition-colors"
                                           title="View Details">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                 viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </a>

                                        <!-- Edit -->
                                        <a href="{{ route('books.edit', $book->id) }}"
                                           class="p-2 text-amber-300 hover:bg-amber-400/20 rounded-lg transition-colors"
                                           title="Edit Book">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                 viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M11 5h2m-1-1v2m-6 8l10-10 3 3-10 10H5v-3z" />
                                            </svg>
                                        </a>

                                        <!-- Delete -->
                                        <form action="{{ route('books.destroy', $book->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                onclick="return confirm('Delete this book permanently?')"
                                                class="p-2 text-red-400 hover:bg-red-400/20 rounded-lg transition-colors"
                                                title="Delete Book">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                     viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                          d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>

                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-20 text-center">
                                    <p class="text-blue-200/40 italic font-mono">
                                        No books found in the database.
                                    </p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if(method_exists($books, 'links'))
                <div class="px-6 py-4 border-t border-white/10">
                    {{ $books->appends(request()->query())->links() }}
                </div>
            @endif
        </div>
    </div>
</x-layout>