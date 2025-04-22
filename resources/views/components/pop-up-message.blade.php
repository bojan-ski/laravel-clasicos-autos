@props([
'type',
'message'
])

@if (session()->has($type))
    <div class="pop-up-message fixed inset-0 z-100 bg-black/25 bg-opacity-15 pt-[150px]">
        <div class="max-w-max mx-auto p-6 md:px-8 rounded-lg {{ $type == 'success' ? 'bg-green-500' : 'bg-red-500' }}">
            <p class="text-2xl text-white font-semibold">
                {{ $message }}
            </p>
        </div>
    </div>
@endif