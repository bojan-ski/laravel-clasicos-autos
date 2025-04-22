@props([
'appUsers',
'userListingCounts'
])

<table class="table w-full text-sm text-left text-gray-800 bg-white">
    <thead class="bg-red-500 text-white">
        <tr>
            <th class="px-4 py-3">ID</th>
            <th class="px-4 py-3">Username</th>
            <th class="px-4 py-3">Email</th>
            <th class="px-4 py-3">Phone Number</th>
            <th class="px-4 py-3">Account Created</th>
            <th class="px-4 py-3">Listings</th>
            <th class="px-4 py-3 text-center">View</th>
            <th class="px-4 py-3 text-center">Delete</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($appUsers as $user)
            <x-admin.app-users-table-row :user="$user" :userListingCounts="$userListingCounts" />
        @empty
            <tr>
                <td colspan="8" class="text-center py-4 text-gray-500">
                    <x-no-data-message message="No app users!" />
                </td>
            </tr>
        @endforelse
    </tbody>
</table>