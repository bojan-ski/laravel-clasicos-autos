@props(['listing'])

<form method="POST"
    action="{{ !in_array($listing->id, session('compare_listings', [])) ? route('compare.add', $listing->id) : route('compare.remove', $listing->id) }}">
    @csrf

    @if (in_array($listing->id, session('compare_listings', [])))
        <button type="submit" class="btn bg-red-500 text-white hover:bg-transparent hover:text-red-500">
            <i class="fa-solid fa-code-compare"></i>
        </button>
    @else
        <button type="submit" class="btn text-red-500 hover:bg-red-500 hover:text-white">
            <i class="fa-solid fa-code-compare"></i>
        </button>
    @endif
</form>