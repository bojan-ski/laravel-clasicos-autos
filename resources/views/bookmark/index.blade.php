<x-layout>
    <div class="bookmarked-car-listings-page container mx-auto mt-10">

        {{-- page header --}}
        @if ($bookmarkedCarListings->isNotEmpty())
            <x-page-header label='Bookmarked Car Listings' updatedClass='text-center' />
        @endif

        {{-- car listings container --}}
        <section
            class="car-listings {{ $bookmarkedCarListings->isNotEmpty() ? 'grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-7' : '' }} p-4">
            @forelse ($bookmarkedCarListings as $listing)
                <x-car-listing-card :listing="$listing" />
            @empty
                <x-no-data-message message="You have no bookmarked car listings" />
            @endforelse
        </section>

        {{-- pagination --}}
        <section class="pagination-option px-4 mt-2 mb-10">
            {{ $bookmarkedCarListings->links() }}
        </section>
        
    </div>
</x-layout>