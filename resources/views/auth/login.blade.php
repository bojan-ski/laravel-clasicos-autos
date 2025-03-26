<x-layout>

    <div class="login-page container mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-2 mt-20">

            <div class="pr-0 md:pr-5">
                <x-page-header label='Login' />

                <form method="POST" action="{{route('login.authenticate')}}">
                    @csrf

                    {{-- email --}}
                    <x-input-text id='email' name='email' type="email" label='Email' placeholder='Enter your email'
                        :require="true" />

                    {{-- password --}}
                    <x-input-text id='password' name='password' type="password" label='Password'
                        placeholder='Enter your password' :require="true" />

                    {{-- submit button --}}
                    <x-button type='submit' label='Register' />
                </form>
            </div>

            <div class="pl-5 border-l hidden md:block">
                <img src="https://placehold.co/600x500" alt="">
            </div>

        </div>
    </div>

</x-layout>