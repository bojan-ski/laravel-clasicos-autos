@props(['description'])

<div class="bg-white rounded-lg shadow-md p-6 border border-yellow-500 mb-5">
    <h3 class="text-lg font-semibold text-gray-800 mb-2">
        Car Description
    </h3>

    <p class="text-gray-700 leading-relaxed">
        {{ $description }}
    </p>
</div>