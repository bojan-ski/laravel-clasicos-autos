@props([
    'label',
    'updatedClass' => 'text-center md:text-start'
])

<h2 class="text-4xl font-bold mb-5 {{ $updatedClass }}">
    {{ $label }}
</h2>