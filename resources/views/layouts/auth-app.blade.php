<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Login Dashboard</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('/stisla-master/assets/img/mayora-img.png') }}">

    @include('includes.style')
</head>

<body>
    <div id="app">
        @yield('content')
    </div>

    @include('includes.script')
</body>

</html>
