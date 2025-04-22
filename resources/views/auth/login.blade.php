<x-layout>
    <div class="login-page container mx-auto">
        <div class="grid grid-cols-1 lg:grid-cols-2 mt-20">

            <div class="pr-0 lg:pr-5">
                {{-- page header --}}
                <x-page-header label='Login' />

                {{-- login form --}}
                <x-auth.login-form />

                {{-- register & reset password nav links --}}
                <div class="flex items-center justify-between">                    
                    <p>
                        Don't have an account? <a class="text-blue-500 hover:text-blue-600 font-bold" href="{{ route('register') }}">Register</a>
                    </p>
                    
                    <p>
                        Can't remember your password? <a class="text-blue-500 hover:text-blue-600 font-bold" href="{{ route('forgotPassword') }}">Reset password</a>
                    </p>
                </div>
            </div>

            <div class="pl-5 border-l hidden lg:block">
                <img src="https://placehold.co/600x500" alt="login-img">
            </div>

        </div>
    </div>
</x-layout>