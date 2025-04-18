@props(['message'])

<div class="flex {{ $message->sender_id === Auth::id() ? 'justify-end' : 'justify-start' }}">
    <div class="max-w-sm px-4 py-2 rounded-lg shadow-sm bg-white text-gray-800 border border-gray-200 rounded-bl-none">
        <div class="flex items-center mb-2">
            {{-- when message was send (time) --}}
            <p class="text-xs mr-2">
                {{ $message->created_at->diffForHumans() }}
            </p>
            
            {{-- delete msg option --}}
            @if ($message->sender_id === Auth::id() || Auth::user()->role === 'admin_user')
                <x-selectedConversationPage.delete-message-option :message="$message" />
            @endif
        </div>

        {{-- message - content --}}
        <p class="text-sm mb-2">
            {{ $message->message }}
        </p>
    </div>
</div>