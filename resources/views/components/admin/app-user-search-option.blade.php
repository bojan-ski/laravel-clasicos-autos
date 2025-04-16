<form method="GET" action="{{ route('admin.search') }}" class="mb-5">
    <input type="text" name="search_term" placeholder="Enter user"
        class="bg-white w-72 md:w-1/2 px-4 py-3 focus:outline-none bg-w" value="{{ request('search_term') }}" />
    <button class="w-auto bg-red-600 hover:bg-red-700 text-white px-4 py-3 focus:outline-none">
        <i class="fa fa-search mr-1"></i> Search
    </button>
</form>