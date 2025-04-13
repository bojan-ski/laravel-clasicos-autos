@props([
'images',
'listing'
])

<section class="grid grid-cols-1 md:grid-cols-2 gap-4 border-b border-yellow-500 pb-5 mb-5">
    {{-- primary img --}}
    <div class="bg-white p-2 lg:mb-0 rounded-lg shadow-md border border-yellow-500">
        <img src="{{ Str::startsWith($images[0], 'http') ? $images[0] : Storage::url($images[0]) }}"
            alt="car-listing-img" class="w-full h-auto max-h-[600px] object-cover rounded-md border border-gray-300">
    </div>

    {{-- add new image/images --}}
    <form method="POST" action="{{ route('listings.addNewImages', $listing) }}" enctype="multipart/form-data">
        @csrf

        <x-input-file-upload id='images' name='images[]' label='Add new images *' :required="true" />

        <button type="submit"
            class="mt-4 bg-blue-500 text-white px-3 py-2 rounded-md shadow hover:bg-blue-600 transition font-semibold cursor-pointer">
            Add images
        </button>
    </form>
</section>