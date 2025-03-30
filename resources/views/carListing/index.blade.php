<x-layout>
    <div class="car-listings-page container mx-auto mt-10">
        {{-- search option --}}
        <section class="search-option text-center mb-5">
            <x-search-option />            
        </section>

        {{-- car listings container --}}
        <section class="car-listings {{ $listings->count() > 0 ? 'grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-7' : '' }} p-4">
            @forelse ($listings as $listing)
                <x-car-listing-card :listing="$listing" />
            @empty
                <x-no-data-message label="No car listings available, please come back later" />
            @endforelse
        </section>

        {{-- pagination --}}
        <section class="pagination-option px-4 mt-2 mb-10">
            {{ $listings->links() }}
        </section>
    </div>
</x-layout>