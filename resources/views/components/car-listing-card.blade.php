@props(['listing'])

<div class="bg-white shadow-lg border-1 border-yellow-500 rounded-xl overflow-hidden hover:shadow-2xl">
    <div class="mb-4">
        <img src="{{ json_decode($listing->images)[0] }}" alt="{{ $listing->name }}" />
    </div>

    <div class="flex items-center justify-between px-4">
        {{-- bookmark feature --}}
        <form method="POST" action="{{ route('listings.bookmark', $listing->id) }}">
            @csrf
            @if (auth()->user() && auth()->user()->userBookmarks()->where('car_listing_id', $listing->id)->exists())
            @method("DELETE")
            <button type="submit" class="btn bg-red-500 text-white hover:bg-transparent hover:text-red-500">
                <i class="fa-regular fa-bookmark"></i>
            </button>
            @else
            <button type="submit" class="btn text-red-500 hover:bg-red-500 hover:text-white">
                <i class="fa-regular fa-bookmark"></i>
            </button>
            @endif
        </form>

        {{-- compare feature --}}
        <form method="POST"
            action="{{ !in_array($listing->id, session('compare_listings', [])) ? route('compare.add', $listing->id) : route('compare.remove', $listing->id) }}">
            @csrf

            @if (in_array($listing->id, session('compare_listings', [])))
            <button type="submit" class="btn bg-red-500 text-white hover:bg-transparent hover:text-red-500">
                <i class="fa-solid fa-code-compare"></i>
            </button>
            @else
            <button type="submit" class="btn text-red-500 hover:bg-red-500 hover:text-white">
                <i class="fa-solid fa-code-compare"></i>
            </button>
            @endif
        </form>
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