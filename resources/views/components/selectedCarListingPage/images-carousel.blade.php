@props(['images'])

<div class="col-span-2 bg-white p-2 mb-5 lg:mb-0 rounded-lg shadow-md border border-yellow-500">
    {{-- main img --}}
    <div class="aspect-video">
        <img id="main-image"
            src="{{ Str::startsWith($images[0], 'http') ? $images[0] : Storage::url($images[0]) }}"
            alt="car-listing-img" class="w-full h-full object-cover rounded-md transition duration-300">
    </div>

    {{-- thumbnails --}}
    @if (count($images) > 1)
        <div class="grid grid-cols-4 gap-2 mt-4">
            @foreach($images as $image)
                <img id="thumbnail" src="{{ Str::startsWith($image, 'http') ? $image : Storage::url($image) }}"
                    alt="car-listing-img"
                    class="w-full h-20 object-cover rounded-md border border-gray-300 hover:ring-2 ring-yellow-400 cursor-pointer">
            @endforeach
        </div>
    @endif
</div>