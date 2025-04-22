<x-layout>
    <div class="register-page container mx-auto">
        <div class="grid grid-cols-1 lg:grid-cols-2 mt-10 mb-10">

            <div class="pr-0 lg:pr-5">
                {{-- page header --}}
                <x-page-header label='Register' />

                {{-- register form --}}
                <x-auth.register-form />

                {{-- login nav link --}}
                <div class="text-center">
                    <p>
                        Already have an account? <a class="text-blue-500 hover:text-blue-600 font-bold"
                            href="{{ route('login') }}">Login</a>
                    </p>
                </div>
            </div>

            <div class="pl-5 border-l hidden lg:block">
                {{-- <img src="https://placehold.co/750x750" alt="registration-img"> --}}
                <img src="{{ asset('assets/images/register.png') }}" alt="registration-img" class="w-full h-[750px] object-cover">
            </div>

        </div>
    </div>
</x-layout>