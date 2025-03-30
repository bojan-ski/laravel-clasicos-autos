@props([
'id',
'name',
'label' => null,
'type' => 'text',
'value' => '',
'options' => [],
'required' => false,
'disabledOptionLabel' => null
])

<fieldset class="fieldset">
    @if ($label)
    <legend class="fieldset-legend text-lg">
        {{ $label }}
    </legend>
    @endif

    <select id="{{ $id }}" name="{{ $name }}" class="select w-full" @if ($required) required @endif >
        @if ($disabledOptionLabel)
        <option value="">
            {{ $disabledOptionLabel }}
        </option>
        @endif

        @foreach ($options as $option)
        <option value="{{ $option }}" {{ old($name, $value) == $option ? 'selected' : '' }}>
            {{ $option }}
        </option>
        @endforeach
    </select>

    @error($name)
    <p class="text-red-500 text-sm mt-1">
        {{ $message }}
    </p>
    @enderror
</fieldset>