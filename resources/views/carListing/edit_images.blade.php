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


    </div>
</x-layout>