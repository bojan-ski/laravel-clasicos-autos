@props([
'id',
'name',
'label' => null,
'type' => 'text',
'value' => null,
'placeholder' => null,
'minlength' => null,
'maxlength' => null,
'min' => null,
'max' => null,
'required' => false,
'css' => null
])

<fieldset class="fieldset {{ $css }}">
    @if ($label)
        <legend class="fieldset-legend text-lg">
            {{ $label }}
        </legend>
    @endif

    <input type="{{ $type }}" name="{{ $name }}" id="{{ $id }}" class="input w-full focus:outline-none"
        value="{{ old($name, $value) }}" min="{{ $min }}" max="{{ $max }}" minlength="{{ $minlength }}"
        maxlength="{{ $maxlength }}" placeholder="{{ $placeholder }}" @if ($required) required @endif />

    @error($name)
        <p class="text-red-500 text-sm mt-1">
            {{ $message }}
        </p>
    @enderror
</fieldset>