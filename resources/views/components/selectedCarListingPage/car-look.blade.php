@props(['listing'])

<div class="bg-white p-4 rounded-lg shadow border border-yellow-500">
    <h4 class="text-md font-bold mb-3">
        Exterior & Interior
    </h4>
    <ul class="list-disc list-inside text-gray-700 space-y-1">
        @if ($listing->body_type)
        <li>
            <span class="font-semibold">Body Type:</span>
            {{ ucfirst($listing->body_type) }}
        </li>
        @endif
        @if ($listing->exterior_color)
        <li>
            <span class="font-semibold">Exterior Color:</span>
            {{ ucfirst($listing->exterior_color) }}
        </li>
        @endif
        @if ($listing->interior_color)
        <li>
            <span class="font-semibold">Interior Color:</span>
            {{ ucfirst($listing->interior_color) }}
        </li>
        @endif
        @if ($listing->exterior_condition)
        <li>
            <span class="font-semibold">Condition (Exterior):</span>
            {{ $listing->exterior_condition }}
        </li>
        @endif
        @if ($listing->interior_condition)
        <li>
            <span class="font-semibold">Condition (Interior):</span>
            {{ $listing->interior_condition }}
        </li>
        @endif
        @if ($listing->seat_material)
        <li>
            <span class="font-semibold">Seat Material:</span>
            {{ $listing->seat_material }}
        </li>
        @endif
    </ul>
</div>