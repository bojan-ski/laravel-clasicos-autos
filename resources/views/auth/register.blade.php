<x-layout>

    <div class="register-page container mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-2 mt-20">

            <div class="pr-0 md:pr-5">
                <x-page-header label='Register' />

                <form method="POST" action="{{route('register.store')}}" class="mb-5">
                    @csrf

                    {{-- username --}}
                    <x-input-text id='username' name='username' label='Username' placeholder='Enter your username'
                        :require="true" />

                    {{-- email --}}
                    <x-input-text id='email' name='email' type="email" label='Email' placeholder='Enter your email'
                        :require="true" />

                    {{-- password --}}
                    <x-input-text id='password' name='password' type="password" label='Password'
                        placeholder='Enter your password' :require="true" />

                    {{-- confirm password --}}
                    <x-input-text id='password_confirmation' name='password_confirmation' type="password"
                        label='Confirm Password' placeholder='Confirm your password' :require="true" />

                    {{-- Safe word --}}
                    <x-input-text id='safe_word' name='safe_word' label='Safe word - will be used for password reset' placeholder='Enter your safe word'
                        :require="true" />

                    {{-- submit button --}}
                    <x-button type='submit' label='Register' />
                </form>

                <div class="text-center">
                    <p>
                        Already have an account? <a class="text-blue-500 hover:text-blue-600 font-bold" href="{{ route('login') }}">Login</a>
                    </p>
                </div>
            </div>

            <div class="pl-5 border-l hidden md:block">
                <img src="https://placehold.co/600x600" alt="">
            </div>

        </div>        
    </div>

</x-layout>