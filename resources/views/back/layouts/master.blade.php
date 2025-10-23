<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logistika</title>
    @include('back.includes.style')
</head>

<body>
    @include('back.includes.header')

    @include('back.includes.navbar')

    @yield('content')

    @include('back.includes.footer')

    @include('back.includes.script')
</body>

</html>
