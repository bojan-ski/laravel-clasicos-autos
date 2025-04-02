<x-layout>
    <div class="advance-search-page container mx-auto mt-10">

        <x-page-header label='Advance Search' updatedClass='text-center' />

        {{-- advance search - form --}}
        <x-advance-search-option :makers="$carMakers"/>

        {{-- if result --}}
        @if (isset($advanceSearchResult) && $advanceSearchResult->isNotEmpty())
        <div class="container mb-10 mx-auto">
            {{-- car listings container --}}
            <section
                class="car-listings mb-10 {{ $advanceSearchResult->isNotEmpty() ? 'grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-7' : '' }}">
                @foreach ($advanceSearchResult as $listing)
                <x-car-listing-card :listing="$listing" />
                @endforeach
            </section>

            {{-- pagination --}}
            <section class="pagination-option">
                {{ $advanceSearchResult->links() }}
            </section>
        </div>
        @endif

    </div>     
</x-layout>