<x-layout>
    <div class="container mx-auto mt-10">
        <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 p-4">            
            @forelse ($listings as $listing)
            <x-car-listing-card :listing="$listing" />
            @empty
            <x-no-data-message label="No car listings available, please come back later" />
            @endforelse
        </section>

        {{-- pagination --}}
        <section class="pagination-option px-4 mt-2 mb-10">
            {{$listings->links()}}
        </section>
    </div>
</x-layout>