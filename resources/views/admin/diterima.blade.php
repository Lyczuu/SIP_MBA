@extends('layout.am_wilayahfeelayout')

@section('title', 'diterima')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Halaman Diterima</h1>

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

    <section class="section">
        <div class="row">
          <div class="col-lg-12">

            <section class="section dashboard">
                <div class="row">




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
                      @foreach($paymentmba as $key => $list)
                    <tr>
                      <td>{{ $list->kode_pengajuan }}</td>
                      <td>{{ $list->user->username }}</td>
                      <td>{{ $list->jenis_pajak_id }}</td>
                      <td>{{ $list->fees->total_fee }}</td>
                      <td>{{ $list->fees->fee_mba }}</td>
                      <td>{{ $list->fees->fee_mitra }}</td>
                      <td><span class="badge bg-success">Diterima</span></td>
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
