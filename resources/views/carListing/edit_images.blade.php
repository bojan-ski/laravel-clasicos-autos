@php
$images = json_decode($listing->images)
@endphp

<x-layout>
    <div class="edit-car-listing-page container mx-auto mt-10">

        <div class="flex items-center justify-between mb-5">
            {{-- back to prev page button --}}
            <x-back-button />

            {{-- edit listing or images options --}}
            <x-editCarListingPage.edit-options :listing="$listing" />
        </div>

        {{-- page header --}}
        <x-page-header label='Edit Car Listing Images' updatedClass='text-center' />

        {{-- primary image & add new images --}}
        <x-editCarListingPage.edit-images-section-one :images="$images" :listing="$listing" />

        {{-- gallery images --}}
        <x-editCarListingPage.edit-images-section-two :images="$images" :listing="$listing" />

    </div>
</x-layout>