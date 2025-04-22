@props(['lastListings'])

<section class="bg-amber-50 py-16 px-4 md:px-8 lg:px-16">
    <div class="max-w-7xl mx-auto">

        <!-- section heading -->
        <h2 class="text-3xl font-bold text-gray-800 mb-8 text-center">
            Latest Car Listings
        </h2>

        <!-- Carousel -->
        <div class="relative">
            {{-- listings --}}
            <div id="carousel" class="flex gap-6 snap-x snap-mandatory overflow-x-auto scroll-smooth pb-4">
                @foreach ($lastListings as $listing)
                <div
                    class="snap-center shrink-0 w-[90%] md:w-1/2 lg:w-1/3 bg-white rounded-lg shadow-md relative overflow-hidden">
                    <img src="{{ json_decode($listing->images)[0] }}" alt="{{ $listing->name }}"
                        class="w-full h-[300px] object-cover" />

                    <a href="{{ route('listings.show', $listing->id) }}"
                        class="absolute bottom-4 left-1/2 transform -translate-x-1/2 bg-red-600 hover:bg-red-700 text-white px-5 py-2 rounded-md font-semibold shadow-lg transition">
                        Details
                    </a>
                </div>
                @endforeach
            </div>

            <!-- navigation -->
            <div
                class="flex justify-between absolute top-1/2 left-0 w-full px-4 transform -translate-y-1/2 pointer-events-none">
                <button
                    onclick="document.getElementById('carousel').scrollBy({ left: -300, behavior: 'smooth' })"
                    class="bg-white hover:bg-yellow-500 text-gray-700 hover:text-white rounded-full shadow-md w-10 h-10 flex items-center justify-center pointer-events-auto transition cursor-pointer">
                    <i class="fa-solid fa-chevron-left"></i>
                </button>
                <button
                    onclick="document.getElementById('carousel').scrollBy({ left: 300, behavior: 'smooth' })"
                    class="bg-white hover:bg-yellow-500 text-gray-700 hover:text-white rounded-full shadow-md w-10 h-10 flex items-center justify-center pointer-events-auto transition cursor-pointer">
                    <i class="fa-solid fa-chevron-right"></i>
                </button>
            </div>
        </div>

    </div>
</section>