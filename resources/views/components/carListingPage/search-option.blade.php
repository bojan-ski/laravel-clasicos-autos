<form method="GET" action="{{ route('listings.search') }}" class="mb-5">
    {{-- search term --}}
    <input type="text" name="search_term" placeholder="Enter search term"
        class="bg-white w-72 md:w-1/2 px-4 py-3 focus:outline-none bg-w" value="{{ request('search_term') }}" />

    {{-- submit btn --}}
    <button class="w-auto bg-red-600 hover:bg-red-700 transition text-white px-4 py-3 focus:outline-none cursor-pointer">
        <i class="fa fa-search mr-1"></i> Search
    </button>
</form>

<p>
    If you you are searching for a specific car, check out the: <a href="{{ route('listings.showAdvanceSearch') }}"
        class="text-blue-500 hover:text-blue-600 transition duration-150 font-bold">
        Advance Search
    </a>
</p>