@props(['listing'])

<button class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700 font-semibold cursor-pointer"
    onclick="delete_car_listing_modal.showModal()">
    <i class="fa-solid fa-trash-can"></i>
</button>

<dialog id="delete_car_listing_modal" class="modal">
    <div class="modal-box">

        <h3 class="text-center text-lg font-bold mb-5">
            Are you sure you want to delete the car listing ?
        </h3>

        <form method="POST" action="{{ route('listings.destroy', $listing) }}">
            @csrf
            @method("DELETE")

            <div class="flex items-center justify-between pt-4">
                <a href="{{ route('listings.show', $listing) }}"
                    class="text-sm font-medium text-indigo-600 hover:text-indigo-500">
                    Cancel
                </a>
                <button type="submit"
                    class="bg-red-600 text-white text-sm px-4 py-2 cursor-pointer rounded-md hover:bg-red-700 font-semibold">
                    Delete
                </button>
            </div>
        </form>

    </div>
</dialog>