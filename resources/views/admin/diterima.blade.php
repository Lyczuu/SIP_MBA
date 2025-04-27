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

        <head>
            <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />
            <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


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


                                        <form method="get" action="">
                                            <div class="row mt-3 justify-content-center">

                                                <div class="col-2 text-center">
                                                    <select class="form-select" name="nama_mitra">
                                                        <option value="">Nama Mitra</option>
                                                        @foreach ($nama_mitra as $mitra)
                                                            <option value="{{ $mitra->id }}"
                                                                {{ request('nama_mitra') == $mitra->id ? 'selected' : '' }}>
                                                                {{ $mitra->nama_mitra }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-2 text-center">
                                                    <select class="form-select" name="wilayah">
                                                        <option value="">Wilayah</option>
                                                        @foreach ($wilayah as $w)
                                                            <option value="{{ $w->id }}"
                                                                {{ request('wilayah') == $w->id ? 'selected' : '' }}>
                                                                {{ $w->nama_wilayah }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-2 text-center">
                                                    <select class="form-select" name="jenis_transaksi">
                                                        <option value="">Jenis Transaksi</option>
                                                        @foreach ($jenis_transaksi as $jt)
                                                            <option value="{{ $jt->id }}"
                                                                {{ request('jenis_transaksi') == $jt->id ? 'selected' : '' }}>
                                                                {{ $jt->nama_jenis_transaksi }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-2 text-center">
                                                    <input type="date" class="form-control" name="tanggal"
                                                        value="{{ request('tanggal') }}">
                                                </div>

                                                <div class="col-1 text-center">
                                                    <button type="submit" class="btn btn-primary">
                                                        <i class="bi bi-funnel"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                        <br>
                                        <form id="exportForm" method="POST" action="{{ route('payment.exportAdmin') }}">
                                            @csrf

                                            <!-- Tombol Cetak Form -->
                                            <button type="submit" class="btn btn-success">Cetak Form</button>

                                            <!-- Tombol Cetak Excel -->
                                            <button type="button" class="btn btn-primary" id="exportExcelBtn">Cetak
                                                Excel</button>

                                            <div class="table-responsive mt-3">
                                                <table>
                                                    <thead>
                                                        <tr>
                                                            <th>
                                                                <input type="checkbox" id="selectAll">
                                                                <label for="selectAll">Select All</label>
                                                            </th>
                                                        </tr>
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
                                                        @foreach ($paymentmba->filter(fn($item) => $item->status == 2) as $key => $list)
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
                                                                    <span class="badge bg-success">Disetujui</span>
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
                                                // Modal Log
                                                document.querySelectorAll('button[data-bs-toggle="modal"]').forEach(button => {
                                                    button.addEventListener('click', function(event) {
                                                        event.preventDefault();
                                                        let modalId = this.getAttribute('data-bs-target');
                                                        console.log("Opening modal:", modalId);
                                                    });
                                                });

                                                // Select All Checkbox
                                                document.getElementById('selectAll').addEventListener('change', function() {
                                                    let checkboxes = document.querySelectorAll('input[name="ids[]"]');
                                                    checkboxes.forEach(checkbox => checkbox.checked = this.checked);
                                                });

                                                // Handle Export Excel
                                                document.getElementById('exportExcelBtn').addEventListener('click', function() {
                                                    let form = document.getElementById('exportForm');
                                                    let originalAction = form.action;

                                                    // Ganti action ke route Excel export
                                                    form.action = "{{ route('payment.exportAdmindetail') }}";
                                                    form.submit();

                                                    // Kembalikan ke action semula (biar tombol "Cetak Form" tetap jalan)
                                                    form.action = originalAction;
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


    </div>
@endsection
