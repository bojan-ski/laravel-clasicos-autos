@props(['user'])

<section class="user-profile-data grid grid-cols-2 md:gap-4 px-4 mb-5">
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
        <p>
            <span class="block md:inline-block">
                Account created:
            </span>
            <span class="font-semibold">
                {{ \Carbon\Carbon::parse($user->created_at)->format('d.m.Y') }}
            </span>
        </p>
    </div>

    <div class="text-end">
        {{-- delete account --}}
        <x-profilePage.delete-account-option />

        {{-- legal links --}}
        <a href="{{ route('termsAndConditions') }}" class="block text-blue-500 hover:text-blue-600 font-bold mb-2">
            Terms & Conditions
        </a>
        <a href="{{ route('privacyPolicy') }}" class="block text-blue-500 hover:text-blue-600 font-bold">
            Privacy Policy
        </a>
    </div>
</section>