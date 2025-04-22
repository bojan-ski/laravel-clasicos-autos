<x-layout>
    <div class="create-car-listing-page container mx-auto mt-10">

        {{-- page header --}}
        <x-page-header label='Create Car Listing' updatedClass='text-center' />

        {{-- create new car listing - form --}}
        <form method="POST" action="{{ route('listings.store') }}" class="mb-10" enctype="multipart/form-data">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                {{-- name --}}
                <x-input-text id='name' name='name' label='Name *' value="{{ request('name') }}"
                    placeholder='Enter the car name' :required="true" />

                {{-- model --}}
                <x-input-text id='model' name='model' label='Model *' value="{{ request('model') }}"
                    placeholder='Enter the car model' :required="true" />

                {{-- car maker --}}
                <x-input-select id='car_maker' name='car_maker' label='Car Maker *' value="{{ request('car_maker') }}"
                    disabledOptionLabel='Select car maker' :options="$carMakers" :required="true" />

                {{-- price --}}
                <x-input-text id='price' name='price' type='number' label='Price *' value="{{ request('price') }}"
                    placeholder='Enter the price' :required="true" />
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                {{-- year --}}
                <x-input-text id='year' name='year' type='number' label='Year *' min="1900" max="{{ date('Y') }}"
                    value="{{ request('year') }}" placeholder='Enter year' :required="true" />

                {{-- mileage --}}
                <x-input-text id='mileage' name='mileage' type='number' label='Mileage *'
                    value="{{ request('mileage') }}" placeholder='Enter the mileage' :required="true" />

                {{-- transmission --}}
                <x-input-select id='transmission' name='transmission' label='Transmission *'
                    value="{{ request('transmission') }}" :options="['Manual' => 'Manual', 'Automatic' => 'Automatic']"
                    disabledOptionLabel='Select the transmission' :required="true" />

                {{-- fuel type --}}
                <x-input-select id='fuel_type' name='fuel_type' label='Fuel type *' value="{{ request('fuel_type') }}"
                    disabledOptionLabel='Select fuel type' :options="['Gasoline' => 'Gasoline', 'Diesel' => 'Diesel']"
                    :required="true" />
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                {{-- engine size - null --}}
                <x-input-text id='engine_size' name='engine_size' label='Engine Size'
                    value="{{ request('engine_size') }}" placeholder='Enter the engine size' />

                {{-- engine type - null --}}
                <x-input-text id='engine_type' name='engine_type' label='Engine Type'
                    value="{{ request('engine_type') }}" placeholder='Enter the engine type' />

                {{-- engine history --}}
                <x-input-select id='engine_history' name='engine_history' label='Engine History *'
                    value="{{ request('engine_history') }}" disabledOptionLabel='Select the engine history'
                    :options="['Original Engine' => 'Original Engine', 'Replaced Engine' => 'Replaced Engine', 'Rebuilt Engine' => 'Rebuilt Engine']"
                    :required="true" />

                {{-- engine condition --}}
                <x-input-select id='engine_condition' name='engine_condition' label='Engine Condition *'
                    value="{{ request('engine_condition') }}" disabledOptionLabel='Select the engine condition'
                    :options="['Running' => 'Running', 'Needs Tuning' => 'Needs Tuning', 'Not Running' => 'Not Running', 'Rebuilt Engine' => 'Rebuilt Engine', 'Original Factory Engine' => 'Original Factory Engine']"
                    :required="true" />
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                {{-- restoration history --}}
                <x-input-select id='restoration_history' name='restoration_history' label='Restoration History *'
                    value="{{ request('restoration_history') }}" disabledOptionLabel='Select the restoration history'
                    :options="['Fully Restored' => 'Fully Restored', 'Partially Restored' => 'Partially Restored', 'Barn Find' => 'Barn Find', 'Unrestored Original' => 'Unrestored Original']"
                    :required="true" />

                {{-- original parts percentage - null --}}
                <x-input-text id='original_parts_percentage' name='original_parts_percentage' type='number'
                    label='Original parts percentage' value="{{ request('original_parts_percentage') }}"
                    placeholder='Original parts percentage (%)' />

                {{-- body type - null --}}
                <x-input-select id='body_type' name='body_type' label='Car Body Type' value="{{ request('body_type') }}"
                    disabledOptionLabel='Select the car body type'
                    :options="['Coupe' => 'Coupe', 'Sedan' => 'Sedan', 'Convertible' => 'Convertible', 'Wagon' => 'Wagon']" />
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                {{-- seat material - null --}}
                <x-input-select id='seat_material' name='seat_material' label='Seat Material'
                    value="{{ request('seat_material') }}" disabledOptionLabel='Select the seat material'
                    :options="['Leather' => 'Leather', 'Cloth' => 'Cloth', 'Vinyl' => 'Vinyl', 'Velour' => 'Velour']" />

                {{-- odometer --}}
                <x-input-select id='odometer' name='odometer' label='Odometer *' value="{{ request('odometer') }}"
                    :options="['Original' => 'Original', 'Rebuilt' => 'Rebuilt', 'Unknown' => 'Unknown']"
                    disabledOptionLabel='Select odometer' :required="true" />

                {{-- license plate type - null --}}
                <x-input-select id='license_plate_type' name='license_plate_type' label='License Plate Type'
                    value="{{ request('license_plate_type') }}"
                    :options="['Original Plate' => 'Original Plate', 'Modern Plate' => 'Modern Plate', 'No Plate' => 'No Plate']"
                    disabledOptionLabel='Select the license plate type' />

                {{-- documentation status --}}
                <x-input-select id='documentation_status' name='documentation_status' label='Documentation Status *'
                    value="{{ request('documentation_status') }}" disabledOptionLabel='Select the documentation status'
                    :options="['Original Papers' => 'Original Papers', 'Missing Papers' => 'Missing Papers', 'Custom Registration' => 'Custom Registration']"
                    :required="true" />
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                {{-- exterior color - null --}}
                <x-input-text id='exterior_color' name='exterior_color' label='Exterior Color'
                    value="{{ request('exterior_color') }}" placeholder='Enter the exterior color' />

                {{-- exterior condition - null --}}
                <x-input-select id='exterior_condition' name='exterior_condition' label='Exterior Condition'
                    value="{{ request('exterior_condition') }}" disabledOptionLabel='Select the exterior condition'
                    :options="['Showroom Condition' => 'Showroom Condition', 'Good' => 'Good', 'Fair' => 'Fair', 'Needs Restoration' => 'Needs Restoration']" />

                {{-- interior color - null --}}
                <x-input-text id='interior_color' name='interior_color' label='Interior Color'
                    value="{{ request('interior_color') }}" placeholder='Enter the interior color' />

                {{-- interior condition - null --}}
                <x-input-select id='interior_condition' name='interior_condition' label='Interior Condition'
                    value="{{ request('interior_condition') }}" disabledOptionLabel='Select the interior condition'
                    :options="['Showroom Condition' => 'Showroom Condition', 'Good' => 'Good', 'Fair' => 'Fair', 'Needs Restoration' => 'Needs Restoration']" />
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                {{-- city --}}
                <x-input-text id='location_city' name='location_city' label='City *' value="{{ request('city') }}"
                    placeholder='Enter the city name' :required="true" />

                {{-- state --}}
                <x-input-text id='location_state' name='location_state' label='State *' value="{{ request('state') }}"
                    placeholder='Enter the state name' :required="true" />

                {{-- zipcode --}}
                <x-input-text id='location_zipcode' name='location_zipcode' type='number' label='Zipcode *'
                    value="{{ request('zipcode') }}" placeholder='Enter the zipcode' :required="true" />
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                {{-- description --}}
                <x-input-text-area id='description' name='description' label='Car description *'
                    value="{{ request('description') }}" placeholder='Enter car description' :required="true" />

                {{-- images --}}
                <x-input-file-upload id='images' name='images' label='Car images - max 8 *' :required="true" />
            </div>

            {{-- submit button --}}
            <x-button type='submit' label='Add Car Listing' />
        </form>

    </div>
</x-layout>