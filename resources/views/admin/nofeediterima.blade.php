@extends('layout.am_wilayahfeelayout')

@section('side0', 'collapsed')
@section('side8', 'active')

@section('title', 'nofeeditolak')

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


            <section class="section">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="pagetitle">
                            <h1>Halaman diterima</h1>
                            <nav>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                                    <li class="breadcrumb-item active">Diterima</li>
                                </ol>
                            </nav>
                        </div><!-- End Page Title -->

                        <div class="card">
                            <div class="card-body">


                                <!-- Table with stripped rows -->
                                <div class="table-responsive">
                                    <table id="table-ditolak" class="table datatable">
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
                                            @foreach($paymentmba->filter(function($item) {
                                                return (
                                                    $item->status == 2 && // status 0 = belum divalidasi
                                                    $item->jenis_pengajuan == 2
                                                );
                                            }) as $key => $list)
                                                <tr>
                                                    <td>{{ $list->kode_pengajuan }}</td>
                                                    <td>{{ $list->user->username }}</td>
                                                    <td>{{ $list->mitra->nama_mitra }}</td>
                                                    <td>{{ $list->wilayah->nama_wilayah }}</td>
                                                    <td>{{ $list->jenis_pajak->nama_jenis_pajak }}</td>
                                                    <td>{{ $list->jenis_transaksi->nama_jenis_transaksi }}</td>
                                                    <td>{{ $list->wag_kordinasi_payment }}</td>
                                                    <td>
                                                        <div class="col-3">
                                                            <button class="btn btn-dark btn-sm" data-bs-toggle="modal"
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

                        </div>
                    </div>
            </section>

            </main><!-- End #main -->

            <script>
                function updateNotifDitolak() {
                    var table = document.getElementById("table-ditolak");
                    if (table) {
                        var rowCount = table.getElementsByTagName("tr").length - 1; // Kurangi header jika ada
                        var prevCount = localStorage.getItem("countDitolak");

                        // Update localStorage hanya jika ada perubahan
                        if (rowCount != prevCount) {
                            localStorage.setItem("countDitolak", rowCount);
                        }
                    }
                }

                // Jalankan fungsi setiap 2 detik untuk update otomatis
                setInterval(updateNotifDitolak, 2000);

                // Jalankan saat halaman dimuat pertama kali
                document.addEventListener("DOMContentLoaded", updateNotifDitolak);
            </script>



            <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
                    class="bi bi-arrow-up-short"></i></a>



        </body>

        </html>


    </div>
@endsection
