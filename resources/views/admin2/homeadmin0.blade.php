@extends('layout.am_wilayahfeelayout')

@section('side1')
    collapsed
@endsection
@section('side2')
    collapsed
@endsection
@section('side3')
    collapsed
@endsection
@section('side4')
    collapsed
@endsection
@section('side5')
    collapsed
@endsection
@section('side6')
    collapsed
@endsection
@section('side7')
    collapsed
@endsection
@section('side8')
    collapsed
@endsection
@section('side9')
    collapsed
@endsection
@section('side10')
    collapsed
@endsection
@section('side11')
    collapsed
@endsection
@section('side12')
    collapsed
@endsection

@section('content')


<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>



    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.utama') }}">Home</a></li>
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

                                <div class="card-body">
                                    <h5 class="card-title">Integrasi Mitra Feebased </span></h5>

                                    <div class="d-flex align-items-center">

                                        <div class="ps-3">
                                            <span class="badge bg-warning"
                                                onclick="window.location.href='/feeabelumvalidasi'"
                                                style="cursor: pointer;">Diajukan</span> </td> |<td> <span
                                                    id="belum_divalidasifeead" class="badge bg-warning"
                                                    onclick="window.location.href='/feeabelumvalidasi'"
                                                    style="cursor: pointer;">0</span></td>
                                            | <td> <span class="badge bg-success"
                                                    onclick="window.location.href='/feeaditerima'"
                                                    style="cursor: pointer;">Disetujui</span> </td> | <td> <span
                                                    id="diterima_feead" class="badge bg-success"
                                                    onclick="window.location.href='/feeaditerima'"
                                                    style="cursor: pointer;">0</span></td>
                                            |<td> <span class="badge bg-danger"
                                                    onclick="window.location.href='/feeaditolak'"
                                                    style="cursor: pointer;">Ditolak</span></td> |<td> <span
                                                    id="ditolak_feead" class="badge bg-danger"
                                                    onclick="window.location.href='/feeaditolak'"
                                                    style="cursor: pointer;">0</span></td>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="col-xxl-4 col-xl-6">

                            <div class="card info-card customers-card">


                                <div class="card-body">
                                    <h5 class="card-title">Integrasi Mitra Non Feebased </span></h5>

                                    <div class="d-flex align-items-center">
                                        <div class="ps-3">
                                            <span class="badge bg-warning"
                                                onclick="window.location.href='/nofeeabelumvalidasi'"
                                                style="cursor: pointer;">Diajukan</span> </td> |<td> <span
                                                    id="belum_divalidasinofeead" class="badge bg-warning"
                                                    onclick="window.location.href='nofeeabelumvalidasi'"
                                                    style="cursor: pointer;">0</span></td>
                                            | <td> <span class="badge bg-success"
                                                    onclick="window.location.href='/nofeeaditerima'"
                                                    style="cursor: pointer;">Disetujui</span> </td> | <td> <span
                                                    id="diterima_nofeead" class="badge bg-success"
                                                    onclick="window.location.href='/nofeeaditerima'"
                                                    style="cursor: pointer;">0</span></td>
                                            |<td> <span class="badge bg-danger"
                                                    onclick="window.location.href='/nofeeaditolak'"
                                                    style="cursor: pointer;">Ditolak</span></td> |<td> <span
                                                    id="ditolak_nofeead" class="badge bg-danger"
                                                    onclick="window.location.href='/nofeeaditolak'"
                                                    style="cursor: pointer;">0</span></td>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        @foreach ($totalPengajuanPerAM as $data)
                            <div class="col-xxl-4 col-md-4">
                                <div class="card info-card sales-card">

                                    <div class="card-body">
                                        @if ($data->am_id == 2)
                                            <h5 class="card-title">AM Wilayah 1</h5>
                                        @elseif ($data->am_id == 3)
                                            <h5 class="card-title">AM Wilayah 2</h5>
                                        @elseif ($data->am_id == 4)
                                            <h5 class="card-title">AM Wilayah 3</h5>
                                        @elseif ($data->am_id == 5)
                                            <h5 class="card-title">AM Wilayah 4</h5>
                                        @elseif ($data->am_id == 6)
                                            <h5 class="card-title">AM Kerja Sama</h5>
                                        @endif

                                        <div class="d-flex align-items-center">
                                            <div
                                                class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                <i class="bi bi-graph-up"></i>
                                            </div>
                                            <div class="ps-3">
                                                <h6>{{ $data->total_pengajuan }}</h6>
                                                <span class="text-muted small pt-2 ps-1 fw-bold">Jumlah Pengajuan</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <!-- Recent Sales -->
                        <div class="col-12">
                            <div class="card recent-sales overflow-auto">


                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Terakhir <span>| Diajukan</span></h5>

                                        <form method="get" action="">
                                            <div class="row mt-3 justify-content-center">
                                                <div class="col-2 text-center">
                                                    <select class="form-select" name="kode_pengajuan">
                                                        <option value="">Kode Pengajuan</option>
                                                        @foreach ($kode_pengajuan as $prefix)
                                                            <option value="{{ $prefix }}"
                                                                {{ request('kode_pengajuan') == $prefix ? 'selected' : '' }}>
                                                                {{ $prefix }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

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













                                        <!-- Table with stripped rows -->
                                        <div class="table-responsive">
                                            <table class="table datatable">
                                                <thead>
                                                    <tr>
                                                        <th>Kode Pengajuan</th>
                                                        <th>Nama Mitra</th>
                                                        <th>Nama Wilayah</th>
                                                        <th>Jenis Pajak</th>
                                                        <th>Jenis Transaksi</th>
                                                        <th>Status</th>
                                                        <th>Aksi</th>
                                                    </tr>

                                                </thead>
                                                <tbody>
                                                    @foreach ($paymentmba as $key => $list)
                                                        <th>{{ $list->kode_pengajuan }}</a>
                                                        </th>
                                                        <td>{{ $list->mitra->nama_mitra }}</td>
                                                        <td>{{ $list->wilayah->nama_wilayah }}</td>
                                                        <td>{{ $list->jenis_pajak_nama }}</td>
                                                        <td>{{ $list->jenis_transaksi->nama_jenis_transaksi }}</td>
                                                        <td>
                                                            @if ($list->status == 0)
                                                                <span class="badge bg-warning">Diajukan</span>
                                                            @elseif ($list->status == 1)
                                                                <span class="badge bg-danger"> Ditolak </span>
                                                            @elseif ($list->status == 2)
                                                                <span class="badge bg-success"> Diterima </span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <div class="d-flex gap-2">
                                                                <button class="btn btn-dark btn-sm" data-bs-toggle="modal"
                                                                    data-bs-target="#Editpayment{{ $list->id }}">
                                                                    <i class="bi bi-pencil-square"></i> Detail
                                                                </button>
                                                            </div>
                                                        </td>
                                                        </tr>
                                                        @include('admin2.modal.detailpayment')
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
@endsection
