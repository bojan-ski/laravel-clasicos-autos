<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- tailwind import --}}
    @vite('resources/css/app.css')

    {{-- custom css --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    {{-- font-awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- title --}}
    <title>
        Clasicos Autos
    </title>
</head>

<body class="bg-amber-100 relative">
    {{-- HEADER --}}
    <x-appLayout.header />

    {{-- loading --}}
    <x-loading />

    {{-- pop-up messages success --}}
    @if (session('success'))
        <x-pop-up-message type='success' message="{{ session('success') }}" />
    @endif

    {{-- pop-up messages error --}}
    @if (session('error'))
        <x-pop-up-message type='error' message="{{ session('error') }}" />
    @endif

    {{-- compare option - button --}}
    @if (session('compare_listings'))
        <x-compare-button />
    @endif

    {{-- MAIN - app content --}}
    <main>
        {{ $slot }}
    </main>

    {{-- FOOTER --}}
    <x-appLayout.footer />

    {{-- custom js --}}
    <script src="{{ asset('/js/loading.js') }}"></script>
    <script src="{{ asset('/js/newMessagesCheck.js') }}"></script>
    <script src="{{ asset('/js/closePopUpMsg.js') }}"></script>
    <script src="{{ asset('/js/selectCarListingImage.js') }}"></script>
</body>

</html>