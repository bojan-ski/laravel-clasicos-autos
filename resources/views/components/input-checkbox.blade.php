@props([
'id',
'name',
'route',
'label',
'required' => false
])

<fieldset class="fieldset rounded-box w-full">
    <label class="fieldset-label">
        <input id="{{ $id }}" name="{{ $name }}" type="checkbox" class="checkbox" @if ($required) required @endif />
        <p class="font-bold">
            I agree with the
        </p>
        <a href="{{ route($route) }}" class="text-blue-500 hover:text-blue-600 font-bold text-sm">
            {{ $label }}
        </a>
    </label>

    @error($name)
        <p class="text-red-500 text-sm mt-1">
            {{ $message }}
        </p>
    @enderror
</fieldset>