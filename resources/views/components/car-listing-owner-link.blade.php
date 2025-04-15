@props([
'label',
'userId'
])

<a href="{{ route('listingOwner.index', ['car_listing_owner_id' => $userId]) }}"
    class="text-blue-500 hover:text-blue-600 font-bold">
    {{ $label }}
</a>