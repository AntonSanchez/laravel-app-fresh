<x-layout title="Book Details | {{ $book->title }}">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

        <div class="mb-8 flex justify-between items-center">
            <a href="{{ route('books.index') }}"
               class="text-blue-300 hover:text-white transition-colors text-sm flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to Books List
            </a>

            <span class="text-xs font-mono text-blue-200/30 tracking-widest uppercase">
                Record #{{ $book->id }}
            </span>
        </div>

        <div class="bg-white/5 border border-white/10 backdrop-blur-md rounded-3xl p-8 shadow-2xl relative overflow-hidden">
            <div class="absolute top-0 right-0 -mr-16 -mt-16 w-64 h-64 bg-indigo-500/10 rounded-full blur-3xl"></div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

                <!-- Book Information -->
                <div class="md:col-span-2 space-y-4">
                    <h2 class="text-3xl font-black text-white">{{ $book->title }}</h2>
                    <p class="text-blue-300 text-lg">by {{ $book->author }}</p>

                    <p class="text-blue-100/70 leading-relaxed">
                        {{ $book->description }}
                    </p>

                    <div class="grid grid-cols-2 gap-4 pt-4">
                        <div>
                            <p class="text-blue-200/50 text-xs uppercase">Genre</p>
                            <p class="text-white font-semibold">{{ $book->genre }}</p>
                        </div>
                        <div>
                            <p class="text-blue-200/50 text-xs uppercase">Published Year</p>
                            <p class="text-white font-semibold">{{ $book->published_year }}</p>
                        </div>
                        <div>
                            <p class="text-blue-200/50 text-xs uppercase">ISBN</p>
                            <p class="text-white font-semibold">{{ $book->isbn }}</p>
                        </div>
                        <div>
                            <p class="text-blue-200/50 text-xs uppercase">Pages</p>
                            <p class="text-white font-semibold">{{ $book->pages }}</p>
                        </div>
                        <div>
                            <p class="text-blue-200/50 text-xs uppercase">Language</p>
                            <p class="text-white font-semibold">{{ $book->language }}</p>
                        </div>
                        <div>
                            <p class="text-blue-200/50 text-xs uppercase">Publisher</p>
                            <p class="text-white font-semibold">{{ $book->publisher }}</p>
                        </div>
                        <div>
                            <p class="text-blue-200/50 text-xs uppercase">Price</p>
                            <p class="text-amber-400 font-bold text-lg">
                                ₱{{ number_format($book->price, 2) }}
                            </p>
                        </div>
                        <div>
                            <p class="text-blue-200/50 text-xs uppercase">Availability</p>
                            @if($book->is_available)
                                <span class="text-emerald-400 font-semibold">Available</span>
                            @else
                                <span class="text-red-400 font-semibold">Unavailable</span>
                            @endif
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="pt-6 flex gap-4">
                        <a href="{{ route('books.edit', $book->id) }}"
                           class="bg-blue-500 hover:bg-blue-400 text-white px-6 py-2.5 rounded-xl font-bold shadow-lg shadow-blue-500/20">
                            Edit Book
                        </a>

                        <form action="{{ route('books.destroy', $book->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                onclick="return confirm('Delete this book permanently?')"
                                class="bg-red-500 hover:bg-red-400 text-white px-6 py-2.5 rounded-xl font-bold shadow-lg shadow-red-500/20">
                                Delete Book
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>