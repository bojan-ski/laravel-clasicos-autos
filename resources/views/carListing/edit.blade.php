<x-layout>
    <div class="edit-car-listing-page container mx-auto mt-10">

        <div class="flex items-center justify-between mb-5">
            {{-- back to prev page button --}}
            <x-back-button />

            {{-- Edit listing or images options --}}
            <x-editCarListingPage.edit-options :listing="$listing" />
        </div>

        {{-- page header --}}
        <x-page-header label='Edit Car Listing Data' updatedClass='text-center' />

        {{-- edit car listing - listing data - form --}}
        <x-editCarListingPage.edit-listing-form :listing="$listing" :carMakers="$carMakers" />

    </div>
</x-layout>