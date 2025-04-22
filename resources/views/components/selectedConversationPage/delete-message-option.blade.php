@props(['message'])

<label for="modal_{{ $message->id }}" class="text-xs text-red-900 hover:text-red-700 transition font-bold cursor-pointer">
    <span class="hidden md:block">
        Delete
    </span>
    <span class="md:hidden">
        <i class="fa-solid fa-trash"></i>
    </span>
</label>

<input type="checkbox" id="modal_{{ $message->id }}" class="modal-toggle" />
<div class="modal" role="dialog">
    <div class="modal-box">

        <h3 class="text-center text-lg font-bold mb-3">
            Are you sure you want to delete the message?
        </h3>

        <form method="POST" action="{{ route('messages.deleteMessage', $message) }}" class="text-center">
            @csrf
            @method("DELETE")

            <button type="submit"
                class="bg-red-600 text-white text-sm px-4 py-2 cursor-pointer rounded-md hover:bg-red-700 transition font-semibold">
                Delete message
            </button>
        </form>

    </div>
    <label class="modal-backdrop" for="modal_{{ $message->id }}">Close</label>
</div>