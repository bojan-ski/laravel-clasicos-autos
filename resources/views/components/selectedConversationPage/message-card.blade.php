@props(['message'])

<div class="flex {{ $message->sender_id === Auth::id() ? 'justify-end' : 'justify-start' }}">
    <div class="max-w-sm px-4 py-2 rounded-lg shadow-sm 
                    {{ $message->sender_id === Auth::id() 
                        ? 'bg-blue-600 text-white rounded-br-none' 
                        : 'bg-white text-gray-800 border border-gray-200 rounded-bl-none' }}">
        {{-- time --}}
        <p class="text-xs mb-2">
            {{ $message->created_at->diffForHumans() }}
        </p>
        {{-- message --}}
        <p class="text-sm mb-2">
            {{ $message->message }}
        </p>

        <button class="btn">
            delete
        </button>
    </div>
</div>