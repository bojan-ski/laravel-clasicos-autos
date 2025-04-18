@props(['message'])

<div class="flex {{ $message->sender_id === Auth::id() ? 'justify-end' : 'justify-start' }}">
    <div class="max-w-sm px-4 py-2 rounded-lg shadow-sm bg-white text-gray-800 border border-gray-200 rounded-bl-none">
        {{-- when message was send (time) & delete msg option --}}
        <div class="flex items-center mb-2">
            <p class="text-xs mr-2">
                {{ $message->created_at->diffForHumans() }}
            </p>

            @if ($message->sender_id === Auth::id())
            <x-selectedConversationPage.delete-message-option :message="$message" />
            @endif
        </div>
        {{-- message - content --}}
        <p class="text-sm mb-2">
            {{ $message->message }}
        </p>
    </div>
</div>