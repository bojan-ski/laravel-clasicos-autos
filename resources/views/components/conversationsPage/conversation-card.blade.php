@props([
'conversation'
])

@php
// other app_user username
$otherUser = $conversation->sender_id == Auth::id() ? $conversation->receiver : $conversation->sender;

// car listing name
$carListingName = \App\Models\CarListing::find($conversation->listing_id)?->name ?? 'Car Listing';
@endphp

<a href="{{ route('conversations.show', $conversation) }}"
    class="flex items-center justify-between gap-4 p-4 bg-white border border-gray-200 rounded-lg shadow-sm hover:shadow-md hover:border-yellow-500 transition duration-150 mb-3">
    <div>
        <p class="text-gray-800 font-semibold">
            {{ $otherUser->username }}
        </p>
        <p class="text-sm text-gray-500">
            Regarding: <span class="font-medium text-gray-700">{{ $carListingName }}</span>
        </p>
    </div>
</a>