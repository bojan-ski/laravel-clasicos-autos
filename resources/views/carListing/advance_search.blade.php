<x-layout>
    <div class="advance-search-page container mx-auto mt-10">

        <x-page-header label='Advance Search' updatedClass='text-center' />

        {{-- advance search - form --}}
        <x-advance-search-option :makers="$carMakers"/>

        {{-- if result --}}
        @if (isset($advanceSearchResult) && $advanceSearchResult->count() > 0)
        <div class="container mx-auto">
            {{-- car listings container --}}
            <section
                class="car-listings {{ $advanceSearchResult->count() > 0 ? 'grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-7' : '' }}">
                @foreach ($advanceSearchResult as $listing)
                <x-car-listing-card :listing="$listing" />
                @endforeach
            </section>

            {{-- pagination --}}
            <section class="pagination-option mt-2 mb-10">
                {{ $advanceSearchResult->links() }}
            </section>
        </div>
        @endif

    </div>
</x-layout>