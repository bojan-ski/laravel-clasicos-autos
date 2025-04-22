@props([
'id',
'name',
'label' => null,
'value' => '',
'placeholder' => '',
'rows' => '7',
'cols' => '30',
'required' => false
])

<fieldset class="fieldset">
    @if ($label)
        <legend class="fieldset-legend text-lg">
            {{ $label }}
        </legend>
    @endif

    <textarea name="{{ $name }}" id="{{ $id }}" rows="{{ $rows }}" cols="{{ $cols }}" class="textarea w-full focus:outline-none"
        placeholder="{{ $placeholder }}" @if ($required) required @endif>{{ old($name, $value) }}</textarea>

    @error($name)
        <p class="text-red-500 text-sm mt-1">
            {{ $message }}
        </p>
    @enderror
</fieldset>