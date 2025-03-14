@extends('layout.am_wilayahfeelayout')

@section('side0', 'collapsed')
@section('side8', 'active')


@section('side3')
    collapsed
@endsection
@section('side10')
    collapsed
@endsection
@section('side4')
    collapsed
@endsection
@section('side6')
    collapsed
@endsection
@section('side7')
    collapsed
@endsection
@section('side11')
    collapsed
@endsection
@section('side5')
    collapsed
@endsection
@section('side12')
    collapsed
@endsection

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
                            <h1>Data Diajukan</h1>
                            <nav>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.utama') }}">Home</a></li>
                                    <li class="breadcrumb-item active">Diajukan</li>
                                </ol>
                            </nav>
                        </div><!-- End Page Title -->

                        <div class="card">
                            <div class="card-body">

                                <ul class="nav nav-tabs nav-tabs-bordered d-flex" id="borderedTabJustified" role="tablist">
                                    <li class="nav-item flex-fill" role="presentation">
                                        <a class="nav-link w-50 {{ Request::routeIs('feea.belumvalidasi') ? 'active' : '' }}"
                                            id="diajukan-tab" href="{{ route('feea.belumvalidasi') }}" role="tab"
                                            aria-controls="diajukan"
                                            aria-selected="{{ Request::routeIs('feea.belumvalidasi') ? 'true' : 'false' }}">
                                            Diajukan
                                        </a>
                                    </li>
                                    <li class="nav-item flex-fill" role="presentation">
                                        <a class="nav-link w-50 {{ Request::routeIs('feea.ditolak') ? 'active' : '' }}"
                                            id="ditolak-tab" href="{{ route('feea.ditolak') }}" role="tab"
                                            aria-controls="ditolak"
                                            aria-selected="{{ Request::routeIs('feea.ditolak') ? 'true' : 'false' }}">
                                            Ditolak
                                        </a>
                                    </li>
                                    <li class="nav-item flex-fill" role="presentation">
                                        <a class="nav-link w-50 {{ Request::routeIs('feea.diterima') ? 'active' : '' }}"
                                            id="disetujui-tab" href="{{ route('feea.diterima') }}" role="tab"
                                            aria-controls="disetujui"
                                            aria-selected="{{ Request::routeIs('feea.diterima') ? 'true' : 'false' }}">
                                            Disetujui
                                        </a>
                                    </li>
                                </ul>

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
                                                <th>Status</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($paymentmba->filter(function ($item) {
            return $item->status == 0 && $item->jenis_pengajuan == 1; // status 0 = belum divalidasi
        }) as $key => $list)
                                                <tr>
                                                    <td>{{ $list->kode_pengajuan }}</td>
                                                    <td>{{ $list->user->username }}</td>
                                                    <td>{{ $list->mitra->nama_mitra }}</td>
                                                    <td>{{ $list->wilayah->nama_wilayah }}</td>
                                                    <td>{{ $list->jenis_pajak_nama }}</td>
                                                    <td>{{ $list->jenis_transaksi->nama_jenis_transaksi }}</td>
                                                    <td>{{ $list->wag_kordinasi_payment }}</td>
                                                    <td>
                                                        @if ($list->status == 0)
                                                            <span class="badge bg-warning">Diajukan</span>
                                                        @endif
                                                    </td>
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
