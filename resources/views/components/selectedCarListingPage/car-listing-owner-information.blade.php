@props([
'carListingOwner',
'totalNumOfCarListings'
])

<div class="bg-white p-6 rounded-lg shadow-md border border-yellow-500">
    <h3 class="text-lg font-semibold text-gray-800 mb-4">
        Owner Information:
    </h3>

    <div class="flex items-center gap-4">
        <div class="text-sm text-gray-700">
            <p class="mb-2">
                <strong>Name:</strong> {{ $carListingOwner->username }}
            </p>
            <p class="mb-2">
                <strong>Email:</strong> {{ $carListingOwner->email }}
            </p>
            <p class="mb-2">
                <strong>Phone:</strong> {{ $carListingOwner->phone_number }}
            </p>
            <p class="mb-2">
                <strong>Joined:</strong> {{
                \Carbon\Carbon::parse($carListingOwner->created_at)->format('d F Y') }}
            </p>
            <p class="mb-2">
                <strong>Total num. of listing:</strong> {{ $totalNumOfCarListings }}
            </p>

            {{-- see all car listing's owner car listings --}}
            <a href="{{ route('listingOwner.index') }}" class="text-blue-500 hover:text-blue-600 font-bold"
                onclick="{{ session()->put('car_listing_owner_id', $carListingOwner->id) }}">
                See all {{$carListingOwner->username}}'s listings
            </a>
        </div>
    </div>
</div>