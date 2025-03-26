<form method="POST" action="{{ route('logout') }}">
    @csrf

    <button type="submit" class="btn text-md mx-2 bg-red-900 text-white hover:bg-red-700">
        Logout
    </button>
</form>