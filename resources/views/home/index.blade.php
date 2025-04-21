<x-layout>

    {{-- Hero --}}
    <x-homePage.hero-section />

    {{-- About the app --}}
    <x-homePage.about-the-app-section />

    <div class="container mx-auto">
        {{-- Promo --}}
        <x-homePage.promo-section :promoCarMaker="$promoCarMaker" :promoListings="$promoListings" />

        {{-- Latest listings --}}
        <x-homePage.latest-listings-section :lastListings="$lastListings" />

    </div>
</x-layout>