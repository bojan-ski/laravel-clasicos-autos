@props([
'user',
'userListingCounts'
])

@php
if(session()->has('car_listing_owner_id')){
session()->forget('car_listing_owner_id');
}
@endphp

<tr class="hover:bg-yellow-50 border-b border-gray-100">
    <td class="px-4 py-2 font-medium">
        {{ $user->id }}
    </td>
    <td class="px-4 py-2">
        {{ $user->username }}
    </td>
    <td class="px-4 py-2">
        {{ $user->email }}
    </td>
    <td class="px-4 py-2">
        {{ $user->phone_number }}
    </td>
    <td class="px-4 py-2">
        {{ \Carbon\Carbon::parse($user->created_at)->format('d.m.Y') }}
    </td>
    <td class="px-4 py-2 text-center font-semibold">
        {{ $userListingCounts[$user->id]->listing_count ?? 0 }}
    </td>
    <td class="px-4 py-2 text-center">
        {{-- see all car listings of the app user --}}
        <a href="{{ route('admin.userListings', $user) }}" class="btn text-md bg-blue-500 text-white hover:bg-blue-600">
            <i class="fa-solid fa-user"></i>
        </a>
    </td>
    <td class="px-4 py-2 text-center">
        {{-- delete user account --}}
        <x-admin.delete-user-option :user="$user" />
    </td>
</tr>