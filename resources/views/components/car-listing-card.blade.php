@props(['listing'])

<div class="card bg-base-100 shadow-sm hover:shadow-lg">
    <figure>
        <img src="{{ json_decode($listing->images)[0] }}"
            alt="{{ $listing->name }}" />
    </figure>
    <div class="card-body">
        <h4 class="card-title">
            {{ $listing->name }}
        </h4>
        <div class="flex items-center mb-2">
            <p>
                {{ $listing->make }}
            </p>
            <p class="text-center">
                {{ $listing->model }}
            </p>
            <p class="text-end">
                {{ $listing->year }}
            </p>
        </div>
        <div class="flex items-center justify-between">
            <a href="{{ route('listings.show', $listing->id) }}" class="font-semibold bg-blue-500 hover:bg-blue-600 text-white px-5 py-2 rounded cursor-pointer focus:outline-none">
                See Details
            </a>
            <h5 class="text-end font-semibold text-lg">
                ${{ $listing->price }}
            </h5>       
        </div>
    </div>
</div>