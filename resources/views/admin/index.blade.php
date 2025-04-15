<x-layout>
    <div class="app-users-page container mx-auto mt-10">

        {{-- app users table - container --}}
        <section class="app-users overflow-x-auto rounded-lg shadow border border-gray-300 mb-5">
            <x-admin.app-users-table :appUsers="$appUsers" :userListingCounts="$userListingCounts" />
        </section>

        {{-- pagination option --}}
        <section class="pagination-option px-4 mt-2 mb-10">
            {{ $appUsers->links() }}
        </section>

    </div>
</x-layout>