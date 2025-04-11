@php
$images = json_decode($listing->images)
@endphp

<x-layout>
    <div class="edit-car-listing-page container mx-auto mt-10">

        <div class="flex items-center justify-between mb-5">
            {{-- back to prev page button --}}
            <x-back-button />

            {{-- Edit listing or images options --}}
            <x-editCarListingPage.edit-options :listing="$listing" />
        </div>

        {{-- page header --}}
        <x-page-header label='Edit Car Listing Images' updatedClass='text-center' />

        {{-- edit new car listing - car listing images --}}
        {{-- primary image & add new images --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 border-b border-amber-500 pb-5 mb-5">
            {{-- main img --}}
            <div class="bg-white p-2 mb-5 lg:mb-0 rounded-lg shadow-md border border-yellow-500">
                <img src="{{ Str::startsWith($images[0], 'http') ? $images[0] : Storage::url($images[0]) }}"
                    alt="car-listing-img" class="w-full h-full object-cover rounded-md">
            </div>

            {{-- add new images --}}
            <x-input-file-upload id='images' name='images[]' label='Add new images *' :required="true" />
        </div>

        <div class="gallery-images grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 mb-10">
            @foreach($images as $image)
            <div class="gallery-image">
                <img src="{{ Str::startsWith($image, 'http') ? $image : Storage::url($image) }}"
                    alt="car-listing-img"
                    class="w-full object-cover rounded-md mb-2 border border-gray-300 hover:ring-2 ring-yellow-400">

                <div class="gallery-image-options flex items-center justify-between">
                    <form method="POST" action="{{ route('listings.setAsPrimaryImage', $listing) }}">
                        @csrf

                        <x-input-text id='image' name='image' type='hidden' value="{{ Str::startsWith($image, 'http') ? $image : Storage::url($image) }}" />

                        <button type="submit" class="btn">
                            Primary
                        </button>
                    </form>

                    <form method="POST" action="{{ route('listings.destroyImage', $listing) }}">
                        @csrf
                        @method("DELETE")

                        <x-input-text id='image' name='image' type='hidden' value="{{ Str::startsWith($image, 'http') ? $image : Storage::url($image) }}" />

                        <button type="submit" class="btn">
                            Delete
                        </button>
                    </form>                    
                </div>
            </div>
            @endforeach
        </div>

    </div>
</x-layout>