<x-layout>

    <h2>
        My Conversations
    </h2>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if ($conversations->isEmpty())
                    <p>{{ __('You have no active conversations.') }}</p>
                    @else
                    <ul class="space-y-4">
                        @foreach ($conversations as $conversation)
                        @php
                        $otherUser = $conversation->sender_id == Auth::id() ? $conversation->receiver :
                        $conversation->sender;
                        $lastMessage = $conversation->lastMessage;
                        @endphp
                        <li>
                            <a href="{{ route('conversations.show', $conversation) }}"
                                class="block p-4 border rounded-md hover:bg-gray-100">
                                <strong>{{ $otherUser->name }}</strong>
                                @if ($lastMessage)
                                <p class="text-gray-500 text-sm">{{ Str::limit($lastMessage->body, 50) }}</p>
                                <span class="text-xs text-gray-400">{{ $lastMessage->created_at->diffForHumans()
                                    }}</span>
                                @else
                                <p class="text-gray-500 text-sm">{{ __('No messages yet.') }}</p>
                                @endif
                            </a>
                        </li>
                        @endforeach
                    </ul>
                    {{ $conversations->links() }}
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-layout>