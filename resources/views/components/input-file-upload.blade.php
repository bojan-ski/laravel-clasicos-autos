@props([
'id',
'name',
'label' => null,
'required' => false
])

<fieldset class="fieldset">
    <legend class="fieldset-legend text-lg">
        {{ $label }}
    </legend>
    <input id="{{ $id }}" name="{{ $name }}" type="file" multiple accept="image/*" max="8" class="file-input" @if ($required) required @endif />
    <label class="fieldset-label">If the image is over 1MB it will be compressed</label>

    @error($name)
    <p class="text-red-500 text-sm mt-1">
        {{ $message }}
    </p>
    @enderror
</fieldset>