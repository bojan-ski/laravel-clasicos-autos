@props(['listing'])

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