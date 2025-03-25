<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- tailwind import --}}
    @vite('resources/css/app.css')

    {{-- custom css --}}
    <link rel="stylesheet" href="{{asset('/css/style.css')}}">

    {{-- title --}}
    <title>Clasicos Autos</title>
</head>

<body class="bg-amber-100">
    <x-appLayout.header/>

    <main>
        {{ $slot }}
    </main>

    <x-appLayout.footer/>
</body>

</html>