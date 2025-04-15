@extends('layout.am_wilayahfeelayout')

@section('side0', 'collapsed')
@section('side8', 'active')

@section('title', 'ditolak')

@section('content')
    <div class="container mt-4">


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
                            <h1>Data Ditolak</h1>
                            <nav>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                                    <li class="breadcrumb-item active">Ditolak</li>
                                </ol>
                            </nav>
                        </div><!-- End Page Title -->
                        <!-- Modal -->
                        @if (Session::has('status'))
                            <div id="flash-message" class="alert alert-success" role="alert">
                                {{ Session::get('message') }}
                            </div>
                        @endif
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <strong>Harap lengkapi semua inputan telepon yang wajib diisi!</strong>
                            </div>
                        @endif
                        <script>
                            // Hilangkan flash message setelah 3 detik (3000 ms)
                            setTimeout(() => {
                                const flashMessage = document.getElementById('flash-message');
                                if (flashMessage) {
                                    flashMessage.style.transition = 'opacity 0.5s ease';
                                    flashMessage.style.opacity = '0';
                                    setTimeout(() => flashMessage.remove(), 500); // Hapus dari DOM setelah fade-out
                                }
                            }, 3000); // Ubah angka ini untuk durasi yang berbeda
                        </script>
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Terakhir <span>| Ditolak</span></h5>
                                <ul class="nav nav-tabs nav-tabs-bordered d-flex" id="borderedTabJustified" role="tablist">
                                    <li class="nav-item flex-fill" role="presentation">
                                        <a class="nav-link w-50 {{ Request::routeIs('belumvalidasi') ? 'active' : '' }}"
                                            id="belumvalidasi-tab" href="{{ route('belumvalidasi') }}" role="tab"
                                            aria-controls="belumvalidasi"
                                            aria-selected="{{ Request::routeIs('belumvalidasi') ? 'true' : 'false' }}">
                                            Diajukan
                                        </a>
                                    </li>
                                    <li class="nav-item flex-fill" role="presentation">
                                        <a class="nav-link w-50 {{ Request::routeIs('ditolak') ? 'active' : '' }}"
                                            id="ditolak-tab" href="{{ route('ditolak') }}" role="tab"
                                            aria-controls="ditolak"
                                            aria-selected="{{ Request::routeIs('ditolak') ? 'true' : 'false' }}">
                                            Ditolak <span id="Ditolak-am" class="badge bg-danger ms-1">0</span>
                                        </a>
                                    </li>
                                    <li class="nav-item flex-fill" role="presentation">
                                        <a class="nav-link w-50 {{ Request::routeIs('diterima') ? 'active' : '' }}"
                                            id="diterima-tab" href="{{ route('diterima') }}" role="tab"
                                            aria-controls="diterima"
                                            aria-selected="{{ Request::routeIs('diterima') ? 'true' : 'false' }}">
                                            Disetujui
                                        </a>
                                    </li>
                                </ul>
                                <br>
                                <!-- Table with stripped rows -->


                                <!-- Tabel Data -->
                                <div class="table-responsive">
                                    <table class="table datatable">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>ID</th>
                                                <th>Kode Pengajuan</th>
                                                <th>Nama AM</th>
                                                <th>Nama Mitra</th>
                                                <th>Wilayah</th>
                                                <th>Jenis Pajak</th>
                                                <th>Jenis Transaksi</th>
                                                <th>WAG Kordinasi Payment</th>
                                                <th>Status</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($paymentmba->filter(fn($item) => $item->status == 1) as $list)
                                                <tr>
                                                    <td><input type="checkbox" name="ids[]" value="{{ $list->id }}">
                                                    </td>
                                                    <td>{{ $list->id }}</td>
                                                    <td>{{ $list->kode_pengajuan }}</td>
                                                    <td>{{ $list->user->username }}</td>
                                                    <td>{{ $list->mitra->nama_mitra }}</td>
                                                    <td>{{ $list->wilayah->nama_wilayah }}</td>
                                                    <td>{{ $list->jenis_pajak_nama }}</td>
                                                    <td>{{ $list->jenis_transaksi->nama_jenis_transaksi }}</td>
                                                    <td>{{ $list->wag_kordinasi_payment }}</td>
                                                    <td>
                                                        <span class="badge bg-danger">Ditolak</span>
                                                    </td>
                                                    <td>
                                                        <div class="col-3">
                                                            <button class="btn btn-dark btn-sm" data-bs-toggle="modal"
                                                                data-bs-target="#Editpaymentr{{ $list->id }}">
                                                                <i class="bi bi-pencil-square"></i> Detail
                                                            </button>
                                                        </div>
                                                    </td>
                                                    @include('admin.modal.editditolak')
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                </form>


                                {{--  --}}
                            </div>

                        </div>
                    </div>
            </section>

            </main><!-- End #main -->

            {{-- <script>
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
            </script> --}}



            <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
                    class="bi bi-arrow-up-short"></i></a>



        </body>

        </html>


    </div>
@endsection
