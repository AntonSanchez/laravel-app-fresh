<x-layout title="Add New Book | fresh-laravel-app">
    <div class="max-w-5xl mx-auto mt-12 px-4 pb-20">

        <div class="mb-6">
            <a href="{{ route('books.index') }}"
               class="inline-flex items-center gap-2 text-blue-300 hover:text-white transition-colors text-sm font-semibold">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Back to Books List
            </a>
        </div>

        <div class="bg-white/5 border border-white/10 backdrop-blur-md rounded-3xl p-8 shadow-2xl">

            <div class="border-b border-white/10 pb-6 mb-6">
                <h2 class="text-3xl font-black text-white tracking-tight">
                    Add New Book
                </h2>
                <p class="mt-2 text-blue-200/60 text-sm">
                    Fill in the details below to add a new book to the system.
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

            <!-- Form -->
            <form method="POST" action="{{ route('books.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="grid grid-cols-1 gap-x-6 gap-y-6 sm:grid-cols-6">

                    <div class="sm:col-span-3">
                        <label class="block text-sm font-semibold text-blue-100 mb-2">Title</label>
                        <input type="text" name="title" value="{{ old('title') }}" required
                               class="w-full rounded-xl bg-white/10 border border-white/10 px-4 py-2.5 text-white placeholder:text-white/30 focus:ring-2 focus:ring-amber-400 outline-none"
                               placeholder="Book Title">
                    </div>

                    <div class="sm:col-span-3">
                        <label class="block text-sm font-semibold text-blue-100 mb-2">Author</label>
                        <input type="text" name="author" value="{{ old('author') }}" required
                               class="w-full rounded-xl bg-white/10 border border-white/10 px-4 py-2.5 text-white placeholder:text-white/30 focus:ring-2 focus:ring-amber-400 outline-none"
                               placeholder="Author Name">
                    </div>

                    <div class="sm:col-span-6">
                        <label class="block text-sm font-semibold text-blue-100 mb-2">Description</label>
                        <textarea name="description" rows="4" required
                                  class="w-full rounded-xl bg-white/10 border border-white/10 px-4 py-2.5 text-white placeholder:text-white/30 focus:ring-2 focus:ring-amber-400 outline-none"
                                  placeholder="Summary of the book">{{ old('description') }}</textarea>
                    </div>

                    <div class="sm:col-span-3">
                        <label class="block text-sm font-semibold text-blue-100 mb-2">Genre</label>
                        <select name="genre" required
                                class="w-full rounded-xl bg-black/10 border border-white/10 px-4 py-2.5 text-black focus:ring-2 focus:ring-amber-400 outline-none">
                            <option value="" class="text-black">Select Genre</option>
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
                               value="{{ old('published_year') }}" required
                               class="w-full rounded-xl bg-white/10 border border-white/10 px-4 py-2.5 text-white focus:ring-2 focus:ring-amber-400 outline-none"
                               placeholder="2024">
                    </div>

                    <div class="sm:col-span-3">
                        <label class="block text-sm font-semibold text-blue-100 mb-2">ISBN</label>
                        <input type="text" name="isbn" value="{{ old('isbn') }}" required
                               class="w-full rounded-xl bg-white/10 border border-white/10 px-4 py-2.5 text-white placeholder:text-white/30 focus:ring-2 focus:ring-amber-400 outline-none"
                               placeholder="978-XXXXXXXXXX">
                    </div>

                    <div class="sm:col-span-3">
                        <label class="block text-sm font-semibold text-blue-100 mb-2">Pages</label>
                        <input type="number" name="pages" value="{{ old('pages') }}" required
                               class="w-full rounded-xl bg-white/10 border border-white/10 px-4 py-2.5 text-white focus:ring-2 focus:ring-amber-400 outline-none"
                               placeholder="350">
                    </div>

                    <div class="sm:col-span-3">
                        <label class="block text-sm font-semibold text-blue-100 mb-2">Language</label>
                        <input type="text" name="language" value="{{ old('language') }}" required
                               class="w-full rounded-xl bg-white/10 border border-white/10 px-4 py-2.5 text-white placeholder:text-white/30 focus:ring-2 focus:ring-amber-400 outline-none"
                               placeholder="English">
                    </div>

                    <div class="sm:col-span-3">
                        <label class="block text-sm font-semibold text-blue-100 mb-2">Publisher</label>
                        <input type="text" name="publisher" value="{{ old('publisher') }}" required
                               class="w-full rounded-xl bg-white/10 border border-white/10 px-4 py-2.5 text-white placeholder:text-white/30 focus:ring-2 focus:ring-amber-400 outline-none"
                               placeholder="Publishing Company">
                    </div>

                    <div class="sm:col-span-3">
                        <label class="block text-sm font-semibold text-blue-100 mb-2">Price (₱)</label>
                        <input type="number" step="0.01" name="price" value="{{ old('price') }}" required
                               class="w-full rounded-xl bg-white/10 border border-white/10 px-4 py-2.5 text-white focus:ring-2 focus:ring-amber-400 outline-none"
                               placeholder="499.00">
                    </div>

                    <div class="sm:col-span-3 flex items-center mt-6">
                        <input type="checkbox" name="is_available" value="1"
                               class="h-4 w-4 rounded border-white/20 bg-white/10 text-amber-400 focus:ring-amber-400"
                               {{ old('is_available', true) ? 'checked' : '' }}>
                        <label class="ml-2 text-sm font-semibold text-blue-100">
                            Available
                        </label>
                    </div>
                </div>

                <div class="mt-10 flex items-center justify-end gap-4 pt-6 border-t border-white/10">
                    <a href="{{ route('books.index') }}"
                       class="px-6 py-2.5 text-sm font-bold text-white hover:text-red-400 transition-colors">
                        Cancel
                    </a>
                    <button type="submit"
                        class="bg-amber-400 hover:bg-amber-300 text-amber-950 px-8 py-2.5 rounded-xl font-black text-sm transition-all shadow-lg shadow-amber-400/20 active:scale-95">
                        Save Book
                    </button>
                </div>
            </form>
        </div>

        <p class="mt-6 text-center text-xs text-blue-200/30 uppercase tracking-tighter">
            Laravel Book Management System • Create Book
        </p>
    </div>
</x-layout>