@can('create', App\Models\CarListing::class)
    <a href="{{ route('listings.create') }}" class="btn text-md mx-2 bg-blue-600 text-white hover:bg-blue-500">
        <span>
            <i class="fa-solid fa-circle-plus"></i>
        </span>
        <span class="hidden md:block">
            List Car
        </span>
    </a>
@endcan