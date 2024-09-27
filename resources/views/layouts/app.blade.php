<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @yield('style')
    @livewireStyles
</head>

<body class="bg-gray-100">
    @include('layouts.header')

    <section>
        @yield('content')
    </section>

    @include('layouts.footer')


    @livewireScripts
</body>

</html>
