@props(['listing'])

<div class="flex items-center justify-between">
    {{-- edit listing --}}
    <a href="{{ route('listings.edit', $listing) }}"
        class="bg-yellow-600 text-white px-4 py-2 rounded-md hover:bg-yellow-700 transition font-semibold cursor-pointer mr-5">
        <span class="hidden md:block">
            Edit
        </span>
        <span class="md:hidden">
            <i class="fa-regular fa-pen-to-square"></i>
        </span>
    </a>

    {{-- delete listing --}}
    <x-selectedCarListingPage.delete-car-listing-option :listing="$listing" />
</div>