@php
$images = json_decode($listing->images);
@endphp

<x-layout>
    <div class="container mx-auto mt-10">

        <div class="flex items-center justify-between mb-5">
            {{-- back to prev page button --}}
            <x-back-button />

            {{-- Edit/Delete options --}}
            @can('update', $listing)
            <div class="flex items-center justify-between">
                {{-- edit listing --}}
                <a href="{{ route('listings.edit', $listing) }}"
                    class="bg-yellow-600 text-white px-4 py-2 rounded-md hover:bg-yellow-700 font-semibold cursor-pointer mr-5">
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
            @endcan
        </div>

        {{-- Page header --}}
        <x-page-header label="{{ $listing->car_maker }} - {{ $listing->model }} - {{ $listing->year }}"
            updatedClass="text-center text-2xl font-bold text-red-700 mb-5" />

        {{-- Car listing price --}}
        <h3 class="text-center text-3xl font-bold text-red-700 mb-7">
            ${{ number_format($listing->price) }}
        </h3>

        {{-- Image carousel & Primary information --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 lg:gap-5 mb-5">
            {{-- image carousel --}}
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

            {{-- Car & Car listing owner information --}}
            <div>
                {{-- car Information --}}
                <div class="bg-white p-6 rounded-lg shadow-md border border-yellow-500 mb-5">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">
                        {{ $listing->name }}
                    </h2>

                    <dl class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-4 text-sm">
                        <div>
                            <dt class="font-bold">
                                Make
                            </dt>
                            <dd>
                                {{ $listing->car_maker }}
                            </dd>
                        </div>
                        <div>
                            <dt class="font-bold">
                                Model
                            </dt>
                            <dd>
                                {{ $listing->model }}
                            </dd>
                        </div>
                        <div>
                            <dt class="font-bold">
                                Year
                            </dt>
                            <dd>
                                {{ $listing->year }}
                            </dd>
                        </div>
                        <div>
                            <dt class="font-bold">
                                Mileage
                            </dt>
                            <dd>
                                {{ number_format($listing->mileage) }} km
                            </dd>
                        </div>
                        <div>
                            <dt class="font-bold">
                                Transmission
                            </dt>
                            <dd>
                                {{ $listing->transmission }}
                            </dd>
                        </div>
                        <div>
                            <dt class="font-bold">
                                Fuel Type
                            </dt>
                            <dd>
                                {{ $listing->fuel_type }}
                            </dd>
                        </div>
                        @if($listing->engine_size || $listing->engine_type)
                        <div>
                            <dt class="font-bold">
                                Engine
                            </dt>
                            <dd>
                                {{ $listing->engine_size }} {{ $listing->engine_type }}
                            </dd>
                        </div>
                        @endif
                        <div>
                            <dt class="font-bold">
                                Location
                            </dt>
                            <dd>
                                {{ $listing->location_city }}, {{ $listing->location_state }} ({{
                                $listing->location_zipcode
                                }})
                            </dd>
                        </div>
                        <div>
                            <dt class="font-bold">
                                Posted:
                            </dt>
                            <dd>
                                {{ (\Carbon\Carbon::parse($listing->created_at)->format('d F Y')) }}
                            </dd>
                        </div>
                    </dl>
                </div>

                {{-- Owner Info Section --}}
                <div class="bg-white p-6 rounded-lg shadow-md border border-yellow-500">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">
                        Owner Information:
                    </h3>

                    <div class="flex items-center gap-4">
                        <div class="text-sm text-gray-700">
                            <p class="mb-2">
                                <strong>Name:</strong> {{ $carListingOwner->username }}
                            </p>
                            <p class="mb-2">
                                <strong>Email:</strong> {{ $carListingOwner->email }}
                            </p>
                            <p class="mb-2">
                                {{-- FIX THIS --}}
                                <strong>Phone:</strong> 123/456789
                                {{-- FIX THIS --}}
                            </p>
                            <p class="mb-2">
                                <strong>Joined:</strong> {{
                                \Carbon\Carbon::parse($carListingOwner->created_at)->format('d F Y') }}
                            </p>
                            <p class="mb-2">
                                <strong>Total num. of listing:</strong> {{ $totalNumOfCarListings }}
                            </p>
                            <a href="{{ route('listingOwner.index') }}"
                                class="text-blue-500 hover:text-blue-600 font-bold"
                                onclick="{{ session()->put('car_listing_owner', $listing->user_id); }}">
                                See all {{ $carListingOwner->username }}'s listings
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        {{-- Description Section --}}
        <div class="bg-white rounded-lg shadow-md p-6 border border-yellow-500 mb-5">
            <h3 class="text-lg font-semibold text-gray-800 mb-2">
                Car Description
            </h3>

            <p class="text-gray-700 leading-relaxed">
                {{ $listing->description }}
            </p>
        </div>

        {{-- Additional Details --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-10">
            <div class="bg-white p-4 rounded-lg shadow border border-yellow-500">
                <h4 class="text-md font-bold mb-3">
                    Exterior & Interior
                </h4>
                <ul class="list-disc list-inside text-gray-700 space-y-1">
                    @if ($listing->body_type)
                    <li>
                        <span class="font-semibold">Body Type:</span>
                        {{ ucfirst($listing->body_type) }}
                    </li>
                    @endif
                    @if ($listing->exterior_color)
                    <li>
                        <span class="font-semibold">Exterior Color:</span>
                        {{ ucfirst($listing->exterior_color) }}
                    </li>
                    @endif
                    @if ($listing->interior_color)
                    <li>
                        <span class="font-semibold">Interior Color:</span>
                        {{ ucfirst($listing->interior_color) }}
                    </li>
                    @endif
                    @if ($listing->exterior_condition)
                    <li>
                        <span class="font-semibold">Condition (Exterior):</span>
                        {{ $listing->exterior_condition }}
                    </li>
                    @endif
                    @if ($listing->interior_condition)
                    <li>
                        <span class="font-semibold">Condition (Interior):</span>
                        {{ $listing->interior_condition }}
                    </li>
                    @endif
                    @if ($listing->seat_material)
                    <li>
                        <span class="font-semibold">Seat Material:</span>
                        {{ $listing->seat_material }}
                    </li>
                    @endif
                </ul>
            </div>

            <div class="bg-white p-4 rounded-lg shadow border border-yellow-500">
                <h4 class="text-md font-bold mb-3">Engine & History</h4>
                <ul class="list-disc list-inside text-gray-700 space-y-1">
                    <li>
                        <span class="font-semibold">Engine History:</span>
                        {{ $listing->engine_history }}
                    </li>
                    <li>
                        <span class="font-semibold">Engine Condition:</span>
                        {{ $listing->engine_condition }}
                    </li>
                    <li>
                        <span class="font-semibold">Odometer:</span>
                        {{ $listing->odometer }}
                    </li>
                    @if ($listing->restoration_history)
                    <li>
                        <span class="font-semibold">Restoration:</span>
                        {{ $listing->restoration_history }}
                    </li>
                    @endif
                    @if ($listing->original_parts_percentage)
                    <li>
                        <span class="font-semibold">Original Parts:</span>
                        {{ $listing->original_parts_percentage }}%
                    </li>
                    @endif
                    @if ($listing->license_plate_type)
                    <li>
                        <span class="font-semibold">License Plate Type:</span>
                        {{ $listing->license_plate_type }}
                    </li>
                    @endif
                    <li>
                        <span class="font-semibold">Documentation:</span>
                        {{ $listing->documentation_status }}
                    </li>
                </ul>
            </div>
        </div>

    </div>
</x-layout>