<x-layout>
    <div class="container mx-auto mt-10">

        <div class="flex items-center justify-between mb-5">
            {{-- back to prev page button --}}
            <x-back-button />

            {{-- edit/delete option --}}
            @can('update', $listing)
            <div class="flex items-center justify-between">
                <a href="{{ route('listings.edit', $listing) }}"
                    class="bg-yellow-600 text-white px-4 py-2 rounded-md hover:bg-yellow-700 font-semibold cursor-pointer mr-5">
                    <i class="fa-regular fa-pen-to-square"></i>
                </a>

                {{-- delete --}}
                <x-selectedCarListingPage.delete-car-listing-option :listing="$listing" />
            </div>
            @endcan
        </div>

        <h2>
            {{ $listing->name }}
        </h2>

    </div>
</x-layout>