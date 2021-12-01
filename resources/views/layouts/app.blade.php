<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Manajemen Barang Lebih &mdash; PT. Torabika Eka Semesta</title>

    @include('includes.style')
</head>

<body>
    <div id="app">
        <div class="main-wrapper">

            @include('includes.navbar')

            @include('includes.sidebar')

            <!-- Main Content -->
            @yield('content')

            @include('includes.footer')
        </div>
    </div>

    @include('includes.script')
    @stack('addon-script')
    @stack('select-script')
    @stack('select-edit-script')
</body>

</html>
