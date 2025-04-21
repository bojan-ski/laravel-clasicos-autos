<x-layout>

    {{-- Hero --}}
    <section class="relative h-[80vh] bg-cover bg-center flex items-center justify-center text-white text-center"
        style="background-image: url('/images/hero-car.jpg');">
        <div class="bg-black bg-opacity-60 w-full h-full absolute top-0 left-0 z-0"></div>
        <div class="relative z-10 px-6">
            <h1 class="text-4xl md:text-5xl font-bold mb-7">
                Find Your Perfect Classic Ride
            </h1>
            <p class="text-lg md:text-xl mb-10">
                Explore timeless cars, from Volvo to Cadillac
            </p>
            <a href="{{ route('listings') }}"
                class="bg-red-600 hover:bg-red-700 text-white px-7 py-3 rounded-md font-bold text-lg">
                See offers
            </a>
        </div>
    </section>

    {{-- About --}}
    <section class="bg-white py-16 px-4 md:px-8 lg:px-16 text-center">
        <div class="max-w-4xl mx-auto">
            <h2 class="text-4xl font-extrabold text-gray-800 mb-6">
                About Our App
            </h2>
            <p class="text-gray-600 text-lg leading-relaxed">
                Welcome to our vintage car marketplace — your trusted destination for discovering classic and
                timeless vehicles. Our platform is built with passion for automotive heritage, offering carefully
                curated listings from collectors, enthusiasts, and sellers across the region. Whether you're a buyer
                looking for your next showpiece, a seller sharing a piece of history, or a casual browser soaking in
                the nostalgia, our app provides a seamless, enjoyable experience tailored just for you.
            </p>
        </div>
    </section>

    <div class="container mx-auto">
        {{-- Promo --}}
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

        {{-- Latest listings --}}
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
                  <div class="snap-center shrink-0 w-[90%] md:w-1/2 lg:w-1/3 bg-white rounded-lg shadow-md relative overflow-hidden">
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
                <div class="flex justify-between absolute top-1/2 left-0 w-full px-4 transform -translate-y-1/2 pointer-events-none">
                  <button onclick="document.getElementById('carousel').scrollBy({ left: -300, behavior: 'smooth' })"
                          class="bg-white hover:bg-gray-200 text-gray-700 rounded-full shadow-md w-10 h-10 flex items-center justify-center pointer-events-auto transition">
                    ‹
                  </button>
                  <button onclick="document.getElementById('carousel').scrollBy({ left: 300, behavior: 'smooth' })"
                          class="bg-white hover:bg-gray-200 text-gray-700 rounded-full shadow-md w-10 h-10 flex items-center justify-center pointer-events-auto transition">
                    ›
                  </button>
                </div>
              </div>
          
            </div>
          </section>          

    </div>
</x-layout>