@props(['listing'])

<div class="bg-white shadow-lg border-1 border-yellow-500 rounded-xl overflow-hidden hover:shadow-2xl">
    <div class="mb-4">
        <img src="{{ json_decode($listing->images)[0] }}" alt="{{ $listing->name }}" class="w-full h-[400px] md:h-[300px] lg:h-[250px] object-cover"/>
    </div>

    <div class="flex items-center justify-between px-4">
        {{-- compare feature --}}
        <x-carListingCard.compare-option :listing="$listing"/>

        {{-- bookmark feature --}}
        @if (!auth()->user() || auth()->user()->id !== $listing->user_id)
        <x-carListingCard.bookmark-option :listing="$listing"/>            
        @endif
    </div>

    <div class="p-4">
        <h3 class="text-lg font-bold text-red-600 mb-3">
            {{ Str::limit($listing->name, 20) }}
        </h3>
        <div class="mb-3">
            <p class="font-semibold mb-1">
                <i class="fa-solid fa-car mr-2"></i> {{ $listing->car_maker }} - {{ $listing->model }}
            </p>
            <p class="font-semibold mb-1">
                <i class="fa-solid fa-gas-pump mr-2"></i> {{ $listing->fuel_type }}
            </p>
            <p class=" font-semibold mb-1">
                <i class="fa-solid fa-calendar-days mr-2"></i> {{ $listing->year }}
            </p>
            <p class="text-red-600 text-xl font-bold text-end">
                ${{ number_format($listing->price) }}
            </p>
        </div>

        <div class="flex items-center justify-between">
            <a href="{{ route('listings.show', $listing->id) }}"
                class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md font-semibold">
                Details
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