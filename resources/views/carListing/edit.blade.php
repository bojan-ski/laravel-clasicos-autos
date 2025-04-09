<x-layout>
    <div class="edit-car-listing-page container mx-auto mt-10">

        {{-- page header --}}
        <x-page-header label='Edit Car Listing' updatedClass='text-center' />

        {{-- create new car listing - form --}}
        <form method="POST" action="{{ route('listings.update', $listing) }}" class="mb-10" enctype="multipart/form-data">
            @csrf
            @method("PUT")

            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                {{-- name --}}
                <x-input-text id='name' name='name' label='Name *' value="{{ old('name', $listing->name) }}"
                    placeholder='Enter the car name' :required="true" />

                {{-- model --}}
                <x-input-text id='model' name='model' label='Model *' value="{{ old('model', $listing->model) }}"
                    placeholder='Enter the car model' :required="true" />

                {{-- car maker --}}
                <x-input-select id='car_maker' name='car_maker' label='Car Maker *' value="{{ old('car_maker', $listing->car_maker) }}"
                    disabledOptionLabel='Select car maker' :options="$carMakers" :required="true" />

                {{-- price --}}
                <x-input-text id='price' name='price' type='number' label='Price *' value="{{ old('price', $listing->price) }}"
                    placeholder='Enter the price' :required="true" />
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                {{-- year --}}
                <x-input-text id='year' name='year' type='number' label='Year *' min="1900" max="{{ date('Y') }}"
                    value="{{ old('year', $listing->year) }}" placeholder='Enter year' :required="true" />

                {{-- mileage --}}
                <x-input-text id='mileage' name='mileage' type='number' label='Mileage *'
                    value="{{ old('mileage', $listing->mileage) }}" placeholder='Enter the mileage' :required="true" />

                {{-- transmission --}}
                <x-input-select id='transmission' name='transmission' label='Transmission *'
                    value="{{ old('transmission', $listing->transmission) }}" :options="['Manual' => 'Manual', 'Automatic' => 'Automatic']"
                    disabledOptionLabel='Select the transmission' :required="true" />

                {{-- fuel type --}}
                <x-input-select id='fuel_type' name='fuel_type' label='Fuel type *' value="{{ old('fuel_type', $listing->fuel_type) }}"
                    disabledOptionLabel='Select fuel type' :options="['Gasoline' => 'Gasoline', 'Diesel' => 'Diesel']"
                    :required="true" />
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                {{-- engine size - null --}}
                <x-input-text id='engine_size' name='engine_size' label='Engine Size'
                    value="{{ old('engine_size', $listing->engine_size) }}" placeholder='Enter the engine size' />

                {{-- engine type - null --}}
                <x-input-text id='engine_type' name='engine_type' label='Engine Type'
                    value="{{ old('engine_type', $listing->engine_type) }}" placeholder='Enter the engine type' />

                {{-- engine history --}}
                <x-input-select id='engine_history' name='engine_history' label='Engine History *'
                    value="{{ old('engine_history', $listing->engine_history) }}" disabledOptionLabel='Select the engine history'
                    :options="['Original Engine' => 'Original Engine', 'Replaced Engine' => 'Replaced Engine', 'Rebuilt Engine' => 'Rebuilt Engine']"
                    :required="true" />

                {{-- engine condition --}}
                <x-input-select id='engine_condition' name='engine_condition' label='Engine Condition *'
                    value="{{ old('engine_condition', $listing->engine_condition) }}" disabledOptionLabel='Select the engine condition'
                    :options="['Running' => 'Running', 'Needs Tuning' => 'Needs Tuning', 'Not Running' => 'Not Running', 'Rebuilt Engine' => 'Rebuilt Engine', 'Original Factory Engine' => 'Original Factory Engine']"
                    :required="true" />
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                {{-- restoration history --}}
                <x-input-select id='restoration_history' name='restoration_history' label='Restoration History *'
                    value="{{ old('restoration_history', $listing->restoration_history) }}" disabledOptionLabel='Select the restoration history'
                    :options="['Fully Restored' => 'Fully Restored', 'Partially Restored' => 'Partially Restored', 'Barn Find' => 'Barn Find', 'Unrestored Original' => 'Unrestored Original']"
                    :required="true" />

                {{-- original parts percentage - null --}}
                <x-input-text id='original_parts_percentage' name='original_parts_percentage' type='number'
                    label='Original parts percentage' value="{{ old('original_parts_percentage', $listing->original_parts_percentage) }}"
                    placeholder='Original parts percentage (%)' />

                {{-- body type - null --}}
                <x-input-select id='body_type' name='body_type' label='Car Body Type' value="{{ old('body_type', $listing->body_type) }}"
                    disabledOptionLabel='Select the car body type'
                    :options="['Coupe' => 'Coupe', 'Sedan' => 'Sedan', 'Convertible' => 'Convertible', 'Wagon' => 'Wagon']" />
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                {{-- seat material - null --}}
                <x-input-select id='seat_material' name='seat_material' label='Seat Material'
                    value="{{ old('seat_material', $listing->seat_material) }}" disabledOptionLabel='Select the seat material'
                    :options="['Leather' => 'Leather', 'Cloth' => 'Cloth', 'Vinyl' => 'Vinyl', 'Velour' => 'Velour']" />

                {{-- odometer --}}
                <x-input-select id='odometer' name='odometer' label='Odometer *' value="{{ old('odometer', $listing->odometer) }}"
                    :options="['Original' => 'Original', 'Rebuilt' => 'Rebuilt', 'Unknown' => 'Unknown']"
                    disabledOptionLabel='Select odometer' :required="true" />

                {{-- license plate type - null --}}
                <x-input-select id='license_plate_type' name='license_plate_type' label='License Plate Type'
                    value="{{ old('license_plate_type', $listing->license_plate_type) }}"
                    :options="['Original Plate' => 'Original Plate', 'Modern Plate' => 'Modern Plate', 'No Plate' => 'No Plate']"
                    disabledOptionLabel='Select the license plate type' />

                {{-- documentation status --}}
                <x-input-select id='documentation_status' name='documentation_status' label='Documentation Status *'
                    value="{{ old('documentation_status', $listing->documentation_status) }}" disabledOptionLabel='Select the documentation status'
                    :options="['Original Papers' => 'Original Papers', 'Missing Papers' => 'Missing Papers', 'Custom Registration' => 'Custom Registration']"
                    :required="true" />
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                {{-- exterior color - null --}}
                <x-input-text id='exterior_color' name='exterior_color' label='Exterior Color'
                    value="{{ old('exterior_color', $listing->exterior_color) }}" placeholder='Enter the exterior color' />

                {{-- exterior condition - null --}}
                <x-input-select id='exterior_condition' name='exterior_condition' label='Exterior Condition'
                    value="{{ old('exterior_condition', $listing->exterior_condition) }}" disabledOptionLabel='Select the exterior condition'
                    :options="['Showroom Condition' => 'Showroom Condition', 'Good' => 'Good', 'Fair' => 'Fair', 'Needs Restoration' => 'Needs Restoration']" />

                {{-- interior color - null --}}
                <x-input-text id='interior_color' name='interior_color' label='Interior Color'
                    value="{{ old('interior_color', $listing->interior_color) }}" placeholder='Enter the interior color' />

                {{-- interior condition - null --}}
                <x-input-select id='interior_condition' name='interior_condition' label='Interior Condition'
                    value="{{ old('interior_condition', $listing->interior_condition) }}" disabledOptionLabel='Select the interior condition'
                    :options="['Showroom Condition' => 'Showroom Condition', 'Good' => 'Good', 'Fair' => 'Fair', 'Needs Restoration' => 'Needs Restoration']" />
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                {{-- city --}}
                <x-input-text id='location_city' name='location_city' label='City *' value="{{ old('location_city', $listing->location_city) }}"
                    placeholder='Enter the city name' :required="true" />

                {{-- state --}}
                <x-input-text id='location_state' name='location_state' label='State *' value="{{ old('location_state', $listing->location_state) }}"
                    placeholder='Enter the state name' :required="true" />

                {{-- zipcode --}}
                <x-input-text id='location_zipcode' name='location_zipcode' type='number' label='Zipcode *'
                    value="{{ old('location_zipcode', $listing->location_zipcode) }}" placeholder='Enter the zipcode' :required="true" />
            </div>

            <div class="grid grid-cols-1">
                {{-- description --}}
                <x-input-text-area id='description' name='description' label='Car description *'
                    value="{{ old('description', $listing->description) }}" placeholder='Enter car description' :required="true" />
            </div>

            {{-- submit button --}}
            <x-button type='submit' label='Update Car Listing' />
        </form>

    </div>
</x-layout>