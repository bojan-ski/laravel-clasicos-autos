<x-layout>
    <div class="profile-page container mx-auto mt-10">

        {{-- page header --}}
        <x-page-header label='Welcome {{ strtoupper(Auth::user()->username) }}' updatedClass='text-center' />

        {{-- user profile data --}}
        <x-profilePage.user-profile-data :user="$user" />

        {{-- update user credentials - safe word & password --}}
        <x-profilePage.update-user-credentials />

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