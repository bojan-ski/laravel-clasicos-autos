@php
$otherUser = $conversation->sender_id == Auth::id() ? $conversation->receiver->username :
$conversation->sender->username;
@endphp

<x-layout>
    <div class="message-page container mx-auto mt-10">

        {{-- Back to prev page button --}}
        <div class="flex mb-5">
            <x-back-button />
        </div>

        {{-- Page header --}}
        <x-page-header label="Conversation with {{ $otherUser }}"
            updatedClass="text-center text-2xl font-bold text-red-700 " />

        {{-- Car listing name --}}
        <h3 class="text-center text-3xl font-bold text-red-700 mb-7">
            {{ $carListingName }}
        </h3>

        {{-- Messages container --}}
        <div
            class="max-w-4xl mx-auto p-4 bg-yellow-50 rounded-lg shadow-md border border-yellow-200 min-h-[70vh] flex flex-col justify-between mb-10">

            {{-- messages --}}
            <section class="messages-list space-y-3 overflow-y-auto max-h-[60vh] pr-2">
                @foreach ($messages as $message)
                    <x-selectedConversationPage.message-card :message="$message"/>
                @endforeach
            </section>

            {{-- message input form --}}
            @can('create', [App\Models\Message::class, $conversation])
                <section class="send-message-form">
                    <x-selectedConversationPage.send-message-form :conversation="$conversation"/>
                </section>                
            @endcan
        </div>

    </div>
</x-layout>