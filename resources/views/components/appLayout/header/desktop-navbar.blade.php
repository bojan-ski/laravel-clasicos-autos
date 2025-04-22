<div class="hidden xl:block navbar-center">
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
        <a href="{{ route('conversations.index') }}"
            class="relative btn text-md mx-2 hover:bg-yellow-500 {{ request()->is('conversations') ? 'bg-yellow-500' : '' }}">
            Conversations

            <!-- notification badge -->
            <span id="message-notification-badge"
                class="absolute top-0 right-0 px-2 py-1 text-xs font-bold leading-none text-white transform translate-x-1/2 -translate-y-1/2 bg-red-600 rounded-full border hidden">
                0
            </span>
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