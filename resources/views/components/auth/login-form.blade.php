<form method="POST" action="{{ route('login.authenticate') }}" class="mb-5">
    @csrf

    {{-- email --}}
    <x-input-text id='email' name='email' type="email" label='Email' placeholder='Enter your email' :required="true" />

    {{-- password --}}
    <x-input-text id='password' name='password' type="password" label='Password' placeholder='Enter your password'
        :required="true" />

    {{-- submit button --}}
    <x-button type='submit' label='Register' />
</form>