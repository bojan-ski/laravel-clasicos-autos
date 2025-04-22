<form method="POST" action="{{ route('register.store') }}" class="mb-5">
    @csrf

    {{-- username --}}
    <x-input-text id='username' name='username' label='Enter your username *' placeholder='max 64 characters'
        :required="true" />

    {{-- email --}}
    <x-input-text id='email' name='email' type="email" label='Enter your email *' placeholder='max 64 characters'
        :required="true" />

    {{-- phone number --}}
    <x-input-text id='phone_number' name='phone_number' type="string" label='Enter your phone number *'
        placeholder='max 20 characters' :required="true" />

    {{-- password --}}
    <x-input-text id='password' name='password' type="password" label='Enter your password *'
        placeholder='min 6 characters' :required="true" />

    {{-- confirm password --}}
    <x-input-text id='password_confirmation' name='password_confirmation' type="password"
        label='Confirm your password *' placeholder='min 6 characters' :required="true" />

    {{-- safe word --}}
    <x-input-text id='safe_word' name='safe_word' label='Enter safe word - used for password reset *'
        placeholder='max 20 characters' :required="true" />

    {{-- Legal --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mt-3">
        {{-- terms & conditions --}}
        <x-input-checkbox id='terms_and_conditions' name='terms_and_conditions' route="termsAndConditions"
            label='Terms & Conditions *' :required="true" />

        {{-- privacy policy --}}
        <x-input-checkbox id='privacy_policy' name='privacy_policy' route="privacyPolicy" label='Privacy Policy *'
            :required="true" />
    </div>

    {{-- submit button --}}
    <x-button type='submit' label='Register' />
</form>