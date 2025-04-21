@props([
'promoCarMaker',
'promoListings'
])

<section class="bg-amber-50 py-16 px-4 md:px-8 lg:px-16">
    <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-10 items-start">

        <!-- car maker desc -->
        <div class="md:mt-7">
            <h3 class="text-3xl font-bold text-gray-800 mb-4">
                {{ $promoCarMaker->name }}
            </h3>
            <p class="text-gray-700 text-lg leading-relaxed">
                {{ $promoCarMaker->description }}
            </p>
        </div>

        <!-- Carousel -->
        <div>
            <!-- listings -->
            <div class="carousel w-full rounded-lg overflow-hidden shadow-md">
                @foreach($promoListings as $listing)
                <div id="{{ $listing->id }}" class="carousel-item w-full relative">
                    <img src="{{ json_decode($listing->images)[0] }}" alt="{{ $listing->name }}"
                        class="w-full h-[400px] md:h-[300px] lg:h-[250px] object-cover" />
                    <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2">
                        <a href="{{ route('listings.show', $listing->id) }}"
                            class="bg-red-600 hover:bg-red-700 text-white px-5 py-2 rounded-md font-semibold shadow-lg">
                            Details
                        </a>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- navigation -->
            <div class="flex justify-center mt-4 gap-2">
                @foreach ($promoListings as $index => $listing)
                <a href="#{{ $listing->id }}"
                    class="w-8 h-8 flex items-center justify-center bg-white border border-gray-300 rounded-full text-sm text-gray-700 hover:bg-yellow-500 hover:text-white transition">
                    {{ $index + 1 }}
                </a>
                @endforeach
            </div>
        </div>

    </div>
</section>