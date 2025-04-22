@props([
'images',
'listing'
])

<section class="gallery-images grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 mb-10">
    @foreach($images as $image)
        <div class="gallery-image bg-white rounded-2xl shadow-md border border-yellow-300 p-3">
            <img src="{{ Str::startsWith($image, 'http') ? $image : Storage::url($image) }}" alt="car-listing-img"
                class="w-full h-[400px] md:h-[300px] lg:h-[250px] object-cover rounded-md mb-2 border border-gray-300">

            <div class="gallery-image-options flex items-center justify-between">
                {{-- set image as primary image --}}
                <x-editCarListingPage.image-option :image="$image" :listing="$listing" route="listings.setAsPrimaryImage"
                    bgColor="bg-yellow-500" bgColorHover="bg-yellow-600" btnText="Primary" />

                {{-- delete image --}}
                <x-editCarListingPage.image-option :image="$image" :listing="$listing" route="listings.destroyImage"
                    :method="true" bgColor="bg-red-500" bgColorHover="bg-red-600" btnText="Delete" />
            </div>
        </div>
    @endforeach
</section>