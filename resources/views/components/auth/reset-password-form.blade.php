<form method="POST" action="{{ route('forgotPassword.resetPassword') }}" class="lg:w-1/2 mx-auto mb-5">
    @csrf
    @method('PUT')

    <div class="border-b border-yellow-500 pb-5">
        {{-- email --}}
        <x-input-text id='email' name='email' type="email" label='Email' placeholder='Enter your email'
            :required="true" />

        {{-- safe word --}}
        <x-input-text id='safe_word' name='safe_word' label='Safe word - will be used for password reset'
            placeholder='Enter your safe word' :required="true" />
    </div>

    <div>
        {{-- password --}}
        <x-input-text id='password' name='password' type="password" label='Enter your new password'
            placeholder='min 6 characters' :required="true" />

        {{-- confirm password --}}
        <x-input-text id='password_confirmation' name='password_confirmation' type="password"
            label='Confirm your new password' placeholder='min 6 characters' :required="true" />
    </div>

    {{-- submit button --}}
    <x-button type='submit' label='Reset password' />
</form>