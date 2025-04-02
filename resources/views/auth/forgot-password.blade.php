<x-layout>

    <div class="register-page container mx-auto">
        <div class="mt-20">

            <x-page-header label='Forgot password' updatedClass='text-center'/>

            <form method="POST" action="{{route('forgot-password.update')}}" class="lg:w-1/2 mx-auto mb-5">
                @csrf
                @method('PUT')

                <div class="border-b pb-5">
                    {{-- email --}}
                    <x-input-text id='email' name='email' type="email" label='Email' placeholder='Enter your email'
                        :require="true" />

                    {{-- Safe word --}}
                    <x-input-text id='safe_word' name='safe_word' label='Safe word - will be used for password reset'
                        placeholder='Enter your safe word' :require="true" />
                </div>

                <div>
                    {{-- password --}}
                    <x-input-text id='password' name='password' type="password" label='New Password'
                        placeholder='Enter your new password' :require="true" />

                    {{-- confirm password --}}
                    <x-input-text id='password_confirmation' name='password_confirmation' type="password"
                        label='Confirm New Password' placeholder='Confirm your new password' :require="true" />
                </div>

                {{-- submit button --}}
                <x-button type='submit' label='Reset password' />
            </form>

            <div class="text-center">
                <p>
                    Don't need a new password? <a class="text-blue-500 hover:text-blue-600 font-bold"
                        href="{{ route('login') }}">Login</a>
                </p>
            </div>

        </div>
    </div>

</x-layout>