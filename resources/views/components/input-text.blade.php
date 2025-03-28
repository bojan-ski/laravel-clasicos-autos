@props([
'id',
'name',
'label' => null,
'type' => 'text',
'value' => '',
'placeholder' => '',
'min' => null,
'max' => null,
'required' => false
])

<fieldset class="fieldset">
    @if ($label)
    <legend class="fieldset-legend text-lg">
        {{ $label }}
    </legend>
    @endif

    <input type="{{ $type }}" name="{{ $name }}" id="{{ $id }}" class="input w-full focus:outline-none"
        value="{{ old($name, $value) }}" min="{{ $min }}" max="{{ $max }}" placeholder="{{ $placeholder }}" />

    {{-- <input type="{{ $type }}" name="{{ $name }}" id="{{ $id }}" class="input w-full focus:outline-none"
        value="{{ old($name, $value) }}" placeholder="{{ $placeholder }}" required="{{ $required }}" /> --}}

    @error($name)
    <p class="text-red-500 text-sm mt-1">
        {{ $message }}
    </p>
    @enderror
</fieldset>