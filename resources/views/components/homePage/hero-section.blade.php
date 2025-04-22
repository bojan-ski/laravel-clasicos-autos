<section class="relative h-[90vh] flex items-center justify-center text-white text-center overflow-hidden">
    {{-- image & overlay --}}
    <div class="absolute inset-0 bg-cover bg-center z-0" style="background-image: url('{{ asset('assets/images/hero.jpg') }}');"></div>
    <div class="absolute inset-0 bg-black/75 z-3"></div>

    {{-- content --}}
    <div class="relative z-5 px-6">
        <h1 class="text-4xl md:text-5xl font-bold mb-7">
            Find Your Perfect Classic Ride
        </h1>
        <p class="text-lg md:text-xl mb-10">
            Explore timeless cars, from Volvo to Cadillac
        </p>
        <a href="{{ route('listings') }}"
           class="bg-red-600 hover:bg-red-700 transition duration-150 text-white text-lg px-7 py-3 rounded-md font-bold">
            See offers
        </a>
    </div>
</section>
