<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Payment integrasi System - Admin</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="btc/assets/img/hial.png" rel="icon">
  <link href="btc/assets/img/hial.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="btc/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="btc/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="btc/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="btc/assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="btc/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="btc/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="btc/assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="btc/assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Updated: Apr 20 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="index.html" class="logo d-flex align-items-center">
        <img src="btc/assets/img/sip0.png" alt="">
        <span class="d-none d-lg-block">PAYMENT INTEGRASI SYSTEM</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <div class="search-bar">
      <form class="search-form d-flex align-items-center" method="POST" action="#">
        <input type="text" name="query" placeholder="Search" title="Enter search keyword">
        <button type="submit" title="Search"><i class="bi bi-search"></i></button>
      </form>
    </div><!-- End Search Bar -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li><!-- End Search Icon-->

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="btc/assets/img/Default-avatar.png" alt="Profile" class="rounded-circle">
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
              <a class="dropdown-item d-flex align-items-center" href="{{route('data.detailpengguna')}}">
                <i class="bi bi-person"></i>
                <span>My Profile</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="{{route('data.detailpengguna')}}">
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


  {{-- @yield('sideact') --}}
  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link @yield('side0')" href="{{route('index.index0')}}">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->


      <li class="nav-item">
        <a  class=" nav-link @yield('side1')" href="{{ route('admin.datadiajukan') }}">
          <i class="bi bi-clipboard-data"></i>
          <span>pengajuan</span>
        </a>
      </li>
      {{-- end table list --}}

      <li class="nav-item">
        <a  class=" nav-link @yield('side3')" href="{{ route('data.mitra') }}">
          <i class="bi bi-bank"></i>
          <span>Mitra</span>
        </a>
      </li>
      {{-- end mitra --}}

      <li class="nav-item">
        <a  class=" nav-link @yield('side4')" href="{{ route('data.wilayah') }}">
          <i class="bi bi-map"></i>
          <span>Wilayah</span>
        </a>
      </li>
      {{-- end wilayah --}}

      <li class="nav-item">
        <a  class=" nav-link @yield('side10')" href="{{ route('data.provinsi') }}">
          <i class="bi bi-map"></i>
          <span>provinsi</span>
        </a>
      </li>
      {{-- end provinsi --}}

      <li class="nav-item">
        <a  class=" nav-link @yield('side6')" href="{{ route('data.jenispajak') }}">
          <i class="bi bi-menu-up"></i>
          <span>Jenis pajak</span>
        </a>
      </li>
      {{-- end jenispajak --}}

      <li class="nav-item">
        <a  class=" nav-link @yield('side7')" href="{{ route('data.jenistransaksi') }}">
          <i class="bi bi-layout-wtf"></i>
          <span>Jenis transaksi</span>
        </a>
      </li>
      {{-- end jenistransaksi--}}

      <li class="nav-item">
        <a  class=" nav-link @yield('side8')" href="{{ route('data.pengajuanintegrasi') }}">
          <i class="bi bi-box-seam-fill"></i>
          <span>Pengajuan Integrasi</span>
        </a>
      </li>
      {{-- end jenistransaksi--}}

      <li class="nav-item">
        <a  class=" nav-link @yield('side5')" href="{{ route('pengguna.baru') }}">
          <i class="bi bi-person"></i>
          <span>Pengguna</span>
        </a>
      </li>
      {{-- end Pengguna --}}
      {{-- <li class="nav-item">
        <a  class=" nav-link @yield('side9')" href="{{ route('user.wilayah') }}">
          <i class="bi bi-person"></i>
          <span>Tambah wilayah untuk am</span>
        </a>
      </li>
      end Pengguna --}}





    </ul>

  </aside><!-- End Sidebar-->

 @yield('content')

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="btc/assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="btc/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="btc/assets/vendor/chart.js/chart.umd.js"></script>
  <script src="btc/assets/vendor/echarts/echarts.min.js"></script>
  <script src="btc/assets/vendor/quill/quill.js"></script>
  <script src="btc/assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="btc/assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="btc/assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="btc/assets/js/main.js"></script>

</body>

</html>
