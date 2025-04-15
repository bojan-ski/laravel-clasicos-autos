<x-layout>
    <div class="car-listing-owner-page container mx-auto mt-10">

        {{-- back to prev page button --}}
        <div class="flex mb-5">
            <x-back-button />
        </div>

        {{-- page header --}}
        <x-page-header label="{{ $carListingOwner->username }}'s car listings" updatedClass="text-center" />

        {{-- car listings container --}}
        <section
            class="car-listings pt-5 {{ $listings->isNotEmpty() ? 'grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-7' : '' }}">
            @forelse ($listings as $listing)
            <x-car-listing-card :listing="$listing" />
            @empty
            <x-no-data-message message="No car listings available, please come back later" />
            @endforelse
        </section>

        {{-- pagination --}}
        <section class="pagination-option px-4 mt-2 mb-10">
            {{ $listings->links() }}
        </section>

    </div>
</x-layout>