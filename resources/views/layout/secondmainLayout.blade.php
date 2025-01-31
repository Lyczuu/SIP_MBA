<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <title>@yield('title')</title>
</head>
<body>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link {{ Request::is('admin/home') ? 'active' :''}}" aria-current="page" href="/admin/home"></a>
            </li>
            {{-- <li class="nav-item">
                <a class="nav-link {{ Request::is('admin/kategori') ? 'active' : ''}}" aria-current="page" href="/admin/kategori">Kategori</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('admin/barang') ? 'active' : ''}}" aria-current="page" href="/admin/barang">Barang</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('admin/transaksi') ? 'active' : ''}}" aria-current="page" href="/admin/transaksi">Transaksi</a>
            </li> --}}
            {{-- <li class="na-item">
                <a class="nav-link" href="/logout">Logout</a> --}}
        </ul>
    </nav>
    <div class="container">
        @yield('content')
    </div>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
