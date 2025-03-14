@extends('layout.am_wilayahfeelayout')
@section('side0', 'collapsed')
@section('side1', 'active')

@section('content')
    <div class="container mt-4">
        {{-- <h1 class="mb-4">Halaman Belum validasi</h1> --}}

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
                                    <h1>Data Diajukan</h1>
                                    <nav>
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a>
                                            </li>
                                            <li class="breadcrumb-item active">Diajukan</li>
                                        </ol>
                                    </nav>
                                </div><!-- End Page Title -->


                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Terakhir <span>| Diajukan</span></h5>
                                        <button type="button" class="btn btn-info  @yield('side2')"
                                            onclick="window.location.href='{{ route('admin.pengajuan') }}'"><span class="bi bi-plus-lg">Pengajuan</span>
                                           </button>

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
                                                    Ditolak
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
                                                        <th>Status</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($paymentmba->filter(function ($item) {
            return $item->status == 0;
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
                        </section>

                        </main><!-- End #main -->



                        <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
                                class="bi bi-arrow-up-short"></i></a>



        </body>

        </html>


    </div>
@endsection
