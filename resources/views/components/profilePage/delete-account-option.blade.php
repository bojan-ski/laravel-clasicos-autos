<button class="btn text-md bg-red-900 text-white hover:bg-red-700 mb-2" onclick="my_modal_3.showModal()">
    Delete Account
</button>

<dialog id="my_modal_3" class="modal">
    <div class="modal-box">

        <h3 class="text-center text-lg font-bold mb-5">
            Are you sure you want to delete your account ?
        </h3>

        <form method="POST" action="{{ route('profile.destroy') }}">
            @csrf
            @method('DELETE')

            {{-- confirm delete - password --}}
            <x-input-text id='password' name='password' type="password" placeholder='Enter your password to confirm account delete' :require="true" />

            <div class="flex items-center justify-between pt-4">
                <a href="{{ route('profile.index') }}"
                    class="text-sm font-medium text-indigo-600 hover:text-indigo-500">
                    Cancel
                </a>
                <button type="submit"
                    class="bg-red-600 text-white text-sm px-4 py-2 cursor-pointer rounded-md hover:bg-red-700 font-semibold">
                    Delete Account
                </button>
            </div>
        </form>
        
    </div>
</dialog>