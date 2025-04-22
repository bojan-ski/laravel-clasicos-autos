@props([
'type' => 'button',
'label'
])

<button type="{{ $type }}"
    class="mt-5 font-semibold bg-blue-500 hover:bg-blue-600 transition duration-150 text-white px-5 py-2 w-full rounded cursor-pointer focus:outline-none">
    {{ $label }}
</button>