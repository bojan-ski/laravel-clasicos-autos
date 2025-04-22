@if (Request::path() !== 'compare')
    <div class="fixed top-100 right-10">
        <a href="{{ route('compare.show') }}"
            class="bg-red-600 text-white px-6 py-4 rounded-md hover:bg-red-700 font-semibold border-2 border-white">
            <i class="fa-solid fa-code-compare"></i>
        </a>
    </div>
@endif