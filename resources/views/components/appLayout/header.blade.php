<header class="header">
    <div class="navbar bg-red-600 text-white px-6 py-4 border-b-4 border-yellow-500">
        <div class="navbar-start">
            <h2 class="text-4xl font-bold">
                Clasicos Autos
            </h2>
        </div>

        {{-- mobile --}}
        <div class="lg:hidden navbar-center">
            <div class="dropdown">
                <div tabindex="0" role="button" class="btn btn-ghost">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h7" />
                    </svg>
                </div>
                <ul tabindex="0" class="menu menu-sm dropdown-content bg-base-100 rounded-box z-1 mt-3 w-52 p-2 shadow">
                    <li class="mb-3">
                        <a class="btn text-md mx-2 hover:bg-yellow-500">
                            Home
                        </a>
                    </li>
                    <li class="mb-3">
                        <a class="btn text-md mx-2 hover:bg-yellow-500">
                            Listings
                        </a>
                    </li>
                    <li class="mb-3">
                        <a class="btn text-md mx-2 hover:bg-yellow-500">
                            Bookmarked
                        </a>
                    </li>
                    <li>
                        <a class="btn text-md mx-2 hover:bg-yellow-500">
                            Profile
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        {{-- desktop --}}
        <div class="hidden lg:block navbar-center">
            <a href="/" class="btn text-md mx-2 hover:bg-yellow-500 bg-yellow-500">
                Home
            </a>
            <a class="btn text-md mx-2 hover:bg-yellow-500">
                Listings
            </a>
            <a class="btn text-md mx-2 hover:bg-yellow-500">
                Bookmarked
            </a>
            <a class="btn text-md mx-2 hover:bg-yellow-500">
                Profile
            </a>
        </div>
        <div class="navbar-end">
            @auth
            <a class="btn text-md mx-2 bg-blue-600 text-white hover:bg-blue-500">
                List Car
            </a>
            {{-- logout button --}}
            <x-logout-button />
            @else
            {{-- register --}}
            <a href="{{ route('register') }}" class="btn text-md mx-2 bg-yellow-600 text-white hover:bg-yellow-500">
                Register
            </a>
            {{-- login --}}
            <a href="{{ route('login') }}" class="btn text-md mx-2 bg-yellow-600 text-white hover:bg-yellow-500">
                Login
            </a>
            @endauth
        </div>
    </div>
</header>