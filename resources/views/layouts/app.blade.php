<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
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
</body>

</html>
