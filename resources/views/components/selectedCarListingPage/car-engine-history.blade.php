@props(['listing'])

<div class="bg-white p-4 rounded-lg shadow border border-yellow-500">
    <h4 class="text-md font-bold mb-3">
        Engine & History
    </h4>
    <ul class="list-disc list-inside text-gray-700 space-y-1">
        <li>
            <span class="font-semibold">Engine History:</span>
            {{ $listing->engine_history }}
        </li>
        <li>
            <span class="font-semibold">Engine Condition:</span>
            {{ $listing->engine_condition }}
        </li>
        <li>
            <span class="font-semibold">Odometer:</span>
            {{ $listing->odometer }}
        </li>
        @if ($listing->restoration_history)
        <li>
            <span class="font-semibold">Restoration:</span>
            {{ $listing->restoration_history }}
        </li>
        @endif
        @if ($listing->original_parts_percentage)
        <li>
            <span class="font-semibold">Original Parts:</span>
            {{ $listing->original_parts_percentage }}%
        </li>
        @endif
        @if ($listing->license_plate_type)
        <li>
            <span class="font-semibold">License Plate Type:</span>
            {{ $listing->license_plate_type }}
        </li>
        @endif
        <li>
            <span class="font-semibold">Documentation:</span>
            {{ $listing->documentation_status }}
        </li>
    </ul>
</div>