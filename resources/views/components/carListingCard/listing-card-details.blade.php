@props(['listing'])

<div class="mb-3">
    <p class="font-semibold mb-1">
        <i class="fa-solid fa-car mr-2"></i> {{ $listing->car_maker }} - {{ $listing->model }}
    </p>
    <p class="font-semibold mb-1">
        <i class="fa-solid fa-gas-pump mr-2"></i> {{ $listing->fuel_type }}
    </p>
    <p class=" font-semibold mb-1">
        <i class="fa-solid fa-calendar-days mr-2"></i> {{ $listing->year }}
    </p>
    <p class="text-red-600 text-2xl font-bold text-end">
        ${{ number_format($listing->price) }}
    </p>
</div>