<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    @if (auth()->user()->role->nama_role == 'AM Wilayah')
        <title>Payment integrasi System - AM Wilayah</title>
    @elseif (auth()->user()->role->nama_role == 'Admin')
        <title>Payment integrasi System - Admin</title>
    @endif
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('V-TAX/img/hial.png') }}" rel="icon">
    <link href="{{ asset('V-TAX/img/hial.png') }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('V-TAX/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('V-TAX/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('V-TAX/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('V-TAX/vendor/quill/quill.snow.css') }}" rel="stylesheet">
    <link href="{{ asset('V-TAX/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
    <link href="{{ asset('V-TAX/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('V-TAX/vendor/simple-datatables/style.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('V-TAX/css/style.css') }}" rel="stylesheet">

</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <a class="logo d-flex align-items-center">
                <img src="{{ asset('V-TAX/img/kol.png') }}" alt="">
                <span class="d-none d-lg-block">PAYMENT INTEGRASI SYSTEM</span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div><!-- End Logo -->



        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">

                <li class="nav-item d-block d-lg-none">
                    <a class="nav-link nav-icon search-bar-toggle " href="#">
                        <i class="bi bi-search"></i>
                    </a>
                </li><!-- End Search Icon-->



                <li class="nav-item dropdown pe-3">

                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#"
                        data-bs-toggle="dropdown">
                        <span class="d-none d-md-block dropdown-toggle ps-2">{{ auth()->user()->username }}</span>
                    </a><!-- End Profile Iamge Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <h6>{{ auth()->user()->full_name }}</h6>
                            <span>{{ auth()->user()->role->nama_role }}</span>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="{{ route('admin.profil') }}">
                                <i class="bi bi-person"></i>
                                <span>My Profile</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="{{ route('admin.profil') }}">
                                <i class="bi bi-gear"></i>
                                <span>Account Settings</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>


                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="{{ route('login') }}">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Sign Out</span>
                            </a>
                        </li>

                    </ul><!-- End Profile Dropdown Items -->
                </li><!-- End Profile Nav -->

            </ul>
        </nav><!-- End Icons Navigation -->

    </header><!-- End Header -->


    <aside id="sidebar" class="sidebar">
        <ul class="sidebar-nav" id="sidebar-nav">

            {{-- Jika pengguna adalah AM Wilayah --}}
            @if (auth()->user()->role->nama_role == 'AM Wilayah')
                <li class="nav-item">
                    <a class="nav-link @yield('side0')" href="{{ route('admin.dashboard') }}">
                        <i class="bi bi-grid"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link @yield('side1')" href="{{ route('belumvalidasi') }}">
                        <i class="bi bi-clipboard-data"></i>
                        <span>Pengajuan</span>
                    </a>
                </li>
            @elseif(auth()->user()->role->nama_role == 'Admin')
                {{-- Jika pengguna adalah Admin, tampilkan semua menu --}}
                <li class="nav-item">
                    <a class="nav-link @yield('side0')" href="{{ route('admin.utama') }}">
                        <i class="bi bi-grid"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link @yield('side1')" href="{{ route('admin.datadiajukan') }}">
                        <i class="bi bi-clipboard-data"></i>
                        <span>Pengajuan</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link @yield('side3')" href="{{ route('data.mitra') }}">
                        <i class="bi bi-bank"></i>
                        <span>Mitra</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link @yield('side10')" href="{{ route('data.provinsi') }}">
                        <i class="bi bi-map"></i>
                        <span>Provinsi</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link @yield('side4')" href="{{ route('data.wilayah') }}">
                        <i class="bi bi-map-fill"></i>
                        <span>Wilayah</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link @yield('side6')" href="{{ route('data.jenispajak') }}">
                        <i class="bi bi-menu-up"></i>
                        <span>Jenis Pajak</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link @yield('side7')" href="{{ route('data.jenistransaksi') }}">
                        <i class="bi bi-layout-wtf"></i>
                        <span>Jenis Transaksi</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link @yield('side11')" href="{{ route('data.pengajuanintegrasi') }}">
                        <i class="bi bi-box-seam-fill"></i>
                        <span>Pengajuan Integrasi</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link @yield('side12')" href="{{ route('data.role') }}">
                        <i class="bi bi-unity"></i>
                        <span>Role</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link @yield('side5')" href="{{ route('pengguna.baru') }}">
                        <i class="bi bi-person"></i>
                        <span>Pengguna</span>
                    </a>
                </li>
            @else
                {{-- Jika role tidak terdeteksi --}}
                <div class="alert alert-danger text-center">
                    <strong>Error:</strong> Role tidak dikenali atau tidak memiliki akses!
                </div>
            @endif

        </ul>
    </aside>


    <main id="main" class="main">


        </div><!-- End Page Title -->
        @yield('content')
    </main><!-- End #main -->


    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{ asset('V-TAX/vendor/apexcharts/apexcharts.min.js"') }}"></script>
    <script src="{{ asset('V-TAX/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('V-TAX/vendor/chart.js/chart.umd.js') }}"></script>
    <script src="{{ asset('V-TAX/vendor/echarts/echarts.min.js') }}"></script>
    <script src="{{ asset('V-TAX/vendor/quill/quill.js') }}"></script>
    <script src="{{ asset('V-TAX/vendor/simple-datatables/simple-datatables.js') }}"></script>
    <script src="{{ asset('V-TAX/vendor/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('V-TAX/vendor/php-email-form/validate.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('V-TAX/js/main.js') }}"></script>

</body>

</html>
