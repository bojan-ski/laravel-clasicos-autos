@props([
'type',
'message'
])

@if (session()->has($type))
<div class="pop-up-message w-72 fixed top-1/5 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
    <div
        class="text-center font-semibold p-4 mb-4 text-white rounded {{ $type == 'success' ? 'bg-green-500' : 'bg-red-500' }}">
        {{ $message }}
    </div>
</div>
@endif