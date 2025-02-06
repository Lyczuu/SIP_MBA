@extends('layout.am_wilayahfeelayout')

@section('title', 'Dashboard')

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

                <!-- Customers Card -->


                      <div class="col-xxl-4 col-xl-6">

                        <div class="card info-card customers-card">

                          <div class="filter">
                            <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
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
                                <span class="badge bg-warning" onclick="window.location.href='/belumvalidasi'" style="cursor: pointer;">Belum Validasi</span> <span id="notif-belumvalidasi" class="badge bg-warning" onclick="window.location.href='/belumvalidasi'" style="cursor: pointer;">0</span></td> | <span class="badge bg-success" onclick="window.location.href='/diterima'" style="cursor: pointer;">Diterima</span> <span class="badge bg-success" onclick="window.location.href='/diterima'" style="cursor: pointer;">8</span></td> | <span class="badge bg-danger" onclick="window.location.href='/ditolak'" style="cursor: pointer;">Ditolak</span> <span id="notif-ditolak" class="badge bg-danger" onclick="window.location.href='/ditolak'" style="cursor: pointer;">0</span></td>


                              </div>
                            </div>

                          </div>
                        </div>
                      </div>

                      <div class="col-xxl-4 col-xl-6">

                        <div class="card info-card customers-card">

                          <div class="filter">
                            <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
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
                                <span class="badge bg-warning" onclick="window.location.href='/belumvalidasi'" style="cursor: pointer;">Belum Validasi</span> <span id="notif-belumvalidasi" class="badge bg-warning" onclick="window.location.href='/belumvalidasi'" style="cursor: pointer;">0</span></td> | <span class="badge bg-success" onclick="window.location.href='/diterima'" style="cursor: pointer;">Diterima</span> <span class="badge bg-success" onclick="window.location.href='/diterima'" style="cursor: pointer;">8</span></td> | <span class="badge bg-danger" onclick="window.location.href='/ditolak'" style="cursor: pointer;">Ditolak</span> <span class="badge bg-danger" onclick="window.location.href='/ditolak'" style="cursor: pointer;">8</span></td>

                              </div>
                            </div>

                          </div>
                        </div>
                      </div>

                      <!-- Sales Card -->
                      <div class="col-xxl-4 col-md-4">
                        <div class="card info-card sales-card">

                          <div class="filter">
                            <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
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
                              <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-graph-up"></i>
                              </div>
                              <div class="ps-3">
                                <h6>145</h6>
                                <span class="text-success small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">increase</span>

                              </div>
                            </div>
                          </div>


                        </div>
                      </div><!-- End Sales Card -->

                              <!-- Sales Card -->
                      <div class="col-xxl-4 col-md-4">
                        <div class="card info-card sales-card">

                          <div class="filter">
                            <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
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
                              <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-graph-up"></i>
                              </div>
                              <div class="ps-3">
                                <h6>$3,264</h6>
                                <span class="text-success small pt-1 fw-bold">8%</span> <span class="text-muted small pt-2 ps-1">increase</span>

                              </div>
                            </div>
                          </div>

                        </div>
                      </div><!-- End Revenue Card -->


                      <!-- Recent Sales -->
                      <div class="col-12">
                        <div class="card recent-sales overflow-auto">

                          <div class="filter">
                            <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
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
                      <th>Jenis pajak</th>
                      <th>Total fee</th>
                      <th>Fee mba</th>
                      <th>Fee mitra</th>
                      <th>Status</th>
                      <th>Wilayah</th>
                      <th>Jenis mitra</th>
                      <th>Jenis transaksi</th>
                      <th>Mitra agg</th>
                      <th>Cutt off</th>
                      <th>Settlement</th>
                      <th>nomor registrasi legal</th>
                      <th>Pengajuan integrasi</th>
                      <th>Wag kordinasi payment</th>
                      <th>Wag kordinasi rekon</th>
                      <th>Pic payment mitra</th>
                      <th>telepon payment mitra</th>
                      <th>Pic rekon mitra</th>
                      <th>telepon rekon mitra</th>
                      <th>Pic dinas</th>
                      <th>telepon Dinas</th>
                      <th data-type="date" data-format="YYYY/DD/MM">Start Date</th>
                      <th>Completion</th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach($paymentmbafee as $key => $list)
                    <tr>
                      <td>{{ $list->kode_pengajuan }}</td>
                      <td>{{ $list->user->username }}</td>
                      <td>{{ $list->jenis_pajak_id }}</td>
                      <td>{{ $list->fees->total_fee }}</td>
                      <td>{{ $list->fees->fee_mba }}</td>
                      <td>{{ $list->fees->fee_mitra }}</td>
                      <td>{{ $list->status}}</td>
                      <td>{{ $list->wilayah->nama_wilayah }}</td>
                      <td>{{ $list->mitra->nama_mitra }}</td>
                      <td>{{ $list->jenis_transaksi->nama_jenis_transaksi }}</td>
                      <td>{{ $list->mitra_agg }}</td>
                      <td>{{ $list->cutoff }}</td>
                      <td>{{ $list->settlement }}</td>
                      <td>{{ $list->nomor_registrasi_legal }}</td>
                      <td>{{ $list->pengajuan_integrasi }}</td>
                      <td>{{ $list->wag_kordinasi_payment }}</td>
                      <td>{{ $list->wag_kordinasi_rekon }}</td>
                      <td>{{ $list->pic_payment_mitra }}</td>
                      <td>{{ $list->telepon_payment_mitra }}</td>
                      <td>{{ $list->pic_rekon_mitra }}</td>
                      <td>{{ $list->telepon_rekon_mitra }}</td>
                      <td>{{ $list->pic_dinas }}</td>
                      <td>{{ $list->telepon_dinas }}</td>
                      <td>2005/02/11</td>
                      <td>37%</td>
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
      </section>

    </main><!-- End #main -->



  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>


</body>

</html>


    </div>
@endsection
