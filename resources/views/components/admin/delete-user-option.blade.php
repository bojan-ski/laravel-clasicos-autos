@props(['user'])

<label for="modal_{{ $user->id }}" class="btn text-md bg-red-900 text-white hover:bg-red-700">
    X
</label>

<input type="checkbox" id="modal_{{ $user->id }}" class="modal-toggle" />
<div class="modal" role="dialog">
    <div class="modal-box">

        <h3 class="text-center text-lg font-bold mb-3">
            Are you sure you want to delete {{ $user->username }}?
        </h3>

        <form method="POST" action="{{ route('admin.deleteUser') }}" class="text-center">
            @csrf
            @method("DELETE")

            <x-input-text id='app_user_id' name='app_user_id' type='hidden' value="{{ $user->id }}" />

            <button type="submit"
                class="bg-red-600 text-white text-sm px-4 py-2 cursor-pointer rounded-md hover:bg-red-700 font-semibold">
                Delete Account
            </button>

        </form>
    </div>
    <label class="modal-backdrop" for="modal_{{ $user->id }}">Close</label>
</div>