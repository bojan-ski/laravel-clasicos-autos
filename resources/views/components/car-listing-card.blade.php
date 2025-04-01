@props(['listing'])

<div class="bg-white shadow-lg border-1 border-yellow-500 rounded-xl overflow-hidden hover:shadow-2xl">
    <div class="mb-4">
        <img src="{{ json_decode($listing->images)[0] }}" alt="{{ $listing->name }}" />
    </div>

    <div class="flex items-center justify-between px-4">
        {{-- bookmark feature --}}
        <x-carListingCard.bookmark-option :listing="$listing"/>

        {{-- compare feature --}}
        <x-carListingCard.compare-option :listing="$listing"/>
    </div>

    <div class="p-4">
        <h3 class="text-xl font-bold text-red-600 mb-3">
            {{ $listing->name }}
        </h3>
        <div class="mb-3">
            <p class=" font-semibold mb-1">
                <i class="fa-solid fa-car mr-2"></i> {{ $listing->car_maker }} - {{ $listing->model }} -
                {{ $listing->fuel_type }}
            </p>
            <p class=" font-semibold mb-1">
                <i class="fa-solid fa-calendar-days mr-2"></i> {{ $listing->year }}
            </p>
            <p class="text-yellow-700 text-2xl font-bold text-end">
                ${{ number_format($listing->price) }}
            </p>
        </div>

        <div class="flex items-center justify-between">
            <a href="{{ route('listings.show', $listing->id) }}"
                class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700 font-semibold">
                View Details
            </a>
            <span class="font-semibold">
                {{
                (date('d') - (\Carbon\Carbon::parse($listing->created_at)->day)) == 0 ? 'Posted: Today' : 'Posted: ' .
                (date('d') - (\Carbon\Carbon::parse($listing->created_at)->day)) . ' ago'
                }}
            </span>
        </div>
    </div>
</div>