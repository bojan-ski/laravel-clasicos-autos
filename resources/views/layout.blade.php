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

    {{-- font-awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

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