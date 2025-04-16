<header class="header">
    <div class="navbar bg-red-600 text-white px-6 py-4 border-b-4 border-yellow-500">

        {{-- Logo --}}
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
                        <a href="/"
                            class="btn text-md mx-2 hover:bg-yellow-500 {{ request()->is('/') ? 'bg-yellow-500' : '' }}">
                            Home
                        </a>
                    </li>
                    <li class="mb-3">
                        <a href="{{ route('listings') }}"
                            class="btn text-md mx-2 hover:bg-yellow-500 {{ request()->is('listings') ? 'bg-yellow-500' : '' }}">
                            Listings
                        </a>
                    </li>
                    @auth
                    <li class="mb-3">
                        <a href="{{ route('bookmarks.index') }}"
                            class="btn text-md mx-2 hover:bg-yellow-500 {{ request()->is('bookmarks') ? 'bg-yellow-500' : '' }}">
                            Bookmarked
                        </a>
                    </li>
                    @if (Auth::user()->role == 'app_user')
                    <li class="mb-3">
                        <a href="{{ route('profile.index') }}"
                            class="btn text-md mx-2 hover:bg-yellow-500 {{ request()->is('profile') ? 'bg-yellow-500' : '' }}">
                            Profile
                        </a>
                    </li>
                    @else<li>
                        <a href="{{ route('admin.index') }}"
                            class="btn text-md mx-2 hover:bg-yellow-500 {{ request()->is('app_users') ? 'bg-yellow-500' : '' }}">
                            App Users
                        </a>
                    </li>
                    @endif
                    @endauth
                </ul>
            </div>
        </div>

        {{-- desktop --}}
        <div class="hidden lg:block navbar-center">
            <a href="/" class="btn text-md mx-2 hover:bg-yellow-500 {{ request()->is('/') ? 'bg-yellow-500' : '' }}">
                Home
            </a>
            <a href="{{ route('listings') }}"
                class="btn text-md mx-2 hover:bg-yellow-500 {{ request()->is('listings') ? 'bg-yellow-500' : '' }}">
                Listings
            </a>
            @auth
            <a href="{{ route('bookmarks.index') }}"
                class="btn text-md mx-2 hover:bg-yellow-500 {{ request()->is('bookmarks') ? 'bg-yellow-500' : '' }}">
                Bookmarked
            </a>
            @if (Auth::user()->role == 'app_user')
            <a href="{{ route('profile.index') }}"
                class="btn text-md mx-2 hover:bg-yellow-500 {{ request()->is('profile') ? 'bg-yellow-500' : '' }}">
                Profile
            </a>
            @else
            <a href="{{ route('admin.index') }}"
                class="btn text-md mx-2 hover:bg-yellow-500 {{ request()->is('app_users') ? 'bg-yellow-500' : '' }}">
                App Users
            </a>
            @endif
            @endauth
        </div>

        {{-- auth - list car listing --}}
        <div class="navbar-end">
            @auth
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
            {{-- logout button --}}
            <x-logout-button />
            @else
            {{-- register --}}
            <a href="{{ route('register') }}"
                class="btn text-md mx-2 text-white hover:bg-yellow-500 {{ request()->is('register') ? 'bg-yellow-500' : 'bg-yellow-600' }}">
                Register
            </a>
            {{-- login --}}
            <a href="{{ route('login') }}"
                class="btn text-md mx-2 text-white hover:bg-yellow-500 {{ request()->is('login') ? 'bg-yellow-500' : 'bg-yellow-600' }}">
                Login
            </a>
            @endauth
        </div>

    </div>
</header>