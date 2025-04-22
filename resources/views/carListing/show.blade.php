@php
$images = json_decode($listing->images);
@endphp

<x-layout>
    <div class="selected-car-listing-page container mx-auto mt-10">

        <div class="flex items-center justify-between mb-5">
            {{-- back to prev page button --}}
            <x-back-button />

            {{-- Edit/Delete options --}}
            @can('update', $listing)
                <x-selectedCarListingPage.edit-delete-options :listing="$listing" />
            @endcan
        </div>

        {{-- Page header --}}
        <x-page-header label="{{ $listing->car_maker }} - {{ $listing->model }} - {{ $listing->year }}"
            updatedClass="text-center text-2xl font-bold text-red-700 mb-5" />

        {{-- Car listing price --}}
        <h3 class="text-center text-3xl font-bold text-red-700 mb-7">
            ${{ number_format($listing->price) }}
        </h3>

        {{-- Images carousel & Primary information --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 lg:gap-5 mb-5">
            {{-- images carousel --}}
            <x-selectedCarListingPage.images-carousel :images="json_decode($listing->images)" />

            {{-- Car & Car listing owner information --}}
            <div>
                {{-- car Information --}}
                <x-selectedCarListingPage.primary-car-listing-information :listing="$listing" />

                {{-- Owner Info Section --}}
                <x-selectedCarListingPage.car-listing-owner-information :listing="$listing" :carListingOwner="$carListingOwner"
                    :totalNumOfCarListings="$totalNumOfCarListings" />
            </div>
        </div>

        {{-- Description Section --}}
        <x-selectedCarListingPage.car-listing-desc :description="$listing->description" />

        {{-- Additional Details --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-10">
            {{-- car looks --}}
            <x-selectedCarListingPage.car-look :listing="$listing" />

            {{-- engine & history --}}
            <x-selectedCarListingPage.car-engine-history :listing="$listing" />
        </div>       

    </div>
</x-layout>