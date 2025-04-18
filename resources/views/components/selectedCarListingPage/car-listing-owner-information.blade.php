@props([
'listing',
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
            <p>
                <strong>Total num. of listing:</strong> {{ $totalNumOfCarListings }}
            </p>

            {{-- LINKS TO SEE ALL LISTINGS OWNER CAR LISTINGS AND CONTACT --}}
            @auth
                @if (auth()->id() !== $listing->user_id)
                    {{-- see all car listing's owner car listings --}}
                    <a href="{{ route('listingOwner.index') }}"
                        class="mt-2 block font-bold text-blue-500 hover:text-blue-600 hover:underline transition duration-150"
                        onclick="{{ session()->put('car_listing_owner_id', $carListingOwner->id) }}">
                        See all {{ $carListingOwner->username }}'s listings
                    </a>

                    {{-- contact car listing owner --}}
                    @can('create', App\Models\Conversation::class)
                        <a href="{{ route('conversations.thread', [$listing, $carListingOwner->id]) }}"
                            class="mt-4 text-sm bg-red-600 hover:bg-red-700 transition duration-150 text-white px-3 py-1.5 rounded-md font-semibold cursor-pointer">
                            Send message
                        </a>                        
                    @endcan
                @endif
            @else
                <a href="{{ route('login') }}" class="block text-red-600 hover:text-red-700 hover:underline transition duration-150 font-bold">
                    Login to contact the seller.
                </a>
            @endauth
        </div>
    </div>
</div>