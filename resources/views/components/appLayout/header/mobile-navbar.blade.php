<div class="xl:hidden navbar-center">
    <div class="dropdown">
        <div tabindex="0" role="button" class="btn btn-ghost">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
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
                <li class="mb-3">
                    <a href="{{ route('conversations.index') }}"
                        class="relative btn text-md mx-2 hover:bg-yellow-500 {{ request()->is('conversations') ? 'bg-yellow-500' : '' }}">
                        Conversations
                    </a>

                    <!-- notification badge -->
                    <span id="mobile-message-notification-badge"
                        class="absolute top-0 right-0 px-2 py-1 text-xs font-bold leading-none text-white transform translate-x-1/2 -translate-y-1/2 bg-red-600 rounded-full border hidden">
                        0
                    </span>
                </li>
            @if (Auth::user()->role == 'app_user')
                <li class="mb-3">
                    <a href="{{ route('profile.index') }}"
                        class="btn text-md mx-2 hover:bg-yellow-500 {{ request()->is('profile') ? 'bg-yellow-500' : '' }}">
                        Profile
                    </a>
                </li>
            @else
                <li>
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