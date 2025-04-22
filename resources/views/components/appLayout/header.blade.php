<header class="header">
    <div
        class="navbar text-white px-6 py-4 border-b-4 border-yellow-500 {{ auth()->check() && auth()->user()->role == 'admin_user' ? 'bg-gray-800' : 'bg-red-600' }}">

        {{-- Logo --}}
        <div class="navbar-start">
            <h2 class="text-4xl font-bold">
                Clasicos Autos
            </h2>
        </div>

        {{-- mobile --}}
        <x-appLayout.header.mobile-navbar />

        {{-- desktop --}}
        <x-appLayout.header.desktop-navbar />

        {{-- AUTH - LIST/POST CAR LISTING --}}
        <div class="navbar-end">
            @auth
            {{-- list/post car listing --}}
            <x-appLayout.header.list-car-option />

            {{-- logout button --}}
            <x-appLayout.header.logout-button />
            @else
            {{-- register & login options --}}
            <x-appLayout.header.register-login-options />
            @endauth
        </div>

    </div>
</header>