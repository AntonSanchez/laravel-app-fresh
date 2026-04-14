<x-layout title="Edit Book | {{ $book->title }}">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

        <div class="mb-8 flex justify-between items-center">
            <a href="{{ route('books.index') }}"
               class="text-blue-300 hover:text-white transition-colors text-sm flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Cancel and Go Back
            </a>
            <span class="text-xs font-mono text-blue-200/30 tracking-widest uppercase">
                Editing Record #{{ $book->id }}
            </span>
        </div>

        <div class="bg-white/5 border border-white/10 backdrop-blur-md rounded-3xl p-8 shadow-2xl relative overflow-hidden">
            <div class="absolute top-0 right-0 -mr-16 -mt-16 w-64 h-64 bg-blue-500/10 rounded-full blur-3xl"></div>

            <form method="POST" action="{{ route('books.update', $book->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="border-b border-white/10 pb-6 mb-6">
                    <h2 class="text-3xl font-black text-white tracking-tight">Update Book Information</h2>
                    <p class="mt-2 text-blue-200/60 text-sm">
                        Modifying details for
                        <span class="text-blue-300 font-semibold">{{ $book->title }}</span>.
                    </p>
                </div>

                <!-- Errors -->
                @if ($errors->any())
                    <div class="mb-6 rounded-xl bg-red-500/20 border border-red-400/40 text-red-300 px-4 py-3">
                        <ul class="list-disc list-inside text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Fields -->
                <div class="grid grid-cols-1 gap-x-6 gap-y-6 sm:grid-cols-6">

                    <div class="sm:col-span-3">
                        <label class="block text-sm font-semibold text-blue-100 mb-2">Title</label>
                        <input type="text" name="title"
                               value="{{ old('title', $book->title) }}"
                               class="w-full rounded-xl bg-white/10 border border-white/10 px-4 py-2.5 text-white focus:ring-2 focus:ring-blue-400 outline-none"
                               required>
                    </div>

                    <div class="sm:col-span-3">
                        <label class="block text-sm font-semibold text-blue-100 mb-2">Author</label>
                        <input type="text" name="author"
                               value="{{ old('author', $book->author) }}"
                               class="w-full rounded-xl bg-white/10 border border-white/10 px-4 py-2.5 text-white focus:ring-2 focus:ring-blue-400 outline-none"
                               required>
                    </div>

                    <div class="sm:col-span-6">
                        <label class="block text-sm font-semibold text-blue-100 mb-2">Description</label>
                        <textarea name="description" rows="4"
                                  class="w-full rounded-xl bg-white/10 border border-white/10 px-4 py-2.5 text-white focus:ring-2 focus:ring-blue-400 outline-none"
                                  required>{{ old('description', $book->description) }}</textarea>
                    </div>

                    <div class="sm:col-span-3">
                        <label class="block text-sm font-semibold text-blue-100 mb-2">Genre</label>
                        <select name="genre" required
                                class="w-full rounded-xl bg-black/10 border border-white/10 px-4 py-2.5 text-black focus:ring-2 focus:ring-amber-400 outline-none">
                            <option value="{{ old('genre', $book->genre) }}" class="text-black">Select Genre</option>
                            @php
                                $genreList = ['Science Fiction', 'Fantasy', 'Mystery', 'Romance', 'Horror', 'History', 'Educational'];
                            @endphp
                            @foreach($genreList as $genre)
                                <option value="{{ $genre }}" class="text-white"
                                    {{ old('genre') == $genre ? 'selected' : '' }}>
                                    {{ $genre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="sm:col-span-3">
                        <label class="block text-sm font-semibold text-blue-100 mb-2">Published Year</label>
                        <input type="number" name="published_year"
                               value="{{ old('published_year', $book->published_year) }}"
                               class="w-full rounded-xl bg-white/10 border border-white/10 px-4 py-2.5 text-white focus:ring-2 focus:ring-blue-400 outline-none"
                               required>
                    </div>

                    <div class="sm:col-span-3">
                        <label class="block text-sm font-semibold text-blue-100 mb-2">ISBN</label>
                        <input type="text" name="isbn"
                               value="{{ old('isbn', $book->isbn) }}"
                               class="w-full rounded-xl bg-white/10 border border-white/10 px-4 py-2.5 text-white focus:ring-2 focus:ring-blue-400 outline-none"
                               required>
                    </div>

                    <div class="sm:col-span-3">
                        <label class="block text-sm font-semibold text-blue-100 mb-2">Pages</label>
                        <input type="number" name="pages"
                               value="{{ old('pages', $book->pages) }}"
                               class="w-full rounded-xl bg-white/10 border border-white/10 px-4 py-2.5 text-white focus:ring-2 focus:ring-blue-400 outline-none"
                               required>
                    </div>

                    <div class="sm:col-span-3">
                        <label class="block text-sm font-semibold text-blue-100 mb-2">Language</label>
                        <input type="text" name="language"
                               value="{{ old('language', $book->language) }}"
                               class="w-full rounded-xl bg-white/10 border border-white/10 px-4 py-2.5 text-white focus:ring-2 focus:ring-blue-400 outline-none"
                               required>
                    </div>

                    <div class="sm:col-span-3">
                        <label class="block text-sm font-semibold text-blue-100 mb-2">Publisher</label>
                        <input type="text" name="publisher"
                               value="{{ old('publisher', $book->publisher) }}"
                               class="w-full rounded-xl bg-white/10 border border-white/10 px-4 py-2.5 text-white focus:ring-2 focus:ring-blue-400 outline-none"
                               required>
                    </div>

                    <div class="sm:col-span-3">
                        <label class="block text-sm font-semibold text-blue-100 mb-2">Price (₱)</label>
                        <input type="number" step="0.01" name="price"
                               value="{{ old('price', $book->price) }}"
                               class="w-full rounded-xl bg-white/10 border border-white/10 px-4 py-2.5 text-white focus:ring-2 focus:ring-blue-400 outline-none"
                               required>
                    </div>

                    <div class="sm:col-span-3 flex items-center gap-2">
                        <input type="checkbox" name="is_available" value="1"
                               class="h-4 w-4 rounded border-white/20 bg-white/10 text-blue-400"
                               {{ old('is_available', $book->is_available) ? 'checked' : '' }}>
                        <label class="text-sm text-blue-100 font-semibold">
                            Available
                        </label>
                    </div>
                </div>

                <div class="mt-10 flex items-center justify-end gap-4 pt-6 border-t border-white/10">
                    <a href="{{ route('books.index') }}"
                       class="px-6 py-2.5 text-sm font-bold text-red-400 hover:bg-red-400/10 rounded-xl transition-all">
                        Discard Changes
                    </a>
                    <button type="submit"
                        class="bg-blue-500 hover:bg-blue-400 text-white px-8 py-2.5 rounded-xl font-black text-sm transition-all shadow-lg shadow-blue-500/20 active:scale-95">
                        Update Book
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layout>