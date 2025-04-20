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
    class="{{ $conversation->unread_count > 0 ? 'bg-yellow-50' : 'bg-white' }} 
           flex items-center justify-between gap-4 p-4 
           border border-gray-200 rounded-lg 
           shadow-sm hover:shadow-md hover:border-yellow-500 
           transition duration-150 mb-3">
    
    <div>
        <p class="text-gray-800 font-semibold">
            {{ $otherUser->username }}
        </p>
        <p class="text-sm text-gray-500">
            Regarding: <span class="font-medium text-gray-700">{{ $carListingName }}</span>
        </p>
    </div>

    @if ($conversation->unread_count > 0)
        <span class="text-xs font-semibold bg-yellow-400 text-white px-2 py-0.5 rounded-full shadow">
            New
        </span>
    @endif
</a>