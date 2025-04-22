@props(['listing'])

<div class="flex items-center justify-between">
    {{-- edit listing --}}
    <a href="{{ route('listings.edit', $listing) }}"
        class="bg-yellow-600 text-white px-4 py-2 rounded-md hover:bg-yellow-700 transition font-semibold cursor-pointer mr-5 {{ Route::is('listings.edit') ? 'bg-yellow-700' : '' }}">
        <span class="hidden md:block">
            Edit Listing
        </span>
        <span class="md:hidden">
            <i class="fa-regular fa-file-lines"></i>
        </span>
    </a>

    {{-- edit images --}}
    <a href="{{ route('listings.editImages', $listing) }}"
        class="bg-yellow-600 text-white px-4 py-2 rounded-md hover:bg-yellow-700 transition font-semibold cursor-pointer {{ Route::is('listings.editImages') ? 'bg-yellow-700' : '' }}">
        <span class="hidden md:block">
            Edit Images
        </span>
        <span class="md:hidden">
            <i class="fa-solid fa-image"></i>
        </span>
    </a>
</div>