<section class="update-user-credentials grid grid-cols-1 md:grid-cols-2 gap-4 px-4 mb-5">
    {{-- update safe word --}}
    <div class="bg-white shadow-md border-1 border-yellow-500 rounded-md p-4">
        <form method="POST" action="{{ route('profile.updateSafeWord') }}">
            @csrf
            @method("PUT")

            {{-- old safe word --}}
            <x-input-text id='old_safe_word' name='old_safe_word' label='Old safe word'
                placeholder='Enter your old safe word' :require="true" />

            {{-- old safe word --}}
            <x-input-text id='new_safe_word' name='new_safe_word' label='New safe word'
                placeholder='Enter your new safe word' :require="true" />

            {{-- old safe word --}}
            <x-input-text id='confirm_safe_word' name='confirm_safe_word' label='Confirm new safe word'
                placeholder='Confirm your new safe word' :require="true" />

            {{-- submit button --}}
            <x-button type='submit' label='Change safe word' />
        </form>
    </div>

    <div class="bg-white shadow-md border-1 border-yellow-500 rounded-md p-3">

    </div>
</section>