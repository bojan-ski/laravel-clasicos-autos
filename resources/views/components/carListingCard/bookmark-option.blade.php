@props(['listing'])

<form method="POST" action="{{ route('listings.bookmark', $listing->id) }}">
    @csrf
    @if (auth()->user() && auth()->user()->userBookmarks()->where('car_listing_id', $listing->id)->exists())
    @method("DELETE")
    <button type="submit" class="btn bg-red-500 text-white hover:bg-transparent hover:text-red-500">
        <i class="fa-regular fa-bookmark"></i>
    </button>
    @else
    <button type="submit" class="btn text-red-500 hover:bg-red-500 hover:text-white">
        <i class="fa-regular fa-bookmark"></i>
    </button>
    @endif
</form>