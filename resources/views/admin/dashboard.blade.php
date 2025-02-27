@extends('layout.am_wilayahfeelayout')

@section('side0', 'active')
@section('side1', 'collapsed')
@section('side3', 'collapsed')
@section('side10', 'collapsed')
@section('side4', 'collapsed')
@section('side6', 'collapsed')
@section('side7', 'collapsed')
@section('side8', 'collapsed')
@section('side5', 'collapsed')
@section('side11', 'collapsed')
@section('content')
    <div class="container mt-4">

        {{-- Jika ada pesan status --}}
        @if (Session::has('status'))
            <div class="alert alert-success" role="alert">
                {{ Session::get('message') }}
            </div>
        @endif
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="utf-8">
            <meta content="width=device-width, initial-scale=1.0" name="viewport">

            <meta content="" name="description">
            <meta content="" name="keywords">


        </head>

        <body>

            <div class="pagetitle">
                <h1>Dashboard</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </nav>
            </div><!-- End Page Title -->

            <section class="section">
                <div class="row">
                    <div class="col-lg-12">

                        <section class="section dashboard">
                            <div class="row">

                                <!-- fee based Card -->
                                <div class="col-xxl-4 col-xl-6">

                                    <div class="card info-card customers-card">

                                        <div class="filter">
                                            <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                                    class="bi bi-three-dots"></i></a>
                                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                                <li class="dropdown-header text-start">
                                                    <h6>Filter</h6>
                                                </li>

                                                <li><a class="dropdown-item" href="#">Today</a></li>
                                                <li><a class="dropdown-item" href="#">This Month</a></li>
                                                <li><a class="dropdown-item" href="#">This Year</a></li>
                                            </ul>
                                        </div>

                                        <div class="card-body">
                                            <h5 class="card-title">Integrasi Mitra Feebased </span></h5>

                                            <div class="d-flex align-items-center">
                                                <div class="ps-3">
                                                    <span class="badge bg-warning"
                                                        onclick="window.location.href='/feebelumvalidasi'"
                                                        style="cursor: pointer;">Belum Validasi</span></td> | <span
                                                        class="badge bg-success"
                                                        onclick="window.location.href='/feediterima'"
                                                        style="cursor: pointer;">Diterima</span></td> | <span
                                                        class="badge bg-danger" onclick="window.location.href='/feeditolak'"
                                                        style="cursor: pointer;">Ditolak</span> </td>


                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="col-xxl-4 col-xl-6">

                                    <div class="card info-card customers-card">

                                        <div class="filter">
                                            <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                                    class="bi bi-three-dots"></i></a>
                                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                                <li class="dropdown-header text-start">
                                                    <h6>Filter</h6>
                                                </li>

                                                <li><a class="dropdown-item" href="#">Today</a></li>
                                                <li><a class="dropdown-item" href="#">This Month</a></li>
                                                <li><a class="dropdown-item" href="#">This Year</a></li>
                                            </ul>
                                        </div>

                                        <div class="card-body">
                                            <h5 class="card-title">Integrasi Mitra Non Feebased </span></h5>

                                            <div class="d-flex align-items-center">
                                                <div class="ps-3">
                                                    <span class="badge bg-warning"
                                                        onclick="window.location.href='/nofeebelumvalidasi'"
                                                        style="cursor: pointer;">Belum Validasi</span> </td> | <span
                                                        class="badge bg-success"
                                                        onclick="window.location.href='/nofeediterima'"
                                                        style="cursor: pointer;">Diterima</span> </td> | <span
                                                        class="badge bg-danger"
                                                        onclick="window.location.href='/nofeeditolak'"
                                                        style="cursor: pointer;">Ditolak</span> <span
                                                        class="badge bg-danger"
                                                        onclick="window.location.href='/nofeeditolak'"
                                                        style="cursor: pointer;">8</span></td>

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <!-- Sales Card -->
                                <div class="col-xxl-4 col-md-4">
                                    <div class="card info-card sales-card">

                                        <div class="filter">
                                            <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                                    class="bi bi-three-dots"></i></a>
                                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                                <li class="dropdown-header text-start">
                                                    <h6>Filter</h6>
                                                </li>

                                                <li><a class="dropdown-item" href="#">Today</a></li>
                                                <li><a class="dropdown-item" href="#">This Month</a></li>
                                                <li><a class="dropdown-item" href="#">This Year</a></li>
                                            </ul>
                                        </div>

                                        <div class="card-body">
                                            <h5 class="card-title">AM Wilayah 1</h5>

                                            <div class="d-flex align-items-center">
                                                <div
                                                    class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                    <i class="bi bi-graph-up"></i>
                                                </div>
                                                <div class="ps-3">
                                                    <h6>{{$totalpengajuan}}</h6>
                                                    <span class="text-success small pt-1 fw-bold">12%</span> <span
                                                        class="text-muted small pt-2 ps-1">increase</span>

                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div><!-- End Sales Card -->

                                <!-- Sales Card -->
                                <div class="col-xxl-4 col-md-4">
                                    <div class="card info-card sales-card">

                                        <div class="filter">
                                            <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                                    class="bi bi-three-dots"></i></a>
                                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                                <li class="dropdown-header text-start">
                                                    <h6>Filter</h6>
                                                </li>

                                                <li><a class="dropdown-item" href="#">Today</a></li>
                                                <li><a class="dropdown-item" href="#">This Month</a></li>
                                                <li><a class="dropdown-item" href="#">This Year</a></li>
                                            </ul>
                                        </div>

                                        <div class="card-body">
                                            <h5 class="card-title">AM Kerja Sama</h5>

                                            <div class="d-flex align-items-center">
                                                <div
                                                    class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                    <i class="bi bi-graph-up"></i>
                                                </div>
                                                <div class="ps-3">
                                                    <h6>{{$totalMitraAgg}}</h6>
                                                    <span class="text-success small pt-1 fw-bold">8%</span> <span
                                                        class="text-muted small pt-2 ps-1">Jumlah Kerja Sama</span>

                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div><!-- End Revenue Card -->


                                <!-- Recent Sales -->
                                <div class="col-12">
                                    <div class="card recent-sales overflow-auto">

                                        <div class="filter">
                                            <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                                    class="bi bi-three-dots"></i></a>
                                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                                <li class="dropdown-header text-start">
                                                    <h6>Filter</h6>
                                                </li>

                                                <li><a class="dropdown-item" href="#">Today</a></li>
                                                <li><a class="dropdown-item" href="#">This Month</a></li>
                                                <li><a class="dropdown-item" href="#">This Year</a></li>
                                            </ul>
                                        </div>



                                        <div class="card">
                                            <div class="card-body">

                                                <h5 class="card-title">dashboard</h5>

                                                <h5 class="card-title">Terakhir <span>| Diajukan</span></h5>
                                                <p>data tabel No fee admin dan fee admin </p>

                                                <!-- Table with stripped rows -->
                                                <div class="table-responsive">
                                                    <table class="table datatable">
                                                        <thead>
                                                            <tr>
                                                                <th>Kode Pengajuan</th>
                                                                <th>
                                                                    <b>N</b>ame
                                                                </th>
                                                                <th>Nama mitra</th>
                                                                <th>Nama wilayah</th>
                                                                <th>Jenis pajak</th>
                                                                <th>Nama Jenis transaksi</th>
                                                                <th>Wag kordinasi payment</th>
                                                                <th>Aksi</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($paymentmba as $key => $list)
                                                                <tr>
                                                                    <td>{{ $list->kode_pengajuan }}</td>
                                                                    <td>{{ $list->user->username }}</td>
                                                                    <td>{{ $list->mitra->nama_mitra }}</td>
                                                                    <td>{{ $list->wilayah->nama_wilayah }}</td>
                                                                    <td>{{ $list->jenis_pajak_nama }}</td>
                                                                    <td>{{ $list->jenis_transaksi->nama_jenis_transaksi }}
                                                                    </td>
                                                                    <td>{{ $list->wag_kordinasi_payment }}</td>
                                                                    <td>
                                                                        <div class="col-3">
                                                                            <button class="btn btn-dark btn-sm"
                                                                                data-bs-toggle="modal"
                                                                                data-bs-target="#Editpayment{{ $list->id }}">
                                                                                <i class="bi bi-pencil-square"></i> Detail
                                                                            </button>
                                                                        </div>
                                                                    </td>
                                                                    @include('admin.modal.detaildiajukan')
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                    <!-- End Table with stripped rows -->

                                                </div>
                                            </div>
                                            {{-- end card div --}}

                                        </div>
                                    </div>
                                </div>
                        </section>
            </section>

            </main><!-- End #main -->



            <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
                    class="bi bi-arrow-up-short"></i></a>


        </body>

        </html>


    </div>
@endsection
