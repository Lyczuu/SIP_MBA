@extends('layout.am_wilayahfeelayout')

@section('title', 'Dashboard')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Halaman Dashboard</h1>

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


  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{asset ('V-TAX/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset ('V-TAX/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
  <link href="{{asset ('V-TAX/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
  <link href="{{asset ('V-TAX/vendor/quill/quill.snow.css')}}" rel="stylesheet">
  <link href="{{asset ('V-TAX/vendor/quill/quill.bubble.css')}}" rel="stylesheet">
  <link href="{{asset ('V-TAX/vendor/remixicon/remixicon.css')}}" rel="stylesheet">
  <link href="{{asset ('V-TAX/vendor/simple-datatables/style.css')}}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{asset ('V-TAX/css/style.css')}}" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Updated: Apr 20 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>


    <section class="section">
        <div class="row">
          <div class="col-lg-12">

            <div class="card">
              <div class="card-body">
                <h5 class="card-title">data tabel </h5>
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
                      <td>{{ $list->username }}</td>
                      <td>{{ $list->jenis_pajak_id }}</td>
                      <td>{{ $list->fees->total_fee }}</td>
                      <td>{{ $list->fees->fee_mba }}</td>
                      <td>{{ $list->fees->fee_mitra }}</td>
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

          </div>
        </div>
      </section>

    </main><!-- End #main -->



  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{asset ('V-TAX/vendor/apexcharts/apexcharts.min.js')}}"></script>
  <script src="{{asset ('V-TAX/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset ('V-TAX/vendor/chart.js/chart.umd.js')}}"></script>
  <script src="{{asset ('V-TAX/vendor/echarts/echarts.min.js')}}"></script>
  <script src="{{asset ('V-TAX/vendor/quill/quill.js')}}"></script>
  <script src="{{asset ('V-TAX/vendor/simple-datatables/simple-datatables.js')}}"></script>
  <script src="{{asset ('V-TAX/vendor/tinymce/tinymce.min.js')}}"></script>
  <script src="{{asset ('V-TAX/vendor/php-email-form/validate.js')}}"></script>

  <!-- Template Main JS File -->
  <script src="{{asset ('V-TAX/js/main.js')}}"></script>

</body>

</html>


    </div>
@endsection
