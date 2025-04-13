@props([
'image',
'listing',
'route',
'method' => false,
'bgColor',
'bgColorHover',
'btnText'
])

<form method="POST" action="{{ route($route, $listing) }}">
    @csrf
    @if ($method)
    @method("DELETE")
    @endif

    <x-input-text id='image' name='image' type='hidden'
        value="{{ Str::startsWith($image, 'http') ? $image : Storage::url($image) }}" />

    <button type="submit"
        class="w-full px-3 py-2 {{ $bgColor }} text-white text-sm font-medium rounded-md shadow hover:{{ $bgColorHover }} transition cursor-pointer">
        {{ $btnText }}
    </button>
</form>