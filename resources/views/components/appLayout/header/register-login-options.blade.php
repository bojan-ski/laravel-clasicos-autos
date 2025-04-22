{{-- register --}}
<a href="{{ route('register') }}"
    class="btn text-md mx-2 text-white hover:bg-yellow-500 {{ request()->is('register') ? 'bg-yellow-500' : 'bg-yellow-600' }}">
    <span>
        <i class="fa-solid fa-user-plus"></i>
    </span>
    <span class="hidden md:block">
        Register
    </span>
</a>

{{-- login --}}
<a href="{{ route('login') }}"
    class="btn text-md mx-2 text-white hover:bg-yellow-500 {{ request()->is('login') ? 'bg-yellow-500' : 'bg-yellow-600' }}">
    <span>
        <i class="fa-solid fa-right-to-bracket"></i>
    </span>
    <span class="hidden md:block">
        Login
    </span>
</a>