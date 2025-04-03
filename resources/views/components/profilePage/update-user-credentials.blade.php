<section class="update-user-credentials grid grid-cols-1 md:grid-cols-2 gap-4 px-4 mb-5">

    {{-- update safe word --}}
    <div class="bg-white shadow-md border-1 border-yellow-500 rounded-md p-4">
        <form method="POST" action="{{ route('profile.updateSafeWord') }}">
            @csrf
            @method("PUT")

            {{-- old safe word --}}
            <x-input-text id='old_safe_word' name='old_safe_word' label='Old safe word'
                placeholder='Enter your old safe word' :require="true" />

            {{-- new safe word --}}
            <x-input-text id='new_safe_word' name='new_safe_word' label='New safe word'
                placeholder='Enter your new safe word' :require="true" />

            {{-- confirmation new safe word --}}
            <x-input-text id='confirm_safe_word' name='confirm_safe_word' label='Confirm new safe word'
                placeholder='Confirm your new safe word' :require="true" />

            {{-- submit button --}}
            <x-button type='submit' label='Change safe word' />
        </form>
    </div>

    {{-- update password --}}
    <div class="bg-white shadow-md border-1 border-yellow-500 rounded-md p-3">
        <form method="POST" action="{{ route('profile.updatePassword') }}">
            @csrf
            @method("PUT")

            {{-- old password --}}
            <x-input-text id='old_password' name='old_password' type='password' label='Old password'
                placeholder='Enter your old password' :require="true" />

            {{-- new password --}}
            <x-input-text id='password' name='password' type='password' label='New password'
                placeholder='Enter your new password' :require="true" />

            {{-- confirmation new password --}}
            <x-input-text id='password_confirmation' name='password_confirmation' type='password'
                label='Confirm new password' placeholder='Confirm your new password' :require="true" />

            {{-- submit button --}}
            <x-button type='submit' label='Change password' />
        </form>
    </div>

</section>