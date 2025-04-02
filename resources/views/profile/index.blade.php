<x-layout>
    <div class="profile-page container mx-auto mt-10">

        <x-page-header label='Welcome {{ strtoupper(Auth::user()->username) }}' updatedClass='text-center' />

        <section class="user-profile-data grid grid-cols-2 px-4 mb-5">
            <div class="bg-white shadow-md border-1 border-yellow-500 rounded-md p-3">
                <p class="mb-3">
                    <span class="block md:inline-block">Username:</span>
                    <span class="font-semibold">{{ $user->username }}</span>
                </p>
                <p class="mb-3">
                    <span class="block md:inline-block">Email:</span>
                    <span class="font-semibold">{{ $user->email }}</span>
                </p>
                <p>
                    <span class="block md:inline-block">Account created:</span>
                    <span class="font-semibold">{{ $user->created_at }}</span>
                </p>
            </div>

            <div class="text-end">    
                <button class="btn text-md bg-red-900 text-white hover:bg-red-700 mb-2">
                    Delete Account
                </button>

                <a href="{{ route('terms_and_conditions') }}" class="block text-blue-500 hover:text-blue-600 font-bold mb-2">
                    Terms & Conditions
                </a>
                <a href="{{ route('privacy_policy') }}" class="block text-blue-500 hover:text-blue-600 font-bold">
                    Privacy Policy
                </a>                               
            </div>
        </section>

        <!-- You can open the modal using ID.showModal() method -->
<button class="btn" onclick="my_modal_3.showModal()">open modal</button>
<dialog id="my_modal_3" class="modal">
  <div class="modal-box">
    <form method="dialog">
      <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
    </form>
    <h3 class="text-lg font-bold">Hello!</h3>
    <p class="py-4">Press ESC key or click on ✕ button to close</p>
  </div>
</dialog>

        {{-- user car listings --}}
        <section class="user-car-listings mb-10">
            {{-- car listings container --}}
            <div
                class="car-listings {{ $userCarListings->isNotEmpty() ? 'grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-7' : '' }} p-4">
                @forelse ($userCarListings as $listing)
                <x-car-listing-card :listing="$listing" />
                @empty
                <x-no-data-message message="You have no car listings" />
                @endforelse
            </div>

            {{-- pagination --}}
            <div class="pagination-option px-4 mt-2">
                {{ $userCarListings->links() }}
            </div>
        </section>
    </div>
</x-layout>