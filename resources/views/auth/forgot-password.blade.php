<x-layout>
    <div class="forgot-password-page container mx-auto">
        <div class="mt-20">

            {{-- page header --}}
            <x-page-header label='Forgot password' updatedClass='text-center' />

            {{-- reset password form --}}
            <x-auth.reset-password-form />

            {{-- login nav link --}}
            <div class="text-center">
                <p>
                    Don't need a new password? <a class="text-blue-500 hover:text-blue-600 font-bold"
                        href="{{ route('login') }}">Login</a>
                </p>
            </div>

        </div>
    </div>
</x-layout>