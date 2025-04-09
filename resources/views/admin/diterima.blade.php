@extends('layout.am_wilayahfeelayout')

@section('side0', 'collapsed')
@section('side9', 'active')

@section('title', 'diterima')

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

                        <section class="section dashboard">
                            <div class="row">

                                <div class="pagetitle">
                                    <h1>Data Disetujui</h1>
                                    <nav>
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a>
                                            </li>
                                            <li class="breadcrumb-item active">Disetujui</li>
                                        </ol>
                                    </nav>
                                </div><!-- End Page Title -->



                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Terakhir <span>| Disetujui</span></h5>

                                        <ul class="nav nav-tabs nav-tabs-bordered d-flex" id="borderedTabJustified"
                                            role="tablist">
                                            <li class="nav-item flex-fill" role="presentation">
                                                <a class="nav-link w-50 {{ Request::routeIs('belumvalidasi') ? 'active' : '' }}"
                                                    id="belumvalidasi-tab" href="{{ route('belumvalidasi') }}"
                                                    role="tab" aria-controls="belumvalidasi"
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
                                        <form id="exportForm" method="POST" action="{{ route('payment.exportAM') }}">
                                            @csrf

                                            <button type="submit" class="btn btn-success">Cetak Form</button>

                                            <div class="table-responsive">
                                                <table>
                                                    <thead>
                                                        <th>
                                                            <input type="checkbox" id="selectAll">
                                                            <label for="selectAll">Select All</label>
                                                        </th>
                                                    </thead>
                                                </table>
                                            </div>

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
                                                        @foreach ($paymentmba->filter(function ($item) {
            return $item->status == 2;
        }) as $key => $list)
                                                            <tr>
                                                                <td><input type="checkbox" name="ids[]"
                                                                        value="{{ $list->id }}"></td>
                                                                <td>{{ $list->id }}</td>
                                                                <td>{{ $list->kode_pengajuan }}</td>
                                                                <td>{{ $list->user->username }}</td>
                                                                <td>{{ $list->mitra->nama_mitra }}</td>
                                                                <td>{{ $list->wilayah->nama_wilayah }}</td>
                                                                <td>{{ $list->jenis_pajak_nama }}</td>
                                                                <td>{{ $list->jenis_transaksi->nama_jenis_transaksi }}</td>
                                                                <td>{{ $list->wag_kordinasi_payment }}</td>
                                                                <td>
                                                                    @if ($list->status == 2)
                                                                        <span class="badge bg-success">Disetujui</span>
                                                                    @endif
                                                                </td>
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
                                            </div>
                                        </form>

                                        <script>
                                            document.addEventListener('DOMContentLoaded', function() {
                                                document.querySelectorAll('button[data-bs-toggle="modal"]').forEach(button => {
                                                    button.addEventListener('click', function(event) {
                                                        event.preventDefault(); // Mencegah reload jika terjadi
                                                        let modalId = this.getAttribute('data-bs-target');
                                                        console.log("Opening modal:", modalId);
                                                    });
                                                });

                                                // Select/Deselect All Checkboxes
                                                document.getElementById('selectAll').addEventListener('change', function() {
                                                    let checkboxes = document.querySelectorAll('input[name="ids[]"]');
                                                    checkboxes.forEach(checkbox => checkbox.checked = this.checked);
                                                });
                                            });
                                        </script>


                                    </div>
                                    {{-- end card div --}}

                                </div>
                            </div>
                        </section>

                        </main><!-- End #main -->


                        <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
                                class="bi bi-arrow-up-short"></i></a>
        </body>

        </html>
    </div>
@endsection
