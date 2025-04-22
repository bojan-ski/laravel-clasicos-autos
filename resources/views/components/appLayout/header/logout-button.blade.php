<form method="POST" action="{{ route('logout') }}">
    @csrf

    <button type="submit" class="btn text-md mx-2 bg-red-900 text-white hover:bg-red-700">
        <span class="hidden md:block">
            Logout
        </span>
        <span>
            <i class="fa-solid fa-right-from-bracket"></i>
        </span>
    </button>
</form>