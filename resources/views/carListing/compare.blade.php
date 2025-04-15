<x-layout>
    <div class="compare-car-listings-page container mx-auto mt-10">

        <div class="flex items-center justify-between mb-5">
            {{-- back to prev page button --}}
            <x-back-button />

            {{-- clear compare page/session --}}
            @if ($selectedCarListings->isNotEmpty())
            <a href="{{ route('compare.clear') }}"
                class="bg-red-600 text-white px-5 py-2 rounded-md hover:bg-red-700 font-semibold">
                <span class="hidden md:block">
                    Clear All
                </span>
                <span class="md:hidden">
                    <i class="fa-solid fa-x"></i>
                </span>
            </a>
            @endif
        </div>

        @if ($selectedCarListings->isNotEmpty())
        <x-page-header label="Compare Car Listings" updatedClass="text-center" />

        <div class="grid grid-cols-3 gap-5 mb-10">
            @foreach ([0, 'label', 1] as $index)
            <div class="{{ $index === 0 ? 'text-start' : ($index !== 1 ? 'text-center' : 'text-end') }}">
                @foreach ([
                'model' => 'Model',
                'car_maker' => 'Car Maker',
                'year' => 'Year',
                'mileage' => 'Mileage',
                'exterior_color' => 'Exterior Color',
                'interior_color' => 'Interior Color',
                'transmission' => 'Transmission',
                'fuel_type' => 'Fuel Type',
                'engine_size' => 'Engine Size',
                'engine_type' => 'Engine Type',
                'odometer'=> 'Odometer',
                'exterior_condition' => 'Exterior Condition',
                'interior_condition' => 'Interior Condition',
                'seat_material' => 'Seat Material',
                'engine_history' => 'Engine History',
                'engine_condition' => 'Engine Condition',
                'price' => 'Price',
                'location_city' => 'Location City',
                'location_state' => 'Location State',
                'body_type' => 'Body Type',
                'restoration_history' => 'Restoration History',
                'original_parts_percentage' => 'Original Parts (%)',
                'license_plate_type' => 'License Plate Type',
                'documentation_status' => 'Documentation'
                ] as $key => $label)
                <p
                    class="capitalize border-b mb-2 pb-1 text-xs md:text-base {{ $index === 'label' ? 'font-bold' : '' }}">
                    {{ $index === 'label' ? $label : ($selectedCarListings[$index]->$key ?? '-') }}
                </p>
                @endforeach

                @if ($index !== 'label')
                <div class="mt-5">
                    @php
                    $imageIndex = $index === 0 ? 0 : 1;
                    $image = isset($selectedCarListings[$index]) ? json_decode($selectedCarListings[$index]->images)[0]
                    ?? null : null;
                    @endphp
                    @if ($image)
                    <img src="{{ $image }}" alt="{{ $selectedCarListings[$index]->name }}"
                        class="rounded-lg shadow-md" />
                    @endif
                </div>
                @endif
            </div>
            @endforeach
        </div>
        @else
        <x-no-data-message message="No car listings were selected for comparison" />
        @endif
        
    </div>
</x-layout>