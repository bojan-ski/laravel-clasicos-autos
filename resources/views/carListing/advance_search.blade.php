<x-layout>
    <div class="advance-search-page container mx-auto mt-10">

        <x-page-header label='Advance Search' updatedClass='text-center' />

        {{-- advance search - form --}}
        <form method="GET" action="{{ route('listings.filter') }}" class="mb-10">

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                {{-- model --}}
                <x-input-text id='model' name='model' label='Model' value="{{ request('model') }}"
                    placeholder='Enter the car model' />

                {{-- make --}}
                <x-input-select id='make' name='make' label='Make' value="{{ request('make') }}"
                    disabledOptionLabel='Select make'
                    :options="['Chevrolet' => 'Chevrolet', 'Ford' => 'Ford', 'Cadillac' => 'Cadillac', 'Buick' => 'Buick']" />

                {{-- mileage --}}
                <x-input-text id='mileage' name='mileage' type='number' label='Mileage' value="{{ request('mileage') }}"
                    placeholder='Enter the mileage' />
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                {{-- date - from --}}
                <x-input-text id='year_from' name='year_from' type='number' label='Year From' min="1900"
                    max="{{ date('Y') }}" value="{{ request('year_from') }}" placeholder='Enter starting year' />

                {{-- date - to --}}
                <x-input-text id='year_to' name='year_to' type='number' label='Year To' min="1900" max="{{ date('Y') }}"
                    value="{{ request('year_to') }}" placeholder='Enter ending year' />

                {{-- transmission --}}
                <x-input-select id='transmission' name='transmission' label='Transmission'
                    value="{{ request('transmission') }}" disabledOptionLabel='Select the transmission'
                    :options="['Manual' => 'Manual', 'Automatic' => 'Automatic']" />

                {{-- fuel type --}}
                <x-input-select id='fuel_type' name='fuel_type' label='Fuel type' value="{{ request('fuel_type') }}"
                    disabledOptionLabel='Select fuel type'
                    :options="['Gasoline' => 'Gasoline', 'Diesel' => 'Diesel']" />
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                {{-- engine size --}}
                <x-input-text id='engine_size' name='engine_size' label='Engine Size'
                    value="{{ request('engine_size') }}" placeholder='Enter the engine size' />

                {{-- engine type --}}
                <x-input-text id='engine_type' name='engine_type' label='Engine Type'
                    value="{{ request('engine_type') }}" placeholder='Enter the engine type' />

                {{-- Engine History --}}
                <x-input-select id='engine_history' name='engine_history' label='Engine History'
                    value="{{ request('engine_history') }}" disabledOptionLabel='Select the engine history'
                    :options="['Original Engine' => 'Original Engine', 'Replaced Engine' => 'Replaced Engine', 'Rebuilt Engine' => 'Rebuilt Engine']" />

                {{-- Engine Condition --}}
                <x-input-select id='engine_condition' name='engine_condition' label='Engine Condition'
                    value="{{ request('engine_condition') }}" disabledOptionLabel='Select the engine condition'
                    :options="['Running' => 'Running', 'Needs Tuning' => 'Needs Tuning', 'Not Running' => 'Not Running', 'Rebuilt Engine' => 'Rebuilt Engine', 'Original Factory Engine' => 'Original Factory Engine']" />
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                {{-- Restoration History --}}
                <x-input-select id='restoration_history' name='restoration_history' label='Restoration History'
                    value="{{ request('restoration_history') }}" disabledOptionLabel='Select the restoration history'
                    :options="['Fully Restored' => 'Fully Restored', 'Partially Restored' => 'Partially Restored', 'Barn Find' => 'Barn Find', 'Unrestored Original' => 'Unrestored Original']" />

                {{-- Body Type --}}
                <x-input-select id='body_type' name='body_type' label='Car Body Type' value="{{ request('body_type') }}"
                    disabledOptionLabel='Select the car body type'
                    :options="['Coupe' => 'Coupe', 'Sedan' => 'Sedan', 'Convertible' => 'Convertible', 'Wagon' => 'Wagon']" />

                {{-- Seat Material --}}
                <x-input-select id='seat_material' name='seat_material' label='Seat Material'
                    value="{{ request('seat_material') }}" disabledOptionLabel='Select the seat material'
                    :options="['Leather' => 'Leather', 'Cloth' => 'Cloth', 'Vinyl' => 'Vinyl', 'Velour' => 'Velour']" />
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                {{-- odometer --}}
                <x-input-select id='odometer' name='odometer' label='Odometer' value="{{ request('transmission') }}"
                    disabledOptionLabel='Select odometer'
                    :options="['Original' => 'Original', 'Rebuilt' => 'Rebuilt', 'Unknown' => 'Unknown']" />

                {{-- License Plate Type --}}
                <x-input-select id='license_plate_type' name='license_plate_type' label='License Plate Type'
                    value="{{ request('license_plate_type') }}" disabledOptionLabel='Select the license plate type'
                    :options="['Original Plate' => 'Original Plate', 'Modern Plate' => 'Modern Plate', 'No Plate' => 'No Plate']" />

                {{-- Documentation Status --}}
                <x-input-select id='original_parts_percentage' name='original_parts_percentage'
                    label='Documentation Status' value="{{ request('original_parts_percentage') }}"
                    disabledOptionLabel='Select the documentation status'
                    :options="['Original Papers' => 'Original Papers', 'Missing Papers' => 'Missing Papers', 'Custom Registration' => 'Custom Registration']" />
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                {{-- exterior color --}}
                <x-input-text id='exterior_color' name='exterior_color' label='Exterior Color'
                    value="{{ request('exterior_color') }}" placeholder='Enter the exterior color' />

                {{-- Exterior Condition --}}
                <x-input-select id='exterior_condition' name='exterior_condition' label='Exterior Condition'
                    value="{{ request('exterior_condition') }}" disabledOptionLabel='Select the exterior condition'
                    :options="['Showroom Condition' => 'Showroom Condition', 'Good' => 'Good', 'Fair' => 'Fair', 'Needs Restoration' => 'Needs Restoration']" />

                {{-- interior color --}}
                <x-input-text id='interior_color' name='interior_color' label='Interior Color'
                    value="{{ request('interior_color') }}" placeholder='Enter the interior color' />

                {{-- Interior Condition --}}
                <x-input-select id='interior_condition' name='interior_condition' label='Interior Condition'
                    value="{{ request('interior_condition') }}" disabledOptionLabel='Select the interior condition'
                    :options="['Showroom Condition' => 'Showroom Condition', 'Good' => 'Good', 'Fair' => 'Fair', 'Needs Restoration' => 'Needs Restoration']" />
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                {{-- city --}}
                <x-input-text id='city' name='city' label='City' value="{{ request('city') }}"
                    placeholder='Enter the city name' />

                {{-- state --}}
                <x-input-text id='state' name='state' label='State' value="{{ request('state') }}"
                    placeholder='Enter the state name' />

                {{-- zipcode --}}
                {{--
                <x-input-text id='zipcode' name='zipcode' type='number' label='Zipcode' value="{{ request('zip') }}"
                    placeholder='Enter the zipcode' /> --}}
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                {{-- price - from --}}
                <x-input-text id='price_from' name='price_from' type='number' label='Min Price'
                    value="{{ request('price_from') }}" placeholder='Enter the min price' />

                {{-- price - to --}}
                <x-input-text id='price_to' name='price_to' type='number' label='Max Price'
                    value="{{ request('price_to') }}" placeholder='Enter the max price' />
            </div>

            {{-- submit button --}}
            <x-button type='submit' label='Search' />
        </form>

        {{-- car listings container --}}
        @if (isset($result) && $result->count() > 0)
        <section class="container mx-auto">
            <div
                class="car-listings {{ $result->count() > 0 ? 'grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-7' : '' }}">
                @foreach ($result as $listing)
                <x-car-listing-card :listing="$listing" />
                @endforeach
            </div>

            {{-- pagination --}}
            <div class="pagination-option mt-2 mb-10">
                {{$result->links()}}
            </div>
        </section>
        @endif

    </div>
</x-layout>