@props(['conversation'])

<form method="POST" action="{{ route('conversations.store', $conversation) }}" class="mt-5 pt-5 border-t border-yellow-500">
    @csrf

    <div class="grid grid-cols-1 sm:grid-cols-4 gap-2">
        <x-input-text id='message' name='message' minlength='5' maxlength='100' value="{{ request('name') }}"
            css='sm:col-span-3' placeholder='Type your message...' :required="true" />

        <div class="flex items-center justify-center">
            <button type="submit"
                class="w-full bg-red-600 hover:bg-red-700 text-white px-4 py-2.5 rounded-md font-semibold text-sm transition duration-150 cursor-pointer">
                Send
            </button>
        </div>
    </div>
</form>