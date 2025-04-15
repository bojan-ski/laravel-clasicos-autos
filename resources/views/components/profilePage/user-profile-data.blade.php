@props(['user'])

<section class="user-profile-data grid grid-cols-2 md:gap-4 px-4 mb-5">
    {{-- user profile data --}}
    <div class="bg-white shadow-md border-1 border-yellow-500 rounded-md p-3">
        <p class="mb-3">
            <span class="block md:inline-block">
                Username:
            </span>
            <span class="font-semibold">
                {{ $user->username }}
            </span>
        </p>
        <p class="mb-3">
            <span class="block md:inline-block">
                Email:
            </span>
            <span class="font-semibold">
                {{ $user->email }}
            </span>
        </p>
        <p class="mb-3">
            <span class="block md:inline-block">
                Phone number:
            </span>
            <span class="font-semibold">
                {{ $user->phone_number }}
            </span>
        </p>
        <p>
            <span class="block md:inline-block">
                Account created:
            </span>
            <span class="font-semibold">
                {{ \Carbon\Carbon::parse($user->created_at)->format('d.m.Y') }}
            </span>
        </p>
    </div>

    {{-- delete account --}}
    <div class="text-end">
        <x-profilePage.delete-account-option />
    </div>
</section>